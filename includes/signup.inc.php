<?php
    if(isset($_POST['signupUser'])){
        $fname = $_POST['fName'];
        $lname = $_POST['lName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $pwdCheck = $_POST['pwdCheck'];
        $gender = $_POST['gender'];
        $location = $_POST['location'];
        $dob = $_POST['dob'];
        
        require_once("./dbh.inc.php");
        require("./functions.inc.php");
        

        if (emptyFields($fname,$lname,$username,$email,$pwd,$pwdCheck,$gender,$location,$dob) !== false){
            header('Location: ../index.php?error=emptyFields');
            exit();
        }

        if (invalidUsername($username) !== false){
            header('location: ../index.php?error=invalidUsername');
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
        if (takenMail($conn, $email, $username) !== false){
            header('location: ../index.php?error=mailalreadytaken');
            exit();
        }

        setUser($conn, $fname, $lname, $username, $email, $pwd, $gender, $location, $dob);
        
    }
    else{
        header('Location: ../index.php');   
    }