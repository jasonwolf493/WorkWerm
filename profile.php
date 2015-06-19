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
        <div  style="margin: 0; width: 50%; " class="friendcontainer floatleft">
            <img style="margin: 0" class="profileimg" src="img.png">
            <div style="margin-right:0 margin-bottom: 5px; padding-bottom:50px; height: auto; width: 50%; " class="friends third">
                <h3 style="margin-bottom: 35px" class="header">'.$row["fname"]." ".$row["lname"].'</h3>
<p class="normaltext">'; if($row["info"]==NULL){echo'You have not added anything about yourself yet. Click edit to add something';} echo'</p>
                <a class="link3" onclick="overlay()" href="#">Edit</a>
            </div>
        </div>

        ';
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

/*
echo'
<div id="overlay">
    <div>
        <p>Please fill out the form.</p>
        <a class="link4" href="#" onclick="overlay()">Close</a>
    </div>
</div>';
echo'

<script>

    function overlay() {
        el = document.getElementById("overlay");

        el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

    }
</script>
';
*/
?>


</div>
</body>
</html>