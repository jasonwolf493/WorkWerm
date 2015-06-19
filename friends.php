<?php session_start();
include_once "navbar.php";
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
<?php drawnav("friends")?>

<!-- THIS IS THE CONTAINER FOR EVERYTHING BELOW THE NAV-->
<div class="activity">
    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->
    <form action="" method="get" id="formID">
        <div style="margin-top: 0; margin-bottom: 100%" class="floatright third">
            <input  class="search" placeholder="Search People:" name="search" type="text">
            <input class="loginbutton" value="Search"  type="submit">
        </div>
    </form>
    <!----------------------------------------  S E A R C H  F O R  U S E R S  ---------------------------------------->
    <?php
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

    //get Search info if its set
    if(isset($_GET['search'])) {
        $search = $_GET['search'];

        //protect DB
        $search = stripslashes($search);
        $search = trim($search);

        //Create error var to tell user what went wrong
        $error = 'none';

        //begin transmission
        $sql = "SELECT username, fname, lname, id FROM users WHERE username LIKE  '$search' OR fname LIKE '$search' OR lname LIKE '$search'";

        //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3 style='font-family: Helvetica, sans-serif; font-size: 30pt; font-weight: lighter; color: #0087FF; margin-bottom:25px;'>Search results</h3>";
            echo"<div style='min-height: 230px; overflow: scroll; border-bottom: 2px solid #e1e1e1; margin-bottom: 5px'>";
            while ($row = $result->fetch_assoc()) {
                if($row['username']==$_SESSION['username']){}else{
                    echo '
                    <div  style="margin: 0; width: 340px" class="friendcontainer floatleft">
                        <img style="margin: 0" class="profileimg" src="img.png">
                        <div style="margin-right:0;" class="friends third">
                            <h3 class="header">'.$row["fname"]." ".$row["lname"].'</h3>
                            <a class="link3" style="margin-top: 10px;" href="profile.php">View Profile</a><p style="display: inline" class="normaltext"> |</p>
                            <a class="link3" href="http://localhost:8888/WorkWerm/friends.php?receiver='.$row["username"].'&name='.$row["fname"].' '.$row["lname"].'">Add</a>

                        </div>
                    </div>';
                }

            }
        } else {

            if ($conn->query($sql) === TRUE) {
            } else {
                echo "<h3 style='font-family: Helvetica, sans-serif; font-size: 30pt; font-weight: lighter; color: #0087FF;'>Search results</h3><br><p style='font-family: Helvetica'>No Results found.</p>";
            }
        }
        echo"<br><br></div>";
        $conn->close();

    }
    ?>

    <!-----------------------------------------  S E N D  R E Q U E S T  ---------------------------------------------->
    <?php
    if(isset($_GET['receiver'])){
        //server login / DB
        $servername = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "workwerm";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //obtain all of the vars we need
        $sender = $_SESSION['username'];
        $receiver = $_GET['receiver'];
        $rname = $_GET['name'];
        $sname = $_SESSION['firstname']." ".$_SESSION['lastname'];


        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //begin transmission
        $sql = "SELECT sender, receiver, pending FROM friends WHERE sender = '$sender' AND receiver = '$receiver' OR sender = '$receiver' AND receiver = '$sender'";

        $result = $conn->query($sql);

        //If there is a row with that data
        if ($result->num_rows > 0) {
            //tell user its already there
            echo "<p class='error'>This user is already your friend</p>";

        }else{
            $sql = "INSERT INTO friends (sender, receiver, sname, rname) VALUES ('$sender', '$receiver','$sname','$rname')";
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error";
            }
        }
        $conn->close();
    }
    ?>





    <!-----------------------------------------  S T A R T  M Y  F R I E N D S  --------------------------------------->
    <?php
    function myfriends(){
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
        //get Search info if its set
        $loginuser = $_SESSION['username'];
        //echo $loginuser;
        //Create error var to tell user what went wrong
        $error = 'none';

        //begin transmission
        $sql = "SELECT sender, receiver, pending, rname, sname FROM friends WHERE sender = '$loginuser' OR receiver = '$loginuser' ";

        //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
        $result = $conn->query($sql);

        //if there is 1 or more rows
        if ($result->num_rows > 0) {
            //echo the header(my friends) and make a div
            echo "<h3 style='font-family: Helvetica, sans-serif; font-size: 30pt; font-weight: lighter; color: #0087FF; margin-bottom:25px;'>My Friends Actual</h3>";
            echo "<div style='min-height: 230px; overflow: scroll; border-bottom: 2px solid #e1e1e1; margin-bottom: 5px'>";
            while ($row = $result->fetch_assoc()) {
                //figure out if they are the sender or receiver and select correct name
                if($row["rname"]==$_SESSION["firstname"]." ".$_SESSION["lastname"]){
                    $loginusername = $row['sender'];
                    $name = $row['sname'];
                    $profilelink = $row['sender'];
                    $receiver = true;
                }else{
                    $loginusername = $row['receiver'];
                    $name = $row['rname'];

                    $profilelink = $row['receiver'];
                    $receiver = false;
                }
                //display the other user's name
                echo '
                    <div  style="margin: 0; width: 340px" class="friendcontainer floatleft">
                        <img style="margin: 0" class="profileimg" src="img.png">
                        <div style="margin-right:0;" class="friends third">
                            <h3 class="header">'.$name.'</h3>
                             ';
                //if the current user is the receiver show them the confirm button for the request
                if($receiver==true && $row['pending']==1){
                    echo '<a class="link3" href="http://localhost:8888/WorkWerm/friends.php?confirm='.$row["sender"].'">Confirm Request</a><p style="display: inline" class="normaltext"> | </p><a class="link3" style="margin-top: 10px;" href="http://localhost:8888/WorkWerm/friends.php?remove='.$loginusername.'">Remove</a>
                        </div>
                    </div>
                    ';
                //otherwise we'll show [view profile] and [remove]
                }else{
                    echo '<a class="link3" style="margin-top: 10px;" href="profile.php?user='.$profilelink.'">View Profile</a><p style="display: inline" class="normaltext"> | </p><a class="link3" style="margin-top: 10px;" href="http://localhost:8888/WorkWerm/friends.php?remove='.$loginusername.'">Remove</a>

                        </div>
                    </div>';}

            }
        } else {
            //if there are no results and the query worked
            if ($conn->query($sql) === TRUE) {
            } else {
                //tell the user they have no friends
                echo "<h3 style='font-family: Helvetica, sans-serif; font-size: 30pt; font-weight: lighter; color: #0087FF;'>My Friends</h3><br><p style='font-family: Helvetica'>Uh looks like you don't have any friends yet.</p>";
            }
        }
        echo"<br><br></div>";
        //close connection
        $conn->close();

    }
    myfriends();
    ?>
    <!-----------------------------------------  E N D  M Y  F R I E N D S  ------------------------------------------->

    <!-----------------------------------------  S T A R T  C O N F I R M  -------------------------------------------->
    <?php
    // GET THE LOGGED IN USERS FULLNAME
    $myname = $_SESSION["firstname"]." ".$_SESSION["lastname"];

    //IF GET CONFIRMED IS SET THEN START CONFIRMING PROCESS
    if(isset($_GET['confirm'])){

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
        $sql = "SELECT sender, receiver, pending, rname, sname FROM friends WHERE pending = '1' AND receiver = '".$_SESSION['username']."' AND sender = '".$_GET["confirm"]."' ";
        $result = $conn->query($sql);

        //if only one row is selected continue, else close the connection
        if ($result->num_rows == 1) {
            $sql = "UPDATE friends
                    SET pending=0
                    WHERE pending = '1' AND receiver = '".$_SESSION['username']."' AND sender = '".$_GET["confirm"]."';";
        }
        //if query worked continue
        if ($conn->query($sql) === TRUE){
            //and reload the page so updated results immediately display
            echo '<script>window.location.reload();</script>';
        }else{}
        $conn->close();
    }else{}
    ?>
    <!-----------------------------------------  E N D  C O N F I R M  ------------------------------------------------>

    <!-----------------------------------------  R E M O V E  F R I E N D  -------------------------------------------->
    <?php
        if(isset($_GET['remove'])){
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

            // make sure the correct people are selected
            $sql = "SELECT sender, receiver, pending, rname, sname FROM friends WHERE receiver = '".$_SESSION['username']."' AND sender = '".$_GET["remove"]."' OR receiver = '".$_GET["remove"]."' AND sender = '".$_SESSION['username']."' ";

            $result = $conn->query($sql);
            //only delete if there is one row selected
            if ($result->num_rows == 1) {
                $sql = "DELETE FROM friends WHERE receiver = '".$_SESSION['username']."' AND sender = '".$_GET["remove"]."' OR receiver = '".$_GET["remove"]."' AND sender = '".$_SESSION['username']."' ";
            }
            if ($conn->query($sql) === TRUE){
                //reload to show results
                echo '<script>window.location.reload();</script>';
            }else{}
            //close the connection
            $conn->close();

        }
    ?>
    <!-----------------------------------------  E N D  R E M O V E  F R I E N D  ------------------------------------->

    <!--THIS IS HOW FRIENDS SHOULD LOOK
    <h3 style="margin-top: 25px; margin-bottom:25px;">My Friends</h3>
    <div  style="margin: 0; width: 340px" class="friendcontainer floatleft">
        <img style="margin: 0" class="profileimg" src="img.png">
        <div style="margin-right:0;" class="friends third">
            <h3 class="header">Jack Doe</h3>
            <a class="link3" style="margin-top: 10px;" href="profile.php">View Profile</a><p style="display: inline" class="normaltext"> |</p>
            <a class="link3" style="text-decoration: none; margin-top: 10px;" href="remove">Remove</a>
        </div>
    </div>
    -->


</div>
</body>
</html>