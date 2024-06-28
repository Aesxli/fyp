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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $couponId = $_POST['couponId'];
    $redeemedDate = date('Y-m-d');
//comment out bottom line to test error part 
    $sql = "UPDATE Vendor_redeeming_Coupons SET Redeemed_date='$redeemedDate' WHERE Coupon_Id='$couponId'";

    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>


