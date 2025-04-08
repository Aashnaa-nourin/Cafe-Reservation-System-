<?php 
    session_start();
    if ($_SESSION["is_auth"] != true){
        redirect("./login.php");
    }

?>