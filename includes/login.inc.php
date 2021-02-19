<?php
    if(!isset($_POST['login'])){
        header('location: ../index.php');
    }
    elseif(isset($_POST['admin'])){
        $username = $_POST['userName'];
        $pwd = $_POST['pwd'];

        include_once("./dbh.inc.php");
        include_once("./functions.inc.php");

        loginAdmin($conn, $username, $pwd);
    }
    else{
        $username = $_POST['userName'];
        $pwd = $_POST['pwd'];
        
        include_once("./dbh.inc.php");
        include_once("./functions.inc.php");

        loginUser($conn, $username, $pwd);
        
}