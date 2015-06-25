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

    if(isset($_GET['infotext'])) {
        $infoText = $_GET['infotext'];
        $loginuser = $_SESSION['username'];


        //Create error var to tell user what went wrong
        $error = 'none';

        //begin transmission
        $sql = "SELECT username, fname, lname, id, info FROM users WHERE username = '$loginuser'";
        //echo $sql;
        //$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $sql = "UPDATE users
                    SET info='$infoText'
                    WHERE username='$loginuser'";

            header('Location: profile.php?user='.$loginuser);

            $result = $conn->query($sql);
        } else {
            //not exactly 1 result
        }
        $conn->close();

    }

?>