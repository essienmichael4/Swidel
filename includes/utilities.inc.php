<?php

    if(isset($_POST['edit-product-pic'])){
        $pid = $_POST['pid'];
        $ppic = $_FILES['ppic'];

        include_once("./dbh.inc.php");
        include_once("./functions.inc.php");

        

        $ppicName = $ppic['name'];
        $ppicTempName = $ppic['tmp_name'];
        $ppicSize = $ppic['size'];
        $ppicError = $ppic['error'];

        $ppicExt = explode('.', $ppicName);
        $ppicActExt = strtolower(end($ppicExt));
        $allowedExt = array('jpg', 'jpeg', 'png');
        if(in_array($ppicActExt, $allowedExt)){
            if($ppicError === 0){
                if($ppicSize < 5000000){
                    $ppicNewName = $pid.".".$ppicActExt;
                    $fileDes = '../productProfile/'.$ppicNewName;
                    
                    updatePic($conn, $ppicNewName, $pid);
                    
                    move_uploaded_file($ppicTempName, $fileDes);
                }else {
                    header("Location: ../index.php?success=fileTooBig");
                    exit();
                }
            }else {
                header("Location: ../index.php?success=errorOccured");
                exit();
                
            }
        }else {
            header("Location: ../index.php?success=typeNotAllowed");
            exit();
        }

        header("Location: ../index.php?success=picAdded");
        exit();
    } elseif(isset($_POST['buyProducts'])){
        
        include_once("./dbh.inc.php");
        include_once("./functions.inc.php");

        $pid = (int)$_POST['pid'];
        $pName = $_POST['pName'];
        $pPrice = $_POST['pPrice'];
        $stock = (int)$_POST['stock'];
        $pStock = (int)$_POST['pStock'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $uid = (int)$_POST['userid'];
        $contact = $_POST['contact'];
        $location = $_POST['location'];
        $delivery = $_POST['delivery'];
        $payment = $_POST['payment'];

        $pStock = $pStock-$stock;

        if(emptyField($delivery) || emptyField($payment)){
            header("Location: ../index.php?error=orderUnsuccessful");
            exit();
        }else{
            orderProducts($conn, $pid, $pName, $pPrice, $stock, $pStock, $uid, $username, $email, $contact, $location, $payment, $delivery);
            header("Location: ../index.php?success=orderSuccessful");
            exit();
        }

        
    }

    