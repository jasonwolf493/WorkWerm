<?php session_start()?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>WorkWerm | Activity</title>
</head>
<body>
<!-- Begin Navbar -->
<div class="navbar">
    <a class="logo" href="index.html">Work</a>
    <a class="logo2" href="index.html">Werm</a>
    <p class="navtext"><a class="link" href="logout.html">logout</a><a class="link2" href="friends.html">friends</a><a class="link2 current" href="activity.html">activity</a><a class="link2" href="profile.html">profile</a>|</p>
</div>
<!-- End of Navbar -->
<!-- THIS IS THE CONTAINER FOR EVERYTHING BELOW THE NAV-->
<div class="activity">
    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->
    <img class="profileimg" src="img.png">
    <div class="post">
        <h3 class="header"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h3>
        <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
        <form>
        <div class="areacontainer">
            <textarea class="postarea" placeholder="Type here to start a post:"></textarea>
        </div>
        <input class="uploadbutton" type="file">
        <input class="postbutton" type="submit" value="Post" name="submit">
        </form>
    </div>




    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->
    <img class="profileimg" src="img.png">
    <div class="post">
        <h3 class="header">Jane Doe</h3>
        <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
        <form>
            <div class="areacontainer">
                <textarea disabled class="postarea" >Hello, here's a post I made, Hope you like it!</textarea>
            </div>
            <a href="" class="replytext">Reply</a>
        </form>
    </div>

</div>
</body>
</html>