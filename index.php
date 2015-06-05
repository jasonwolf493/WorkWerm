
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
    <p class="navtext">|<a class="link" href="register.html">Sign Up</a></p>
</div>
<!-- End of Navbar -->
<div class="activity">
    <div style="height: 242px" class="floatleft third">
        <h3 class="header">Returning User</h3>

        <form action="connect.php" method="post" id="formID">
        <br>
            <?php
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                if($error=="true"){
                    echo "<p class='error'>Invalid login credentials</p>";
                }
                if($error=="veri"){
                    echo "<p class='error'>Account has not been validated, check email.</p>";
                }
                if($error=="code"){
                    echo "<p class='error'>Incorrect code</p>";
                }
                if($error=="log"){
                    echo "<p class='error'>Please login</p>";
                }
            }
            ?>
        <input class="login" placeholder="Username:" name="username" type="text" required="true">
        <br>
        <input class="login" placeholder="Password" name="password" type="password" required="true">
        <br>
        <input class="loginbutton" type="submit" name="submit" value="Submit">
        <br>
        <p style="margin-top: 3px; margin-bottom:0;" class="lighttext floatleft"><a style="margin-left: 5px;" class="link4" href="register.html"> Forgot Username/Password</a> | <a class="link4" href="register.html">Sign Up</a></p>
        </form></div>
    <div style="height: 242px" class="floatleft third">
        <h3 class="header">New User</h3>
        <p class="normaltext">If you are a new user and do not have an account yet you can follow the link below to the sign up page. The sign up is quick and simple, we promise.</p>
        <a href="register.html" class="link3">Sign Up</a>
    </div>

    <div style="height: 242px" class="floatleft third">
        <h3 class="header">About WorkWerm</h3>
        <p class="normaltext">WorkWerm is a social network focused on students and professionals. WorkWerm is a place where people can share their work and get feedback. WorkWerm has been designed to be fun and productive.</p>
    </div>
<!--      START BOTTOM DEMO-->
    <div style="width: 100%" class="floatleft">
        <h3 class="header">Screen Shots</h3>

        <div  style="overflow: scroll; height: 300px; border: 1px solid black" class="floatleft third">
            <div class="screenshot"><img src="imgs/WorkWerm1.png"></div>
        </div>
        <div  style="overflow: scroll; border: 1px solid black; height: 300px;" class="floatleft third">
            <div class="screenshot2"><img src="imgs/WorkWerm2.png"></div>
        </div>
        <div style="overflow: scroll; border: 1px solid black; height: 300px;" class="floatleft third">
            <div class="screenshot2"><img src="imgs/WorkWerm3.png"></div>
        </div>
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
    }, false);</script>
<script>
    function overlay() {
        el = document.getElementById("overlay");
        el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
    }
</script>
</body>
</html>