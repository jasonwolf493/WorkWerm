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
$error = 'none';

//get userinfo
$username = $_POST['username'];
$rawpassword = $_POST['password'];

if(strlen($rawpassword) < 8)
{
    $error = "short";
}

if(strlen($rawpassword) > 20)
{
    $error = "long";
}
if(!preg_match("#[0-9]+#", $rawpassword))
{
    $error = "num";
}



$password = sha1($_POST['password']);
$confirmpassword = sha1($_POST['confirmpassword']);
$email = $_POST['email'];
$confirmemail = $_POST['confirmemail'];

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
//echo " username: $username";
//echo " password: $password";
//echo " confirm password: $confirmpassword";
//echo " email: $email";
//echo " confirm email: $confirmemail";


//protect DB
$myusername = stripslashes($username);
$mypassword = stripslashes($password);
$mypasswordconfirm = stripslashes($confirmpassword);
$myemail = stripslashes($email);
$myemailconfirm = stripslashes($confirmemail);
$myfirstname = stripslashes($firstname);
$mylastname = stripslashes($lastname);
$myusername = trim($username);
$mypassword = trim($password);
$mypasswordconfirm = trim($confirmpassword);
$myemail = trim($email);
$myemailconfirm = trim($confirmemail);
$myfirstname = trim($firstname);
$mylastname = trim($lastname);


$code = mt_rand(1000,9999);

//Create error var to tell user what went wrong

//check if confirmation data is that same
if($mypassword == $mypasswordconfirm){
    //echo"EQUAL PASSWORDS";
} else {
    //echo "NOT EQUAL";
    $error.="password";

}
if($myemail == $myemailconfirm){
    //echo"EQUAL email";

} else {
    //echo "NOT EQUAL";
    $error.="email";

}
if($error=='none'){


    //begin transmission
    $sql = "SELECT * FROM users WHERE username = '$myusername' || email = '$myemail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error .= "exists";
        header('Location: register.php?error=' . $error);
        session_start();



    }else{
        // output data of each row
        $sql = "INSERT INTO users (fname, lname, email, password, username, vericode)
        VALUES ('$myfirstname', '$mylastname', '$myemail', '$mypassword', '$myusername', '$code' )";

        if ($conn->query($sql) === TRUE) {
            mail("jasonwolf493@gmail.com","My subject","Click this link to activate you account! http://localhost:8888/WorkWerm/verify.php?code=$code&username=$myusername");
            header('Location: index.php');
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