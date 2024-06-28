<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$Campaign_ID = $_GET['Campaign_ID'] ?? '';
$Campaign_Name = $_GET['Campaign_Name'] ?? '';


$querySelect = "
SELECT c.Claimants_NRIC, c.Claimants_name, c.Claimants_email, ca.Campaign_name, c.Claimants_Id
FROM claimants AS c
JOIN campaign_has_claimants AS cc ON cc.Claimants_Id = c.Claimants_Id
JOIN campaign AS ca ON ca.Campaign_Id = cc.Campaign_Id
WHERE cc.Campaign_Id = '$Campaign_ID';
";
$searchClaimant = mysqli_query($link, $querySelect) or die(mysqli_error($link));


mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentees in Campaign</title>
    <script src="https://kit.fontawesome.com/76304b6e6b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="searchMentee.css" />
    <link rel="stylesheet" href="addMenteePage.css" />
    <link rel="stylesheet" href="dialog.css" />
</head>

<body>
    <header>
        <div class="header-content">
            <a href="mentorhome.php">
                <img src="../images/Daco_2767433.png" alt="back Icon" class="back-icon" />
            </a>
            <div class="text-container">
                <h1><?php echo $Campaign_Name; ?></h1>
                <h4>Claimants for <?php echo $Campaign_Name; ?></h4>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <div class="table-wrapper">
            <div class="table-responsive">
                <table class="table table-striped">
                    <?php
                    if (mysqli_num_rows($searchClaimant) == 0) {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    } else {
                    ?>
                        <thead class="table-blue">
                            <tr>
                                <th>NRIC</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($searchClaimant)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['Claimants_NRIC']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Claimants_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Claimants_email']); ?></td>
                                    <td>
                                        <button class="edit-button" onclick="location.href='editMenteeInfo.php?Claimants_ID=<?php echo $row['Claimants_Id']; ?>&Campaign_ID=<?php echo $Campaign_ID; ?>&Campaign_Name=<?php echo htmlspecialchars($row['Campaign_name']); ?>'">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="coupon-button" onclick="location.href='assignCoupon.php?Claimants_ID=<?php echo $row['Claimants_Id']; ?>&Campaign_ID=<?php echo $Campaign_ID; ?>'">
                                            <i class="fas fa-ticket-alt"></i>
                                        </button>
                                    </td>

                                    <td>
                                        <button class="delete-button" onclick="showDialog()" type="button">
                                            <i class="fas fa-trash"></i> </button>
                                    </td>
                                </tr>


                                <!-- Confirmation Dialog -->
                                <div class="container">
                                    <div class="overlay" id="overlay"></div>

                                    <div class="confirm-dialog" id="confirmDialog">
                                        <div class="message">
                                            <h2>Delete Claimant?</h2>
                                            <p>You will delete claimant from campaign </p>
                                        </div>
                                        <div class="buttons">
                                            <button class="keep-editing" onclick="hideDialog()">Back</button>
                                            <button class="discard-changes" onclick="location.href='deleteClaimant.php?Campaign_ID=<?php echo $Campaign_ID; ?>&Claimants_ID=<?php echo htmlspecialchars($row['Claimants_Id']); ?>'">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
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