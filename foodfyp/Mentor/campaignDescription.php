<?php
$Campaign_ID = $_GET['Campaign_ID'];


$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$querySelect = "SELECT * FROM campaign WHERE Campaign_Id = '$Campaign_ID'";

$CampaignInfo = mysqli_query($link, $querySelect) or die(mysqli_error($link));

mysqli_close($link);

while ($row = mysqli_fetch_assoc($CampaignInfo)) {
    $arrResult[] = $row;
    $Campaign_Name = $row['Campaign_name'];
    $Campaign_Description = $row['Description'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="generalStyle.css" />
    <link rel="stylesheet" href="CampaignDescription.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

</head>

<body>
    <header>
        <div class="header-content">
            <a href="mentorhome.php">
                <img src="../images/Daco_2767433.png" alt="back Icon" class="back-icon" />
            </a>
            <div class="text-container">
                <h1><?php echo $Campaign_Name ?> </h1>
                <h4>Add Claimant for <?php echo $Campaign_Name ?></h4>
            </div>
        </div>
    </header>
    <div class="container mt-4">

        <div class="dark-blue-box p-4">

            <div class="content">
                <p class="coupon-label">Coupon Types:</p>
                <div class="mb-3">
                    <span class="badge">Coupon A</span>
                    <span class="badge">Coupon B</span>
                    <span class="badge">Coupon C</span>
                </div>
                <p class="event-details"><strong>EVENT CLOSES:</strong> 10/05/24</p>
                <p class="event-description"><strong>Description:</strong></p>
                <p class="event-description-text"><?php echo $Campaign_Description ?></p>

                <div class="button-container">
                    <button class="btn-display" onclick="location.href='displayMentee.php?Campaign_ID=<?php echo $Campaign_ID; ?>&Campaign_Name=<?php echo $Campaign_Name ?> '">
                        Display All Claimants
                    </button>
                    <button class="btn-add" onclick="location.href='addMenteePage.php?Campaign_ID=<?php echo $Campaign_ID; ?>'">
                        Add Claimants
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


</html>