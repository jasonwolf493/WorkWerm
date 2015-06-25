<?php include_once"navbar.php"?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>WorkWerm</title>
</head>
<body>
<?php drawnav("register")?>
<!-- End of Navbar -->
<div class="activity">
    <div class="floatleft full">
        <h3 class="header">Register</h3>
        <form action="createuser.php" method="post" id="formID" enctype="multipart/form-data">
            <?php
            if(isset($_GET['error'])){
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'exists') !== false) {
                    echo '<p class="error"> Email/username already exists. </p>';
                }
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'code') !== false) {
                    echo '<p class="error"> Incorrect code was received. </p>';
                }
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'email') !== false) {
                    echo '<p class="error"> Emails do not match. </p>';
                }
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'password') !== false) {
                    echo '<p class="error"> Passwords do not match. </p>';
                }
                if (strpos($_GET['error'], 'short') !== false) {
                    echo '<p class="error"> Password is too short, must be at least 8 characters. </p>';
                }
                if (strpos($_GET['error'], 'long') !== false) {
                    echo '<p class="error"> Password is too long, must be less than 20 characters. </p>';
                }
                if (strpos($_GET['error'], 'num') !== false) {
                    echo '<p class="error"> Password has no number. </p>';
                }
                if (strpos($_GET['error'], 'notimg') !== false) {
                    echo '<p class="error"> Upload is not an image. </p>';
                }
                if (strpos($_GET['error'], 'imgtaken') !== false) {
                    echo '<p class="error"> Image already exists. </p>';
                }
                if (strpos($_GET['error'], 'format') !== false) {
                    echo '<p class="error"> Incorrect image format. </p>';
                }
                if (strpos($_GET['error'], 'imglarge') !== false) {
                    echo '<p class="error"> Image too large. </p>';
                }
            };
            ?>
            <br>
            <input class="login floatleft username" placeholder="Username:" name="username" type="text" required="true">
            <br>
            <input class="login floatleft" placeholder="Password:" name="password" type="password" required="true">
            <br>
            <input class="login floatright" placeholder="Confirm Password:" name="confirmpassword" type="password" required="true">
            <br>
            <input class="login floatleft" placeholder="Email:" name="email" type="email" required="true">
            <br>
            <input class="login floatright" placeholder="Confirm Email:" name="confirmemail" type="email" required="true">
            <br>
            <input class="login floatleft" placeholder="First Name:" name="firstname" type="text" required="true">
            <br>
            <input class="login floatright" placeholder="Last Name:" name="lastname" type="text" required="true">
            <br>
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" required="true">
            <br>
            <input style="margin-left: 5px" class="floatleft" type="checkbox" required="true"><p style="margin-top: 3px; margin-bottom:0;" class="lighttext floatleft" >I have read and agree to the <a class="link4" href="termsofservice">Terms of Service</a></p>
            <br>
        <input style="margin-right: 550px" class="loginbutton floatleft" type="submit" name="submit" value="Submit">
        <p style="margin-top: 3px; margin-bottom:0;" class="lighttext floatleft"><a style="margin-left: 5px;" class="link4" href="index.php"> I already have an account</a> | <a class="link4" href="index.php">Sign In</a></p>

        </form>
    </div>

</div>
<div id="overlay">
    <div>
        <p>Please fill out the form.</p>
        <a class="link4" href="#" onclick="overlay()">Close</a>
    </div>
</div>

<script>
    var form = document.getElementById('formID'); // form has to have ID: <form id="formID">
    form.noValidate = true;
    form.addEventListener('submit', function(event) { // listen for form submitting
        if (!event.target.checkValidity()) {
            event.preventDefault(); // dismiss the default functionality
            overlay(); // error message
        }
    }, false);
</script>
<script>
    function overlay() {
        el = document.getElementById("overlay");
        el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
    }
</script>
<?php


?>
</body>
</html>