<?php
include_once "navbar.php";
session_start();
if(isset($_SESSION['firstname'])){}else{
    header('Location: index.php?error=log');
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>WorkWerm | Activity</title>
</head>
<body>
<?php drawnav("activity");?>

<!-- Begin Navbar --
<div class="navbar">
    <a class="logo" href="">Work</a>
    <a class="logo2" href="">Werm</a>
    <p class="navtext"><a class="link" href="logout.php">logout</a><a class="link2" href="friends.php">friends</a><a class="link2 current" href="activity.html">activity</a><a class="link2" href="profile.html">profile</a>|</p>
</div>
<!-- End of Navbar -->
<!-- THIS IS THE CONTAINER FOR EVERYTHING BELOW THE NAV-->
<div class="activity" style="height: 10000px";>
    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->
    <img class="profileimg" src="<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . $_SESSION['username'];


    if (file_exists($target_file.".jpg")) {
        echo "$target_file".".jpg";
    }
    elseif (file_exists($target_file.".jpeg")) {
        echo "$target_file".".jpeg";
    }
    elseif (file_exists($target_file.".png")) {
        echo "$target_file".".png";
    }
    elseif (file_exists($target_file.".gif")) {
        echo "$target_file".".gif";
    }
    else{
        echo "img.png";
    }

    echo'">';

    ?>
    <div class="post">
        <h3 class="header"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h3>
        <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
        <form action="post.php" method="post" enctype="multipart/form-data">
            <div class="areacontainer">
                <textarea class="postarea" name="comment" placeholder="Type here to start a post:"></textarea>
            </div>
            <input class="uploadbutton" type="file">
            <input class="postbutton" type="submit" value="Post" name="submit">
        </form>
    </div>



    <!-- THIS HOLDS A COMPLETE POST TOGETHER
    <img class="profileimg" src="img.png">
    <div class="post">
        <h3 class="header">Jane Doe</h3>
        <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT
        <form>
            <div class="areacontainer">
                <textarea disabled class="postarea" >Hello, here's a post I made, Hope you like it!</textarea>
            </div>
            <a href="" class="replytext">Reply</a>
        </form>
    </div>
    -->

<?php

function replyBox(){
    echo'
        <h3 class="header">'. $_SESSION["firstname"] .' '. $_SESSION["lastname"] .'</h3>
<!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
<form action="post.php" method="post" enctype="multipart/form-data">
    <div class="areacontainer">
        <textarea class="postarea" name="comment" placeholder="Type here to start a post:"></textarea>
    </div>
    <input class="postbutton" type="submit" value="Reply" name="submit">
</form>';
}


function otherReplies(){
    //server login / DB
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "workwerm";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $loginuser = $_SESSION['username'];
    //Create error var to tell user what went wrong
    $error = 'none';

    //begin transmission
    $sql = "SELECT friends.sender, friends.receiver, friends.pending,
comments.commentid, comments.comment, comments.user, comments.fname, comments.lname, comments.replyto
FROM comments
INNER JOIN friends
ON
comments.user = friends.sender OR comments.user = friends.receiver
WHERE
friends.receiver = '".$_SESSION['username']."' OR friends.sender = '".$_SESSION['username']."'
AND friends.pending = '0' AND comments.user !='$loginuser';";


    //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
    $result = $conn->query($sql);

    //if there is 1 or more rows
    if ($result->num_rows > 0) {
        //echo the header(my friends) and make a div

        while ($row = $result->fetch_assoc()) {
            //display the other user's name
            //echo $row['comment'];
            //------------------------------------------ C U R R E N T  U S E R  ADDS DELETE BUTTON------------------------------
            if ($row['user'] == $_SESSION['username']) {
                $sql = "SELECT friends.sender, friends.receiver, friends.pending,
comments.commentid, comments.comment, comments.user, comments.fname, comments.lname, comments.replyto
FROM comments
INNER JOIN friends
ON
comments.user = friends.sender OR comments.user = friends.receiver
WHERE
friends.receiver = '".$_SESSION['username']."' OR friends.sender = '".$_SESSION['username']."'
AND friends.pending = '0' AND comments.user !='$loginuser';";


                /*$sql = "SELECT
                comments.commentid, comments.comment, comments.user, comments.fname, comments.lname, comments.replyto
                FROM comments
                WHERE
                comments.user !='$loginuser'";*/
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['replyto'] == NULL && $row['user'] != $_SESSION['username']) {
                            echo '
                            <img class="profileimg" src="';
                            $target_dir = "uploads/";
                            $target_file = $target_dir . $row['user'];


                            if (file_exists($target_file . ".jpg")) {
                                echo "$target_file" . ".jpg";
                            } elseif (file_exists($target_file . ".jpeg")) {
                                echo "$target_file" . ".jpeg";
                            } elseif (file_exists($target_file . ".png")) {
                                echo "$target_file" . ".png";
                            } elseif (file_exists($target_file . ".gif")) {
                                echo "$target_file" . ".gif";
                            } else {
                                echo "img.png";
                            }
                            $test = "<form method='post' action='replyPost.php' enctype='multipart/form-data'><h3 class='header'>" . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "</h3><textarea class='postarea' type='text' name='replyText' style='resize:none; height:125px; width:100%; border-radius: 5px; border: 0; display: block; margin-left: auto; margin-right: auto; padding:0;' >Type your reply here:</textarea><input type='hidden' name='commentid' value='".$row['commentid']."' /><input class='postbutton' type='submit' value='submit' name='submit' style='margin-top:15px;'></form>";
                            echo '">
                        <div class="post">
                            <h3 class="header">' . $row['fname'] . ' ' . $row['lname'] . '</h3>
                            <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
                            <form>
                                <div class="areacontainer">
                                    <textarea disabled class="postarea" >' . $row['comment'] . '</textarea>
                                </div>
                                <a href="#" id="replyButton'.$row['commentid'].'" class="replytext">Reply</a>

                                <script>
                                    document.getElementById("replyButton'.$row['commentid'].'").onclick = function reply(e){
                                    e.preventDefault()
                                    document.getElementById("demo'.$row['commentid'].'").innerHTML = "'.$test.'"
                                    };

                                </script>

                        </div></form>';
                            echo'<div class="post" id="demo'.$row['commentid'].'" style="display: none; "></div>';



                            // back up <form id="demo'.$row['commentid'].'" method="post" action="replyPost.php" enctype="multipart/form-data" style="display:none; visibility:hidden; background-color: #e1e1e1; z-index:99; position: relative; border-radius:5px; margin-left:110px; height:190px;"></form>';


                            echo'<script>
                            document.getElementById("replyButton'.$row['commentid'].'").onclick = function disply(e){
                            e.preventDefault()
                                el = document.getElementById("demo'.$row['commentid'].'");

                                    //var div = document.getElementById("newpost");
                                if (el.style.display !== "none") {
                                    el.style.display = "none";
                                }
                                else {
                                    el.style.display = "block";
                                }
                                el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
                                document.getElementById("demo'.$row['commentid'].'").innerHTML = "'.$test.'"
                                }
                                </script>';
                        }
                        //use function here to get replies
                        replies($row['commentid']);

                    }
                }
            }
        }
    }else{
        //if there are no results and the query worked
        if ($conn->query($sql) === TRUE) {
        } else {
            //tell the user they have no friends
            echo "<p style='font-family: Helvetica'>Looks like no one has commented yet.</p>";
        }
    }
    //close connection
    $conn->close();

}
function replies($id){
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "workwerm";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT comments.commentid, comments.comment, comments.user, comments.fname, comments.lname, comments.replyto
                FROM comments
                WHERE comments.replyto = $id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                                        <img style="margin-left: 30px;" class="profileimg" src="';
                $target_dir = "uploads/";
                $target_file = $target_dir . $row['user'];


                if (file_exists($target_file.".jpg")) {
                    echo "$target_file".".jpg";
                }
                elseif (file_exists($target_file.".jpeg")) {
                    echo "$target_file".".jpeg";
                }
                elseif (file_exists($target_file.".png")) {
                    echo "$target_file".".png";
                }
                elseif (file_exists($target_file.".gif")) {
                    echo "$target_file".".gif";
                }
                else{
                    echo "img.png";
                }

                echo'">
                                    <div class="post" style="margin-left: 140px">
                                        <h3 class="header">' . $row['fname'] . ' ' . $row['lname'] . '</h3>
                                        <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
                                        <form>
                                            <div class="areacontainer">
                                                <textarea disabled class="postarea" >' . $row['comment'] . '</textarea>
                                            </div>';
                    if($row['user']==$_SESSION['username']){
                        echo'<a class="link4" href="deletepost.php?id=' . $row['commentid'] . '">Delete</a>';
                    }
                echo'


                                        </form>
                                    </div>';
            }
        }else{
    //if there are no results and the query worked
    if ($conn->query($sql) === TRUE) {
    } else {
        //tell the user they have no friends
        //echo "<p style='font-family: Helvetica'>Looks like no one has commented yet.</p>";
    }
}
//close connection
$conn->close();
}
function posts(){
    //server login / DB
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "workwerm";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $loginuser = $_SESSION['username'];
    //Create error var to tell user what went wrong
    $error = 'none';

    //begin transmission
    $sql = "SELECT friends.sender, friends.receiver, friends.pending,
comments.commentid, comments.comment, comments.user, comments.fname, comments.lname, comments.replyto
FROM comments
INNER JOIN friends
ON
comments.user = friends.sender OR comments.user = friends.receiver
WHERE
friends.receiver = '".$_SESSION['username']."' OR friends.sender = '".$_SESSION['username']."'
AND friends.pending = '0';";


    //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
    $result = $conn->query($sql);

    //if there is 1 or more rows
    if ($result->num_rows > 0) {
        //echo the header(my friends) and make a div

        while ($row = $result->fetch_assoc()) {
            //display the other user's name
            //echo $row['comment'];
            //------------------------------------------ C U R R E N T  U S E R  ADDS DELETE BUTTON------------------------------
            if ($row['user'] == $_SESSION['username']) {

                $sql = "SELECT
                comments.commentid, comments.comment, comments.user, comments.fname, comments.lname, comments.replyto
                FROM comments
                WHERE
                comments.user ='$loginuser'";


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['replyto'] == NULL) {
                            echo '
                            <img class="profileimg" src="';
                            $target_dir = "uploads/";
                            $target_file = $target_dir . $row['user'];


                            if (file_exists($target_file . ".jpg")) {
                                echo "$target_file" . ".jpg";
                            } elseif (file_exists($target_file . ".jpeg")) {
                                echo "$target_file" . ".jpeg";
                            } elseif (file_exists($target_file . ".png")) {
                                echo "$target_file" . ".png";
                            } elseif (file_exists($target_file . ".gif")) {
                                echo "$target_file" . ".gif";
                            } else {
                                echo "img.png";
                            }
                            $test = "<form method='post' action='replyPost.php' enctype='multipart/form-data'><h3 class='header'>" . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "</h3><textarea class='postarea' type='text' name='replyText' style='resize:none; height:125px; width:100%; border-radius: 5px; border: 0; display: block; margin-left: auto; margin-right: auto; padding:0;' >Type your reply here:</textarea><input type='hidden' name='commentid' value='".$row['commentid']."' /><input class='postbutton' type='submit' value='submit' name='submit' style='margin-top:15px;'></form>";
                            echo '">
                        <div class="post">
                            <h3 class="header">' . $row['fname'] . ' ' . $row['lname'] . '</h3>
                            <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
                            <form>
                                <div class="areacontainer">
                                    <textarea disabled class="postarea" >' . $row['comment'] . '</textarea>
                                </div>
                                <a href="" id="replyButton'.$row['commentid'].'" class="replytext">Reply</a>

                                <script>
                                    document.getElementById("replyButton'.$row['commentid'].'").onclick = function reply(e){
                                    e.preventDefault()
                                    document.getElementById("demo'.$row['commentid'].'").innerHTML = "'.$test.'"
                                    };

                                </script>
                                <a class="link4" href="deletepost.php?id=' . $row['commentid'] . '">Delete</a>
                            </form>
                        </div>';
                            echo'<div class="post" id="demo'.$row['commentid'].'" style="display: none; "></div>';
                            echo'<script>
                            document.getElementById("replyButton'.$row['commentid'].'").onclick = function disply(e){
                            e.preventDefault()
                                el = document.getElementById("demo'.$row['commentid'].'");

                                //var div = document.getElementById("newpost");
                                if (el.style.display !== "none") {
                                    el.style.display = "none";
                                }
                                else {
                                    el.style.display = "block";
                                }
                                el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
                                document.getElementById("demo'.$row['commentid'].'").innerHTML = "'.$test.'"
                                }
                                </script>';

                        }
                        //use function here to get replies
                        replies($row['commentid']);

                    }
                }
            } else {
            }
        }

