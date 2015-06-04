<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>WorkWerm</title>
</head>
<body>
<!-- Begin Navbar -->
<div class="navbar">
    <a class="logo" href="index.html">Work</a>
    <a class="logo2" href="index.html">Werm</a>
    <p class="navtext">|<a class="link" href="index.html">Sign In</a></p>
</div>
<!-- End of Navbar -->
<div class="activity">
    <div class="floatleft full">
        <h3 class="header">Register</h3>
        <form action="createuser.php" method="post" id="formID">
            <?php
            if(isset($_GET['error'])){
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'exists') !== false) {
                    echo ' Email/username already exists. ';
                }
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'code') !== false) {
                    echo ' Incorrect code was received. ';
                }
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'email') !== false) {
                    echo ' Emails do not match. ';
                }
                //echo $_GET['error'];
                if (strpos($_GET['error'], 'password') !== false) {
                    echo ' Passwords do not match. ';
                }
            };
            ?>
            <br>
            <input class="login floatleft username" placeholder="Username:" name="username" type="text" required="true">
            <br>
            <input class="login floatright" placeholder="Confirm Password:" name="confirmpassword" type="password" required="true">
            <br>
            <input class="login floatleft" placeholder="Password:" name="password" type="password" required="true">
            <br>
            <input class="login floatleft" placeholder="Email:" name="email" type="email" required="true">
            <br>
            <input class="login floatright" placeholder="Confirm Email:" name="confirmemail" type="email" required="true">
            <br>

            <input class="login floatleft" placeholder="First Name:" name="firstname" type="text" required="true">
            <br>
            <input class="login floatright" placeholder="Last Name:" name="lastname" type="text" required="true">
            <br>
            <input style="margin-left: 5px" class="floatleft" type="checkbox"><p style="margin-top: 3px; margin-bottom:0;" class="lighttext floatleft" required="true">I have read and agree to the <a class="link4" href="termsofservice">Terms of Service</a></p>
            <br>
        <input style="margin-right: 550px" class="loginbutton floatleft" type="submit" name="submit" value="Submit">
        <p style="margin-top: 3px; margin-bottom:0;" class="lighttext floatleft"><a style="margin-left: 5px;" class="link4" href="index.html"> I already have an account</a> | <a class="link4" href="index.html">Sign In</a></p>
        </form>
    </div>

</div>
<script>
    var form = document.getElementById('formID'); // form has to have ID: <form id="formID">
    form.noValidate = true;
    form.addEventListener('submit', function(event) { // listen for form submitting
        if (!event.target.checkValidity()) {
            event.preventDefault(); // dismiss the default functionality
            alert('Please, fill the form'); // error message
        }
    }, false);
</script>
</body>
</html>