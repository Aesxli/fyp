<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$Claimant_ID = $_GET['Claimants_ID'];
$Campaign_ID = $_GET['Campaign_ID'];

$link = mysqli_connect($host, $username, $password, $database);

$querySelect = "SELECT * FROM campaign_has_type ct
                JOIN coupon_type c ON c.Coupon_Type_Id = ct.Coupon_Type_Id
                WHERE ct.Campaign_Id = $Campaign_ID";


$campaignCoupon = mysqli_query($link, $querySelect) or die(mysqli_error($link));

$arrCampaignCoupon = [];
while ($row = mysqli_fetch_assoc($campaignCoupon)) {
    $arrCampaignCoupon[] = $row['Coupon_Type'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="generalStyle.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <style>
        .small-select {
            width: 200px;
            /* Adjust this as needed */
            max-width: 200px;
            /* Set a maximum width */
            padding: 5px;
            /* Adjust padding */
            font-size: 0.9rem;
            /* Adjust font size */
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <select class="form-select small-select" aria-label="Default select example">
            <option selected>Select a Coupon</option>
            <?php
            foreach ($arrCampaignCoupon as $coupon) {
                echo "<option value=\"" . htmlspecialchars($coupon) . "\">" . htmlspecialchars($coupon) . "</option>";
            }
            ?>
        </select>
    </div>
</body>

</html>