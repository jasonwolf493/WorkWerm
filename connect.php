<?php
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


//get login info
    $loginusername = $_POST['username'];
    $loginpassword = sha1($_POST['password']);
//echo "$loginusername";
//echo "$loginpassword";

//protect DB
    $myusername = stripslashes($loginusername);
    $mypassword = stripslashes($loginpassword);
    $myusername = trim($myusername);
    $mypassword = trim($mypassword);


    $sql = "SELECT * FROM users WHERE username = '$loginusername' && password = '$loginpassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();


        // output data of each row
        while ($row = $result->fetch_assoc()) {
            //echo " id: " . $row["id"] . " - Name: " . $row["fname"] . " " . $row["lname"] . " " . $row["username"] . "<br>";
            $_SESSION["firstname"] = $row["fname"];
            $_SESSION["lastname"] = $row["lname"];
            $_SESSION["verified"] = $row["verified"];
        }
        if($_SESSION["verified"]==1){
            header('Location: activity.php');
        }else{
            header('Location: index.php?error=veri');
        }

    } else {

        header('Location: index.php?error=true');
        echo " 0 results";
    }
    $conn->close();
?>