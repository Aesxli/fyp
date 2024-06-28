<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Simple Website</title>
    <link rel="stylesheet" href="vendorhome.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
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

    // Query to select Vendor_name
    $sql = "SELECT Vendor_name FROM vendor LIMIT 1"; // Assuming you want the first Vendor_name
    $result = $conn->query($sql);

    $vendor_name = "";
    if ($result->num_rows > 0) {
        // Fetch the first row
        $row = $result->fetch_assoc();
        $vendor_name = $row["Vendor_name"];
    } else {
        $vendor_name = "Guest"; // Default name if no vendor found
    }

    $conn->close();
    ?>

    <header>
        <div class="header-content">
            <div class="text-container">
                <h1>Hello, <?php echo htmlspecialchars($vendor_name); ?>!</h1>
                <h4>What would you like to do today?</h4>
            </div>
            <a href="start.html">
                <img src="../images/[CITYPNG.COM]PNG Login Logout White Icon - 800x800.png" alt="Logout Icon" class="logout-icon">
            </a>
        </div>
    </header>
    
    <div class="button-container">
        <button class="gradient-button" onclick="window.location.href='qrscanner.html';">Scan Coupon</button>
    </div>
    <div class="button-container">
        <button class="gradient-button" onclick="window.location.href='scanner/docs/index.html';">Scan QR</button>
    </div>
    
</body>
</html>
