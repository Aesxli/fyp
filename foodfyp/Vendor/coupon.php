<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="coupon.css"> <!-- Link to your CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <script>
    function showOnClick() {
        document.getElementById("bg").classList.add("redeemClick");
        document.getElementById("cfm").classList.add("redeemClick");
        document.getElementById("content").classList.add("redeem");
    }

    function redeemCoupon(couponId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_coupon.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText.trim() === "Success") {
                    document.getElementById("bg").classList.add("redeemClick");
                    document.getElementById("success").classList.add("redeemClick");
                } else {
                    document.getElementById("bg").classList.add("redeemClick");
                    document.getElementById("failure").classList.add("redeemClick");
                }
            }
        };
        xhr.send("couponId=" + couponId);

        // Close confirmation modal
        document.getElementById("bg").classList.remove("redeemClick");
        document.getElementById("cfm").classList.remove("redeemClick");
        document.getElementById("content").classList.remove("redeem");
    }

    function cancelRedemption() {
        document.getElementById("bg").classList.remove("redeemClick");
        document.getElementById("cfm").classList.remove("redeemClick");
        document.getElementById("content").classList.remove("redeem");
    }

    function closeSuccessPopup() {
        document.getElementById("bg").classList.remove("redeemClick");
        document.getElementById("success").classList.remove("redeemClick");
        location.reload(); // Refresh the page to reflect the changes
    }

    function closeFailurePopup() {
        document.getElementById("bg").classList.remove("redeemClick");
        document.getElementById("failure").classList.remove("redeemClick");
    }
