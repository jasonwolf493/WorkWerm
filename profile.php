<?php include_once"navbar.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>WorkWerm | Activity</title>
</head>
<body>
<?php drawnav("profile");
?>

<!-- THIS IS THE CONTAINER FOR EVERYTHING BELOW THE NAV-->
<div class="activity">
    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->





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

    if(isset($_GET['user'])) {
    $loginname = $_GET['user'];


    //Create error var to tell user what went wrong
    $error = 'none';

    //begin transmission
    $sql = "SELECT username, fname, lname, id, info FROM users WHERE username = '$loginname'";
    //echo $sql;
    //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    echo"<div style='min-height: 230px; overflow: visible; border-bottom: 0; solid #e1e1e1;'>";
        while ($row = $result->fetch_assoc()) {
        echo '
        <div  style="margin: 0; " class="friendcontainer floatleft">
            <img style="margin: 0" class="profileimg" src="';
    $target_dir = "uploads/";
    $target_file = $target_dir . $loginname;


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
            <div style="margin-right:0 margin-bottom: 5px; padding-bottom:50px; height: auto; " class="friends third">
                <h3 style="margin-bottom: 35px" class="header">'.$row["fname"]." ".$row["lname"].'</h3>
<p class="normaltext">'; if($row["info"]==NULL) {
                echo'You have not added anything about yourself yet. Click edit to add something';
            }else{
                echo $row['info'];
            }
            echo'</p>';
            if($row['username']==$_SESSION['username']){
            echo'
                <a class="link3" onclick="overlay2()" href="#">Edit</a>


                ';
            }
            echo'
            </div>
        </div>';
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


echo'
<div id="overlay">
    <div style="height: 350px;">
        <form action="updateinfo.php" method="GET" enctype="multipart/form-data">
            <p class="normaltext" style="text-align: left; margin-top: 0;">Add something about yourself.</p>
            <textarea name="infotext" style="height: 255px; width: 98%; resize: none;" >
    ';//server login / DB
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

    $loginname = $_GET['user'];



    //begin transmission
    $sql = "SELECT info FROM users WHERE username = '$loginname'";
    //echo $sql;
    //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($row["info"]==NULL) {
                echo'You have not added anything about yourself yet. Type below to add something.';
            }else{
                echo $row['info'];
            }
            echo'';
        }


    }else{
    if ($conn->query($sql) === TRUE) {
    }
    else
    {

    }
        $conn->close();
}

    echo'
    </textarea>
            <input class="postbutton" type="submit" value="Submit" name="submit" style="float: left; margin-top: 10px;">
        </form>
        <a class="link4" href="#" onclick="overlay2()" style="float: right; margin-top: 34px;">Close</a>
    </div>
</div>';
echo'

<script>

    function overlay2() {
        el = document.getElementById("overlay");

        el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

    }
</script>
';

?>



</div>
</body>
</html>