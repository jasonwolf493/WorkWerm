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
//echo "Connected successfully ";


//get userinfo
$search = $_GET['search'];





//protect DB
$search = stripslashes($search);
$search = trim($search);

//Create error var to tell user what went wrong
$error = 'none';
//check if confirmation data is that same
echo $search;

if($error=='none'){


    //begin transmission
    $sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo"<h1>Search results</h1>";
        $error .= "exists";
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["username"]. " - Name: " . $row["fname"]. " " . $row["lname"]. "<br>";
        }
        //header('Location: register.php?error=' . $error);
        //session_start();



    }else{
        // output data of each row
        //$sql = "INSERT INTO users (fname, lname, email, password, username, vericode)
        //VALUES ('$myfirstname', '$mylastname', '$myemail', '$mypassword', '$myusername', '$code' )";

        if ($conn->query($sql) === TRUE) {
            //mail("jasonwolf493@gmail.com","My subject","Click this link to activate your account! http://localhost:8888/WorkWerm/verify.php?code=$code&username=$myusername");
           // header('Location: index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
        $conn->close();
}else{
    //echo "ERRORis:$error:";
    header('Location: register.php?error='.$error);
}



?>