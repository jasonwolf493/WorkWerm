<?php
include_once "clearsession.php";
//server login / DB
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "workwerm";

$error = '';
session_start();



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loginusername = $_GET['username'];
$code = $_GET['code'];


//protect DB
$myusername = stripslashes($loginusername);
$myusername = trim($loginusername);
$mycode = stripslashes($code);
$mycode = trim($code);




    //begin transmission
    $sql = "SELECT username, vericode,verified FROM users WHERE username ='$myusername' AND vericode='$mycode'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        //echo">0";
        // output data of each row
        $sql = "UPDATE users SET verified='1' WHERE username='$myusername'";

        if ($conn->query($sql) === TRUE) {
            header('Location: index.php');
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }else{
        $error .= "code";
        header('Location: index.php?error=' . $error);

    }
    $conn->close();

?>