</script>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fbardb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the database
$sql = "SELECT Issuer.Issuer_name, 
               Claimants.Claimants_name, 
               Claimants.Claimants_NRIC, 
               Coupons.Coupon_Id, 
               Coupons.Issued_date, 
               campaign.start_date,
               campaign.end_date AS Expiry_date,
               Coupon_type.coupon_type, 
               Vendor_redeeming_Coupons.Redeemed_date
        FROM Issuer 
        JOIN Coupons ON Issuer.Issuer_Id = Coupons.Issuer_Id 
        JOIN Claimants ON Claimants.Claimants_Id = Coupons.Claimants_Id 
        JOIN Vendor_redeeming_Coupons ON Coupons.Coupon_Id = Vendor_redeeming_Coupons.Coupon_Id
        JOIN Coupon_type ON Coupons.Coupon_Type_Id = Coupon_type.Coupon_Type_Id
        JOIN campaign ON Coupons.Campaign_Id = campaign.Campaign_Id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $issuerName = $row["Issuer_name"];
        $claimantsName = $row["Claimants_name"];
        $claimantsNRIC = $row["Claimants_NRIC"];
        $couponId = $row["Coupon_Id"];
        $issuedDate = $row["Issued_date"];
        $startDate = $row["start_date"];
        $expiryDate = $row["Expiry_date"];
        $redeemedDate = $row["Redeemed_date"];
        $coupontype = $row["coupon_type"];

        // Check if the coupon is valid
        $currentDate = date('Y-m-d');
        if (is_null($redeemedDate) && $expiryDate > $currentDate && $issuedDate >= $startDate) {
            $status = "<span style='color: lightgreen;'>This coupon is still valid</span>";
        } else {
            $status = "<span style='color: red;'>This coupon is not valid</span>";
        }

        // Replace NULL values with '----' for display
        $coupontype = $coupontype ?? '----';
        $issuerName = $issuerName ?? '----';
        $claimantsName = $claimantsName ?? '----';
        $claimantsNRIC = $claimantsNRIC ?? '----';
        $couponId = $couponId ?? '----';
        $issuedDate = $issuedDate ?? '----';
        $expiryDate = $expiryDate ?? '----';
        $redeemedDate = $redeemedDate ?? '----';

        // HTML output for each coupon
        echo "<!-- Confirmation popup -->
        <div class='background' id='bg'></div>
        <div class='confirmation' id='cfm'>
            <div class='cfmContainer'>
                <div class='cfmHeader'>
                    <svg id='exclamation-warning-round-yellow-red-icon' xmlns='http://www.w3.org/2000/svg' width='24'
                            height='24' viewBox='0 0 24 24'>
                            <path id='Path_6' data-name='Path 6' d='M12,0A12,12,0,1,1,3.515,3.515,11.963,11.963,0,0,1,12,0Z'
                                fill='#bf362c' />
                            <path id='Path_7' data-name='Path 7'
                                d='M40.083,29.464A10.619,10.619,0,1,1,29.464,40.083,10.619,10.619,0,0,1,40.083,29.464Z'
                                transform='translate(-28.083 -28.083)' fill='#f7ca41' fill-rule='evenodd' />
                            <path id='Path_8' data-name='Path 8'
                                d='M225.757,126.8a.929.929,0,0,1-1.833,0c-.177-1.772-.63-5.979-.616-7.644.015-.513.44-.817.984-.933a2.594,2.594,0,0,1,.538-.053,2.639,2.639,0,0,1,.54.055c.562.12,1,.436,1,.958l0,.052Zm-.916,1.838a1.227,1.227,0,1,1-1.227,1.227A1.227,1.227,0,0,1,224.84,128.638Z'
                                transform='translate(-212.84 -112.631)' fill='#bf362c' />
                        </svg>
                    <h1>Confirm Redemption?</h1>
                </div>
                <div>
                    <p>Do you want to confirm the redemption of this coupon?</p>
                </div>
                <div>
                    <button class='btnCancel' onclick='cancelRedemption()'>Cancel</button>
                    <button class='btnCfm' onclick='redeemCoupon(\"$couponId\")'>Confirm</button>
                </div>
            </div>
        </div>

        <!-- Success popup -->
        <div class='confirmation' id='success'>
            <div class='cfmContainer2'>
            <div>
            <h1>Coupon Redeemed</h1>
            </div>
                <div class='cfmHeader2'>
                    <svg xmlns=\"http://www.w3.org/2000/svg\" x=\"0px\" y=\"0px\" width=\"100\" height=\"100\" viewBox=\"0 0 40 40\">
                        <path fill=\"#bae0bd\" d=\"M20,38.5C9.8,38.5,1.5,30.2,1.5,20S9.8,1.5,20,1.5S38.5,9.8,38.5,20S30.2,38.5,20,38.5z\"></path>
                        <path fill=\"#5e9c76\" d=\"M20,2c9.9,0,18,8.1,18,18s-8.1,18-18,18S2,29.9,2,20S10.1,2,20,2 M20,1C9.5,1,1,9.5,1,20s8.5,19,19,19	s19-8.5,19-19S30.5,1,20,1L20,1z\"></path>
                        <path fill=\"none\" stroke=\"#fff\" stroke-miterlimit=\"10\" stroke-width=\"3\" d=\"M11.2,20.1l5.8,5.8l13.2-13.2\"></path>
                    </svg> 
                </div>
                <div class='btnclose1'>
                    <button class='btnCfm' onclick='closeSuccessPopup()'>Close</button>
                </div>
            </div>
        </div>

        <!-- Failure popup -->
        <div class='confirmation' id='failure'>
            <div class='cfmContainer3'>
               <div>
                    <h1>Error Redeeming Coupon</h1>
                </div>
                <div class='cfmHeader3'>
                    <?xml version=\"1.0\" encoding=\"utf-8\"?><svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" width=\"122.879px\" height=\"122.879px\" viewBox=\"0 0 122.879 122.879\" enable-background=\"new 0 0 122.879 122.879\" xml:space=\"preserve\"><g><path fill-rule=\"evenodd\" clip-rule=\"evenodd\" fill=\"#FF4141\" 
                    d=\"M61.44,0c33.933,0,61.439,27.507,61.439,61.439 s-27.506,61.439-61.439,61.439C27.507,122.879,0,95.372,0,61.439S27.507,0,61.44,0L61.44,0z M73.451,39.151 c2.75-2.793,7.221-2.805,9.986-0.027c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.076,12.249 c2.729,2.77,2.689,7.257-0.08,10.022c-2.773,2.765-7.23,2.758-9.955-0.013L61.446,71.54L49.428,83.728 c-2.75,2.793-7.22,2.805-9.986,0.027c-2.763-2.776-2.776-7.293-0.027-10.084L51.48,61.434L39.403,49.185 c-2.728-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.953,0.013l11.997,12.165L73.451,39.151L73.451,39.151z\"/></g></svg>
                </div>
                <div class='btnclose2'>
                    <button class='btnCfm' onclick='closeFailurePopup()'>Close</button>
                </div>
            </div>
        </div>

        <header>
            <div class='header-content'>
                <a href='vendorhome.php'>
                    <img src='../images/Daco_2767433.png' alt='back icon' class='back-icon'>
                </a>
            </div>
        </header>
        <div class='whole-coupon'>
            <div class='card shadow'>
                <img src='../images/graduation.png' alt='Card image'>
                <div class='card-content'>
                    <div>
                        <div class='card-title'>Item: $coupontype</div>
                        <div class='card-body'>
                            <div class='Issuer'>Issuer: $issuerName</div>
                            <p></p>
                            <div class='Claimants'>Claimants: $claimantsName</div>
                            <p></p>
                            <div class='ClaimantNRIC'>Claimant's NRIC: $claimantsNRIC</div>
                            <p></p>
                            <div class='CouponID'>Coupon ID: $couponId</div>
                            <p></p>
                            <div class='IssuedDate'>Issued Date: $issuedDate</div>
                            <p></p>
                            <div class='ExpiryDate'>Expiry Date: $expiryDate</div>
                            <p></p>
                            <div class='RedeemedDate'>Redeemed Date: $redeemedDate</div>
                            <p></p>
                            <div class='status'>$status</div>
                        </div>
                    </div>";
                    
                    if ($status !== "<span style='color: red;'>This coupon is not valid</span>") {
                        echo "<a class='card-button' onclick='showOnClick()'>Redeem?</a>";
                    } else {
                        echo "<a class='card-button' style='pointer-events: none; background-color: gray; cursor: not-allowed;'>Redeem?</a>";
                    }
                    
                echo "</div>
            </div>
        </div>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>



