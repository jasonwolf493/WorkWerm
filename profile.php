<?php include_once"navbar.php"?>
<!DOCTYPE html>
<html>
<head lang="en">
    <link href="main.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>WorkWerm | Activity</title>
</head>
<body>
<?php drawnav()?>

<!-- THIS IS THE CONTAINER FOR EVERYTHING BELOW THE NAV-->
<div class="activity">
    <!-- THIS HOLDS A COMPLETE POST TOGETHER -->


    <div  style="margin: 0; width: 50%" class="friendcontainer floatleft">
        <img style="margin: 0" class="profileimg" src="img.png">
        <div style="margin-right:0; width: 50%; height: 500px" class="friends third">
            <h3 style="margin-bottom: 35px" class="header">Jack Doe</h3>
            <ul>
                <li><p style="display: inline" class="boldtext">Employed at:</p><p style="display: inline" class="normaltext"> My Employer</p></li>
                <li><p style="display: inline" class="boldtext">Years:</p><p style="display: inline" class="normaltext"> 3</p></li>
                <li><p style="display: inline" class="boldtext">DOB:</p><p style="display: inline" class="normaltext"> 01/01/1980</p></li>
                <li><p style="display: inline" class="boldtext">Skills:</p><p style="display: inline" class="normaltext"> Photoshop, Ai, HTML, PHP</p></li>
                <li><p style="display: inline" class="boldtext">Education:</p><p style="display: inline" class="normaltext"> Bachelor's Web Development</p></li>
                <li><p style="display: inline" class="boldtext">Email:</p><p style="display: inline" class="normaltext"> jdoe@email.com</p></li>
                <li><p style="display: inline" class="boldtext">Phone:</p><p style="display: inline" class="normaltext"> (123)456-7890</p></li>
            </ul>
            <a class="link3" href="edit">Edit</a>
        </div>
    </div>


</div>
</body>
</html>