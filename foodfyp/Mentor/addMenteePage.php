<?php
$Campaign_ID = $_GET['Campaign_ID'];


$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$querySelect = "SELECT * FROM campaign WHERE Campaign_Id = $Campaign_ID";

$CampaignInfo = mysqli_query($link, $querySelect) or die(mysqli_error($link));

mysqli_close($link);

while ($row = mysqli_fetch_assoc($CampaignInfo)) {
  $arrResult[] = $row;
  $Campaign_Name = $row['Campaign_name'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Mentee</title>

  <!-- Link to your CSS file -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/76304b6e6b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="addMenteePage.css" />
</head>

<body>
  <header>
    <div class="header-content">
      <a href="mentorhome.php">
        <img src="../images/Daco_2767433.png" alt="back Icon" class="back-icon" />
      </a>
      <div class="text-container">
        <h1><?php echo $Campaign_Name; ?></h1>
        <h4>Add Claimant for <?php echo $Campaign_Name; ?></h4>
      </div>
    </div>
  </header>

  <!-- <div class="search-container">
      <input type="text" placeholder="Search..." />
      <button type="submit">Search</button>
    </div> -->

  <div class="search-container">
    <form method="post" action="doSearchMentee.php?Campaign_ID=<?php echo $Campaign_ID ?>">
      <label for="NRIC_Input">NRIC:</label>
      <input type="text" id="NRIC_Input" name="NRIC_Input" size="10" />

      <!-- <input name="btnSubmit" value="Submit" type="submit" /> -->
      <button value="Submit" type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>

  <!-- <div class="display-container">
    <form method="post" action="displayMentee.php?Campaign_ID=<?php echo $Campaign_ID ?>">
      <button name="btnDisplay" value="Display All Mentees" type="submit">Display All Claimants</i></button>

    </form>
  </div> -->
</body>

</html>