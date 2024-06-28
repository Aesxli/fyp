<?php

$Campaign_ID = $_GET['Campaign_ID'];
$ClaimantId = $_GET['Claimants_ID'];
$Campaign_Name = $_GET['Campaign_Name'];

$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$querySelect = "SELECT * FROM claimants WHERE Claimants_Id = $ClaimantId ";

$searchClaimant = mysqli_query($link, $querySelect) or die(mysqli_error($link));


mysqli_close($link);


$arrResult = [];

while ($row = mysqli_fetch_assoc($searchClaimant)) {
    $arrResult[] = $row;
    $ClaimantName = $row['Claimants_name'];
    $ClaimantNric = $row['Claimants_NRIC'];
    $ClaimantEmail = $row['Claimants_email'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <link rel="stylesheet" href="generalStyle.css" />

    <link rel="stylesheet" href="editMenteeInfo.css" />
</head>

<body>
    <header>
        <div class="header-content">
            <a href="displayMentee.php?Campaign_ID=<?php echo htmlspecialchars($Campaign_ID); ?>&Campaign_Name=<?php echo htmlspecialchars($Campaign_Name); ?>">
                <img src="../images/Daco_2767433.png" alt="back Icon" class="back-icon" />
            </a>
            <div class="text-container">
                <h1><?php echo $Campaign_Name; ?></h1>
                <h4>Edit Mentee Information</h4>
            </div>
        </div>
    </header>
    <div class="square">
        <form class="issuer-form" method="post" action="doMenteeEdit.php">
            <input type="hidden" name="Claimants_ID" value="<?php echo $ClaimantId ?>" />

            <label for="name" class="name-label">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $ClaimantName ?>">

            <label for="email" class="email-label">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $ClaimantEmail ?>" required>


            <label for=" nric" class="nric-label">NRIC (Last 4 Digits e.g. 1234A):</label>
            <input type="text" id="nric" name="nric" value="<?php echo $ClaimantNric ?>" pattern="\d{4}[A-Z]" required>




            <div class="button-container">
                <button onclick="showDialog()" type="button" id="discard">DISCARD</button>
                <button type="submit" id="submit-button">DONE</button>
            </div>
        </form>
    </div>

    <!-- Confirmation Dialog -->
    <div class="container">
        <div class="overlay" id="overlay"></div>

        <div class="confirm-dialog" id="confirmDialog">
            <div class="message">
                <h2>Discard changes?</h2>
                <p>You will lose all changes made to this student.</p>
            </div>
            <div class="buttons">
                <button class="keep-editing" onclick="hideDialog()">Keep Editing</button>
                <button class="discard-changes" onclick="discardChanges()">Discard changes</button>
            </div>
        </div>
    </div>

    <script>
        function showDialog() {
            document.getElementById('confirmDialog').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function hideDialog() {
            document.getElementById('confirmDialog').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function discardChanges() {
            // Add your discard logic here
            alert('Changes discarded');
            hideDialog();
        }
    </script>
</body>

</html>