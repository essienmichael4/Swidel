<?php
    if(!isset($_POST['addProduct'])){
        header('location: ../index.php');
    }
    
    $productName = $_POST['pName'];
    $price = (int)$_POST['price'];
    $categories = $_POST['category'];
    $stock = (int)$_POST['stock'];
    $pdate = $_POST['pdate'];
    $expdate = $_POST['expdate'];
    $ppic = $_FILES['ppic'];

    include_once("./dbh.inc.php");
    include_once("./functions.inc.php");

    if(empty($productName) || empty($price) || empty($stock)|| empty($categories) !== false){
        header("Location: ../index.php?error=emptyFields");
        exit();
    }
    $category = strtolower($categories);

    setProducts($conn, $productName, $price, $category, $stock, $pdate, $expdate, $ppic);