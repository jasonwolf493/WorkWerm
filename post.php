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

//get userinfo
$comment = $_POST['comment'];
$loginuser = $_SESSION['username'];
$fname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];


//protect DB
$comment = stripslashes($comment);
$comment = trim($comment);


if($error=='none'){


    //begin transmission
    $sql = "SELECT * FROM comments";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $sql = "INSERT INTO comments (fname, lname, user, comment)
        VALUES ('$fname', '$lname', '$loginuser', '$comment' )";

        if ($conn->query($sql) === TRUE) {
            header('Location: activity.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
        $conn->close();
}else{
    //echo "ERRORis:$error:";
    header('Location: activity.php?error='.$error);
}



?>