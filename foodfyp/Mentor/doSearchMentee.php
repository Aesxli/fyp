<?php

$NRIC_Input = isset($_POST['NRIC_Input']) ? $_POST['NRIC_Input'] : '';
$Campaign_ID = isset($_GET['Campaign_ID']) ? $_GET['Campaign_ID'] : '';

$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$querySelect = "SELECT * FROM claimants WHERE Claimants_NRIC LIKE '%$NRIC_Input%'";

$searchClaimant = mysqli_query($link, $querySelect) or die(mysqli_error($link));

$arrResult = [];

while ($row = mysqli_fetch_assoc($searchClaimant)) {

    $arrResult[] = $row;
}




mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Claimants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="searchMentee.css" />
    <link rel="stylesheet" href="addMenteePage.css" />
</head>

<body>

    <?php include "addMenteePage.php" ?>
    <?php
    if (mysqli_num_rows($searchClaimant) == 0) {
        echo '<div class="box"><p style="text-align:center; color: white">No records found</p></div>';
    } else {
    ?>

        <div class="container my-4">
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NRIC</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < mysqli_num_rows($searchClaimant); $i++) {
                                $Claimant_ID = $arrResult[$i]['Claimants_Id'];
                                $Claimant_NRIC = $arrResult[$i]['Claimants_NRIC'];
                                $Claimant_name = $arrResult[$i]['Claimants_name'];
                                $Claimant_email = $arrResult[$i]['Claimants_email'];
                            ?>
                                <tr>
                                    <td><?php echo $Claimant_NRIC; ?></td>
                                    <td><?php echo $Claimant_name; ?></td>
                                    <td><?php echo $Claimant_email; ?></td>
                                    <td>
                                        <!-- <button class="btn btn-success" onclick="location.href='addMenteeToCampaign.php?Campaign_ID=<?php echo $Campaign_ID; ?>'">
                                            Add
                                        </button> -->

                                        <form action="doAddMenteePage.php" method="POST">
                                            <input type="hidden" name="Claimant_ID" value="<?php echo $Claimant_ID; ?>">
                                            <input type="hidden" name="Campaign_ID" value="<?php echo $Campaign_ID; ?>">
                                            <button class="btn btn-success" type="submit" onclick="location.href='doAddMenteePage.php?Campaign_ID=<?php echo $Campaign_ID; ?>&Campaign_ID=<?php echo $Campaign_ID; ?>'" class="btn btn-success">
                                                Add
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- <button class="btn btn-warning" onclick="location.href='editMenteeInfo.php?Claimants_ID=<?php echo $Claimant_ID; ?>&Campaign_ID=<?php echo $Campaign_ID; ?>'">
                                            Edit
                                        </button> -->
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>