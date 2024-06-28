<?php



$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$querySelect = "SELECT * FROM campaign";

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
  <title> Issuer Homepage</title>

  <!-- Link to your CSS file -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <script src="https://kit.fontawesome.com/76304b6e6b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="mentorhome.css" />
</head>

<body>
  <header>
    <div class="header-content">
      <div class="text-container">
        <h1>Hello, Penny!</h1>
        <h4>What would you like to do today?</h4>
      </div>
      <a href="start.html">
        <img src="../images/[CITYPNG.COM]PNG Login Logout White Icon - 800x800.png" alt="Logout Icon" class="logout-icon" />
      </a>
    </div>
  </header>

  <!-- <div class="filter-content">
      <button class="tab-button">Upcoming</button>
      <button class="tab-button">Current</button>
      <button class="tab-button">Past</button>
    </div> -->

  <ul class="filter-content">
    <button class="filter-button active-button" data-target="#current-event">
      Current
    </button>
    <button class="filter-button" data-target="#upcoming-event">
      Upcoming
    </button>

    <button class="filter-button" data-target="#past-event">Past</button>
  </ul>

  <div class="filter-sections">
    <div class="current-event-content filter-active" data-content="current-event" id="current-event">
      <?php
      for ($i = 0; $i < count($arrResult); $i++) {
      ?>

        <div class="card">
          <div class="card-header">
            <span class="badge bg-pink">Mentors: 10</span>
            <span class="badge bg-blue">Mentees: 20</span>
          </div>
          <div class="card-content d-flex flex-row">
            <img src="../images/<?php echo  $arrResult[$i]['Campaign_photo'] ?> " class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?php echo $arrResult[$i]['Campaign_name'] ?></h5>
              <p class="card-text">

                <b>Event period: </b> <br />
                <b>Coupon Type: </b>
                <br />
                <b>Total Members:</b>
              </p>
              <div class="card-button">
                <a href="campaignDescription.php?Campaign_ID=<?php echo $arrResult[$i]['Campaign_Id'] ?> " class="btn btn-blue">View more >>></a>
              </div>
            </div>
          </div>
        </div>

      <?php
      }
      ?>


    </div>
    <!-- <div class="upcoming-event-content" data-content="upcoming-event" id="upcoming-event">
      <?php
      for ($i = 0; $i < count($arrResult); $i++) {
      ?>

        <div class="card">
          <div class="card-header">
            <span class="badge bg-pink">Mentors: 10</span>
            <span class="badge bg-blue">Mentees: 20</span>
          </div>
          <div class="card-content d-flex flex-row">
            <img src="../images/<?php echo  $arrResult[$i]['Campaign_photo'] ?> " class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?php echo $arrResult[$i]['Campaign_name'] ?></h5>
              <p class="card-text">

                <b>Event period: </b> <br />
                <b>Coupon Type: </b>
                <br />
                <b>Total Members:</b>
              </p>
              <div class="card-button">
                <a href="addMenteePage.php?Campaign_ID=1" class="btn btn-blue">View more >>></a>
              </div>
            </div>
          </div>
        </div>

      <?php
      }
      ?>
    </div> -->


  </div>
  <!-- <div class="past-event-content" data-content="past-event" id="past-event">
    <?php
    for ($i = 0; $i < count($arrResult); $i++) {
    ?>

      <div class="card">
        <div class="card-header">
          <span class="badge bg-pink">Mentors: 10</span>
          <span class="badge bg-blue">Mentees: 20</span>
        </div>
        <div class="card-content d-flex flex-row">
          <img src="../images/<?php echo  $arrResult[$i]['Campaign_photo'] ?> " class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title"><?php echo $arrResult[$i]['Campaign_name'] ?></h5>
            <p class="card-text">

              <b>Event period: </b> <br />
              <b>Coupon Type: </b>
              <br />
              <b>Total Members:</b>
            </p>
            <div class="card-button">
              <a href="addMenteePage.php?Campaign_ID=1" class="btn btn-blue">View more >>></a>
            </div>
          </div>
        </div>
      </div>

    <?php
    }
    ?>
  </div> -->
  </div>

  <script src="script.js"></script>
</body>

</html>