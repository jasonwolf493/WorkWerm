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
<div class="activity">
    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->
    <img class="profileimg" src="img.png">
    <div class="post">
        <h3 class="header"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h3>
        <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
        <form action="post.php" method="post" >
            <div class="areacontainer">
                <textarea class="postarea" name="comment" placeholder="Type here to start a post:"></textarea>
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

<?php
//echo $_SESSION['username'];
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

    //Create error var to tell user what went wrong
    $error = 'none';

    //begin transmission
    $sql = "SELECT friends.sender, friends.receiver, friends.pending,
comments.commentid, comments.comment, comments.user, comments.fname, comments.lname
FROM comments
INNER JOIN friends
ON
comments.user = friends.sender OR comments.user = friends.receiver
WHERE
friends.receiver = '".$_SESSION['username']."' OR friends.sender = '".$_SESSION['username']."'
AND friends.pending = '0'  ;";


    //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
    $result = $conn->query($sql);

    //if there is 1 or more rows
    if ($result->num_rows > 0) {
        //echo the header(my friends) and make a div

        while ($row = $result->fetch_assoc()) {
            //display the other user's name
            //echo $row['comment'];
            if($row['user']==$_SESSION['username']){
                $sql = "SELECT
                comments.commentid, comments.comment, comments.user, comments.fname, comments.lname
                FROM comments
                WHERE
                comments.user ='jasonwolf493' ;";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <img class="profileimg" src="img.png">
                        <div class="post">
                            <h3 class="header">' . $row['fname'] . ' ' . $row['lname'] . '</h3>
                            <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
                            <form>
                                <div class="areacontainer">
                                    <textarea disabled class="postarea" >' . $row['comment'] . '</textarea>
                                </div>
                                <a href="" class="replytext">Reply</a>
                                <a class="link4" href="deletepost.php?id='.$row['commentid'].'">Delete</a>
                            </form>
                        </div>';
                    }
                }else{}
            }else{
                echo'
                <img class="profileimg" src="img.png">
                <div class="post">
                    <h3 class="header">'.$row['fname'].' '.$row['lname'].'</h3>
                    <!-- THIS HOLDS THE TEXT AREA IN ITS CORRECT SPOT -->
                    <form>
                        <div class="areacontainer">
                            <textarea disabled class="postarea" >'.$row['comment'].'</textarea>
                        </div>
                        <a href="" class="replytext">Reply</a>
                    </form>
                </div>';

            //if the current user is the receiver show them the confirm button for the request
            }
        }
    } else {
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
posts();
?>

</div>
</body>
</html>