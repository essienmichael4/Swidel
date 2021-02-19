<?php

    if(isset($_POST['addAdmin'])){
        $fname = $_POST['firstName'];
        $lname = $_POST['lName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $pwdCheck = $_POST['pwdCheck'];
        $gender = $_POST['gender'];
        $location = $_POST['location'];


        $ppic = $_FILES['ppic'];
            
        require_once("./dbh.inc.php");
        require("./functions.inc.php"); 

        if (emptyField($fname) || emptyField($lname) || emptyField($username) || emptyField($email) || emptyField($pwd) || emptyField($pwdCheck) || emptyField($gender) || emptyField($location) !== false){
            header('Location: ../index.php?error=emptyFeields');
            exit();
        }

        if (invalidEmail($email) !== false){
            header('location: ../index.php?error=invalidEmail');
            exit();
        }
        if (invalidUsername($username) !== false || invalidEmail($email) !== false){
            header('location: ../index.php?error=invalidEmailorPassword');
            exit();
        }
        if (invalidPassword($pwd, $pwdCheck) !== false){
            header('location: ../index.php?error=passworddontmatch');
            exit();
        }

        setNewAdmin($conn, $fname, $lname, $username, $email, $pwd, $gender, $location, $ppic);
    }