/*
                //------------------------- O T H E R  U S E R ---------------------------------------------------------
                echo"THIS IS THE OTHER USER";
                if ($row['replyto'] == NULL) {
                    echo '
                <img class="profileimg" src="';
                    $target_dir = "uploads/";
                    $target_file = $target_dir . $row['user'];

                    $path = $target_file;
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    if (file_exists($target_file . ".jpg")) {
                        echo "$target_file" . ".jpg";
                    } elseif (file_exists($target_file . ".jpeg")) {
                        echo "$target_file" . ".jpeg";
                    } elseif (file_exists($target_file . ".png")) {
                        echo "$target_file" . ".png";
                    } elseif (file_exists($target_file . ".gif")) {
                        echo "$target_file" . ".gif";
                    } else {
                        echo "img.png";
                    }

                    echo '">
                <div class="post">
                    <h3 class="header">OTHER USER' . $row['fname'] . ' ' . $row['lname'] . '</h3>
                    <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
                    <form>
                        <div class="areacontainer">
                            <textarea disabled class="postarea" >' . $row['comment'] . '</textarea>
                        </div>
                        <a href="" id="replyButton" class="replytext">Reply</a>
                        <script>
                        document.getElementById("replyButton").onclick = function reply(){
                        document.write(5 + 6);
                        alert("heelo");
                        }

                        </script>
                    </form>
                </div>';

                    //if the current user is the receiver show them the confirm button for the request
                    // use replies func here.

                    replies($row['commentid']);
                }


            }
        }
    }else{*/
        //if there are no results and the query worked
        if ($conn->query($sql) === TRUE) {
        } else {

        }
    }
    //close connection
    $conn->close();

}
posts();
otherReplies();

?>

</div>
</body>
</html>