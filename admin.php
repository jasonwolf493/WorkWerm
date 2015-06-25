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
//Create error var to tell user what went wrong
$error = 'none';

//begin transmission
$sql = "SELECT admin FROM users WHERE username = '".$_SESSION['username']."';";
//$sql = "SELECT username, fname, lname FROM users WHERE username = '$search' OR fname = '$search' OR lname = '$search'";
$result = $conn->query($sql);

//if there is 1 or more rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //display the other user's name
        if($row['admin'] == 1){
        }else{
            header('Location: index.php?error=log');
        }

    }
}else{}



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
<form method="post" action="admin.php">
    Remove user by id:
    <input type="text" name="userid">
    <input type="submit" value="Submit">
</form>

<form method="post" action="admin.php">
    Remove post by id:
    <input type="text" name="postid">
    <input type="submit" value="Submit">
</form>

<?php
//-----------------------------------  R E M O V E  U S E R  ---------------------------------------------------
if(isset($_POST['userid'])){
    echo "The User with the ID " . $_POST['userid'] . " has been removed from the database.";
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
        $sql = "DELETE FROM users WHERE id='".$_POST['userid']."'";

        if ($conn->query($sql) === TRUE) {
        } else {
        }

        $conn->close();
    }else{
    }



}

//-----------------------------------  R E M O V E  P O S T  ---------------------------------------------------
if(isset($_POST['postid'])){
    echo "The post with the ID " . $_POST['postid'] . " has been removed from the database.";
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
        $sql = "DELETE FROM comments WHERE commentid='".$_POST['postid']."'";

        if ($conn->query($sql) === TRUE) {
        } else {
        }

        $conn->close();
    }else{
    }



}
?>