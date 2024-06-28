<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Simple Website</title>
    <link rel="stylesheet" href="vendor.css"> <!-- Link to your CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div id="page-container">
        <div id="black-box">
            <header>
                <div class="header-content">
                    <a href="adminhome.html">
                        <img src="../images/Daco_2767433.png" alt="back icon" class="back-icon">
                    </a>
                    <div class="text-container">
                        <h1>Vendor Details</h1>
                    </div>
                </div>
            </header>
            <div class="square">
                <form class="issuer-form" method="POST" action="doVendor.php">
                    <label for="name" class="name-label">Name:</label>
                    <input type="text" id="name" name="name" required>
                    
                    <label for="email" class="email-label">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password" class="password-label">Password: (6 or more characters)</label>
                    <input type="password" id="password" name="password" required minlength="6">

                    <div class="button-container">
                        <button type="button" id="discard">DISCARD</button>
                        <button type="submit" id="submit-button" disabled>DONE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Box -->
    <div id="modal-box" class="hidden">
        <div class="modal-content">
            <h3 id="modal-header" class="modal-header">Discard Changes?</h3>
            <p id="modal-text" class="modal-text">You will lose all changes made to this issuer.</p>
            <button id="confirm-discard">Discard Changes</button>
            <button id="cancel-discard">Keep Editing</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const $name = $('#name');
            const $email = $('#email');
            const $password = $('#password');
            const $submitButton = $('#submit-button');

            function checkFields() {
                if ($name.val() && $email.val() && $password.val()) {
                    $submitButton.prop('disabled', false);
                } else {
                    $submitButton.prop('disabled', true);
                }
            }

            $name.on('input', checkFields);
            $email.on('input', checkFields);
            $password.on('input', checkFields);
        });
    </script>
</body>
</html>
