<?php
session_start();
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
//echo "Connected successfully ";
$error = 'none';


if($error=='none'){


    // sql to delete a record
    $sql = "DELETE FROM comments WHERE commentid='".$_GET['id']."'";

    if ($conn->query($sql) === TRUE) {
        header('Location: activity.php');
    } else {
        header('Location: activity.php?error='.$error);
    }

    $conn->close();
}else{
    //echo "ERRORis:$error:";
    header('Location: activity.php?error='.$error);
}



?>