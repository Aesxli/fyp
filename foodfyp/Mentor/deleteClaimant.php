<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$Claimant_ID = $_GET['Claimants_ID'];

$link = mysqli_connect($host, $username, $password, $database);

$DeleteClaimant = "DELETE FROM campaign_has_claimants WHERE Claimants_Id = '$Claimant_ID'";

$status = mysqli_query($link, $DeleteClaimant) or die(mysqli_error($link));

if ($status) {
    $message = "Review Delete";
} else {
    $message = "Item delete failed.";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 style="text-align: center"> <?php echo $message ?> </h1>

</body>

</html>