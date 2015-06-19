<?php
function clearsession(){
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

}
