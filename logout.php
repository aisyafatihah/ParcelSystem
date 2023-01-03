<?php
//initialise the session
session_start();
if(isset($_SESSION['id'])){
    //destroy session 
    $_SESSION = array();
    session_destroy();
    echo "<meta http-equiv=\"refresh\" content=\"3;URL=index.php\">";

}
?>