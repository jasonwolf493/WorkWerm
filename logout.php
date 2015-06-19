<?php include_once"clearsession.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <?php clearsession()?>
    <title>WorkWerm | Log Out Success</title>
</head>
<body>
<!-- Begin Navbar -->
<div class="navbar">
    <a class="logo" href="index.php">Work</a>
    <a class="logo2" href="index.php">Werm</a>
    <p class="navtext">|<a class="link" href="register.php">Sign Up</a></p>
</div>
<!-- End of Navbar -->
<div class="activity">
    <div style="margin-left: auto; margin-right: auto;" class=" third">
        <h3 class="header">Logged Out</h3>
        <p class="lighttext">You have been successfully logged out</p>
        <br>
        <a href="index.php" class="link4">Sign In</a>
    </div>
</div>
</body>
</html>