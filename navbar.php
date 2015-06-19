<?php

function drawnav($active){
    if(isset($_SESSION['username'])){
        $indexlink = 'activity.php';
        echo '
    <!-- Begin Navbar -->
        <div class="navbar">
            <a class="logo" href="'.$indexlink.'">Work</a>
            <a class="logo2" href="'.$indexlink.'">Werm</a>
            <p class="navtext"><a class="link" href="logout.php">logout</a><a class="link2 '; if($active=="friends"){echo'current';} echo '" href="friends.php">friends</a><a class="link2 '; if($active=="activity"){echo'current';} echo '" href="activity.php">activity</a><a class="link2 '; if($active=="profile"){echo'current';} echo '" href="profile.php">profile</a>|</p>
            <a class="mobileButton link" href="logout.php">logout</a>
            <img class="mobileButton" src="imgs/menubutton.png" onclick="overlay()">
        </div>
<!-- End of Navbar -->
    ';
    }else{
        $indexlink = 'index.php';
        echo '
    <!-- Begin Navbar -->
        <div class="navbar">
            <a class="logo" href="'.$indexlink.'">Work</a>
            <a class="logo2" href="'.$indexlink.'">Werm</a>
        </div>
<!-- End of Navbar -->
    ';
    }
//START TEST NAV


    echo'

            <div id="overlay2">
                    <p id="mobilenav" class="mobilenavtext"><a class="link2 '; if($active=="friends"){echo'current';} echo '" href="friends.php">friends</a><a class="link2 '; if($active=="activity"){echo'current';} echo '" href="activity.php">activity</a><a class="link2 '; if($active=="profile"){echo'current';} echo '" href="profile.php?user='.$_SESSION['username'].'">profile</a></p>
            </div>';
echo'

<script>
var width = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;
console.log(width);
    function overlay() {
        el = document.getElementById("overlay2");
        el2 = document.getElementById("mobilenav");

        el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

        el2.style.visibility = (el.style.visibility == "visible") ? "visible" : "hidden";
    }
</script>
';
}
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 6/11/15
 * Time: 12:39 AM
 */