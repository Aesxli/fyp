<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$email = $_SESSION['email'];
$couponId = $_SESSION['couponId'];

$queryCoupons = "SELECT C.Campaign_name,C.Description, C.Campaign_photo, CC.Claimants_Id, CP.Coupon_Id,CP.Coupon_Description, CT.Coupon_Type, CP.Expiry_date,CP.Coupon_address_attribute
FROM campaign_has_claimants CC
INNER JOIN campaign C ON CC.Campaign_Id = C.Campaign_Id
INNER JOIN claimants CS ON CS.Claimants_Id = CC.Claimants_Id
INNER JOIN coupons CP ON CP.Claimants_Id = CS.Claimants_Id
INNER JOIN coupon_type CT ON CT.Coupon_Type_Id = CP.Coupon_Type_Id
WHERE CP.Coupon_Id = $couponId";

$resultCoupons = mysqli_query($link, $queryCoupons);

while ($row = mysqli_fetch_array($resultCoupons)) {
    $arrCoupons[] = $row;
}

$queryRedeem = "SELECT VRC.Redeemed_date
FROM vendor_redeeming_coupons VRC
INNER JOIN coupons CP ON CP.Coupon_Id = VRC.Coupon_Id
WHERE CP.Coupon_Id = $couponId";

$resultRedeem = mysqli_query($link, $queryRedeem);

while ($row = mysqli_fetch_array($resultRedeem)) {
    $arrRedeem[] = $row;
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="couponDetails.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js">
    </script>
    <script src="couponDetails.js"></script>
    <title>Coupon</title>
</head>

<body>

<div class="background" id="bg"></div>
    <div class="confirmation" id="cfm">

    <?php if(empty($arrRedeem[0]['Redeemed_date'])){?>
        <div class="cfmContainer">
            <div class="cfmHeader">
                <svg id="exclamation-warning-round-yellow-red-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path id="Path_6" data-name="Path 6" d="M12,0A12,12,0,1,1,3.515,3.515,11.963,11.963,0,0,1,12,0Z" fill="#bf362c" />
                    <path id="Path_7" data-name="Path 7" d="M40.083,29.464A10.619,10.619,0,1,1,29.464,40.083,10.619,10.619,0,0,1,40.083,29.464Z" transform="translate(-28.083 -28.083)" fill="#f7ca41" fill-rule="evenodd" />
                    <path id="Path_8" data-name="Path 8" d="M225.757,126.8a.929.929,0,0,1-1.833,0c-.177-1.772-.63-5.979-.616-7.644.015-.513.44-.817.984-.933a2.594,2.594,0,0,1,.538-.053,2.639,2.639,0,0,1,.54.055c.562.12,1,.436,1,.958l0,.052Zm-.916,1.838a1.227,1.227,0,1,1-1.227,1.227A1.227,1.227,0,0,1,224.84,128.638Z" transform="translate(-212.84 -112.631)" fill="#bf362c" />
                </svg>
                <h1>Start Redemption?</h1>
            </div>
            <div>
                <p>pressing "Confirm" will only give you
                    10 minutes to redeem the item</p>
            </div>
            <div>
                <button class="btnCancel" id="cancel" onclick="removeCancel()">Cancel</button>
                <button class="btnCfm" id="cfm" onclick="createQR(); removeOnCfm(); startTimer()">Confirm</button>
            </div>
        </div>
    <?php ;} else{?>
        <div class="cfmContainer">
            <h1>You have already redeemed this coupon.</h1>
            <div class="cfmHeader">
            </div>         
                <div>
                    <button class="btnCancel" id="cancel" onclick=" removeCancel()">Okay</button>
                </div>
        </div>
        <?php ;};?>
    </div>
    <div id="content">
        <header>
            <div class="header-content">
                <a href="claimant.php">
                    <img src="../images/Daco_2767433.png" alt="back-icon" class="back-icon">
                </a>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="couponImg">
                    <div class="imgContainer">
                        <img src="../images/<?php echo $arrCoupons[0]['Campaign_photo'] ?>" width="330" class="img">
                    </div>
                </div>
                <div class="couponDetails">
                    <h1><?php echo $arrCoupons[0]['Campaign_name'] ?></h1>
                    <h4 class="couponType"><?php echo $arrCoupons[0]['Coupon_Type'] ?></h4>
                    <h4 class="couponInfo"><?php echo $arrCoupons[0]['Description'] ?>
                    </h4>
                </div>
                <div class="couponRedeem">
                    <div class="qrContainer">
                        <div class="qrCode "></div>
                        <div >
                            <img class="qrPlaceholder" id="qrPlaceholder" src="../images/qrCode.webp" width="300">
                        </div>
                        
                    </div>
                </div>
                <div class="btnRedeem" onclick="showOnClick()">
                    <a>
                        <h1 id="redeem">REDEEM ITEM</h1>
                        <h1 class="timer" id="timer"><i class="fa-regular fa-clock"></i>0:30</h1>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <div class="space">


    </div>

</body>

</html>