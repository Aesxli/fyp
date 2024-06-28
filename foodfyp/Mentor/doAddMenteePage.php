<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$Claimant_ID = $_POST['Claimant_ID'];
$Campaign_ID = $_POST['Campaign_ID'];

$link = mysqli_connect($host, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize message variable 
$message = "";

$querySelect = "SELECT * FROM claimants c 
                JOIN campaign_has_claimants cc ON c.Claimants_Id = cc.Claimants_Id 
                WHERE cc.Claimants_Id = $Claimant_ID";

$campaignClaimant = mysqli_query($link, $querySelect) or die(mysqli_error($link));

if (mysqli_num_rows($campaignClaimant) == 0) {
    // If not already in the campaign, insert the student 
    $queryInsert = "INSERT INTO campaign_has_claimants (Campaign_Id, Claimants_Id) VALUES ($Campaign_ID, $Claimant_ID)";
    mysqli_query($link, $queryInsert) or die(mysqli_error($link));
    $message = "Mentee added to campaign successfully.";
} else {
    // Set the message if the student is already in the campaign 
    $message = "This person is already in the campaign.";
}

// $arrCampaignMentees = [];
// while ($row = mysqli_fetch_assoc($campaignMentees)) {
//     $arrCampaignMentees[] = $row;
// }

mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Campaign Mentees</title>
    <link rel="stylesheet" href="generalStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

</head>

<body>
    <header>
        <div class="header-content">
            <a href="campaignDescription.php?Campaign_ID=<?php echo $Campaign_ID ?> ">
                <img src="../images/Daco_2767433.png" alt="back Icon" class="back-icon" />
            </a>

        </div>
    </header>

    <h1>Campaign Mentees</h1>

    <?php
    // Display the message if it's set 
    if ($message != "") {
        echo "<p>$message</p>";
    }
    ?>

    <!-- <div class="table-container">
        <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Diploma</th>
                <th>School</th>
            </tr>
            <?php
            foreach ($arrCampaignMentees as $row) {
            ?>
                <tr>
                    <td><?php echo $row['Student_ID']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Diploma']; ?></td>
                    <td><?php echo $row['School']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <h2>Total Mentees: <?php echo count($arrCampaignMentees); ?></h2> -->
</body>

</html>