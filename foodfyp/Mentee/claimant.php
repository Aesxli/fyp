<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$_SESSION['email'] = 'melvinlim@gmail.com';
$email = $_SESSION['email'];

$queryGetClaimant = "SELECT Claimants_name
FROM Claimants
WHERE Claimants_email = '$email'";
$result = mysqli_query($link, $queryGetClaimant);
while ($row = mysqli_fetch_array($result)) {
    $arrName[] = $row;
}
$nameParts = explode(" ", $arrName[0]['Claimants_name']);
$first = $nameParts[0];

$queryCoupons = "SELECT C.Campaign_name, C.Campaign_photo, CC.Claimants_Id, CP.Coupon_Id,CP.Coupon_Description, CT.Coupon_Type, CP.Expiry_date
FROM campaign_has_claimants CC
INNER JOIN campaign C ON CC.Campaign_Id = C.Campaign_Id
INNER JOIN claimants CS ON CS.Claimants_Id = CC.Claimants_Id
INNER JOIN coupons CP ON CP.Claimants_Id = CS.Claimants_Id
INNER JOIN coupon_type CT ON CT.Coupon_Type_Id = CP.Coupon_Type_Id";
$resultCoupons = mysqli_query($link, $queryCoupons);
while ($row = mysqli_fetch_array($resultCoupons)) {
    $arrCoupons[] = $row;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="claimant.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="claimant.js"></script>
    <title>Claimant</title>
</head>

<body>
    <header>
        <div class="header-content">
            <div class="text-container">
                <h1 class="welcome">Hello, <?php echo $first ?></h1>
                <h4 class="txt">What would you like to do today?</h4>
            </div>
            <a href="start.html">
                <img src="../images/[CITYPNG.COM]PNG Login Logout White Icon - 800x800.png" alt="Logout Icon" class="logout-icon">
            </a>
        </div>
    </header>

    <div class="btnContainer">
        <button class="btnCurr btnF btnActive" id="btn1" onclick="btnActive('btn1');">Current</button>
        <button class="btnExpr btnF" id="btn2" onclick="btnActive('btn2');">Expired</button>
        <button class="btnAll btnF" id="btn3" onclick="btnActive('btn3')">All</button>
    </div>
    <?php for ($i = 0; $i < count($arrCoupons); $i++) {
        $current_date = date('Y-m-d');
        $expire_date = date($arrCoupons[$i]['Expiry_date']);
        $couponAvail = ' ';
        if (
            $current_date < $expire_date
        ) {
            $couponAvail = 'curr';
        } else {
            $couponAvail = 'expired';
        }
    ?>
        <div class="couponContainer" id="<?php echo $couponAvail ?>">
            <div class="coupon">
                <div class="imgContainer">
                    <img src="../images/<?php echo $arrCoupons[$i]['Campaign_photo'] ?>" alt="Campaign poster" />
                </div>
                <div class="couponHeader">
                    <span class="couponName"><?php echo $arrCoupons[$i]['Campaign_name'] ?></span>
                    <div><span class="couponDetails">Redeem a free <?php echo $arrCoupons[$i]['Coupon_Description'] ?>!</span></div>
                    <?php if ($couponAvail == 'curr') { ?>
                        <div class="bottomRow">
                            <span class="couponType"><?php echo $arrCoupons[$i]['Coupon_Type'] ?></span>
                            <?php $_SESSION['couponId'] = $i;?>
                            <a href="couponDetails.php"><button class="btnRedeem">Redeem >>></button></a>
                        </div>
                    <?php ;
                    } else { ?>
                        <div class="bottomRow">
                            <span class="expired">EXPIRED</span>
                        </div> <?php ;
                            } ?>
                </div>
            </div>
        </div>
    <?php }; ?>

    </div>
    </div>

    <div class="space"></div>
    
</body>

</html>