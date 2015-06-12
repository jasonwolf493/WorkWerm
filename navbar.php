<?php

function drawnav(){
    if(isset($_SESSION['username'])){
        $indexlink = 'activity.php';
    }else{
        $indexlink = 'index.php';
    }
    echo '
    <!-- Begin Navbar -->
<div class="navbar">
    <a class="logo" href="'.$indexlink.'">Work</a>
    <a class="logo2" href="'.$indexlink.'">Werm</a>
    <p class="navtext"><a class="link" href="logout.php">logout</a><a class="link2 current" href="friends.php">friends</a><a class="link2" href="activity.php">activity</a><a class="link2" href="profile.php">profile</a>|</p>
</div>
<!-- End of Navbar -->
    ';
}
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 6/11/15
 * Time: 12:39 AM
 */