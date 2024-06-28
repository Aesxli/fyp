<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);



$UpdatedName = $_POST['name'];
$UpdatedEmail = $_POST['email'];
$UpdatedNRIC = $_POST['nric'];

$Claimants_ID = $_POST['Claimants_ID'];


$queryUpdate = "UPDATE Claimants
                SET Claimants_name='$UpdatedName',  Claimants_email='$UpdatedEmail ', Claimants_NRIC='$UpdatedNRIC'
                WHERE Claimants_Id = $Claimants_ID";






$resultUpdate = mysqli_query($link, $queryUpdate)
    or die(mysqli_error($link));


if ($resultUpdate) {
    $msg = "record successfully updated";
} else {
    $msg = "record not updated";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="generalStyle.css">
</head>

<body>
    <div class="box">
        <h1 style="text-align: center">doSearchMentee Edited</h1>

        <b>Name:</b><br>
        <?php echo $UpdatedName ?><br>
        <b>Email:</b><br>
        <?php echo $UpdatedEmail ?><br>
        <b>NRIC:</b><br>
        <?php echo $UpdatedNRIC ?><br>




    </div>

</body>

</html>