<?php

    session_start();
    include("./includes/dbh.inc.php");
    include("./includes/functions.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>PEsstall</title>
</head>
<body>
<?php
    include("./src/header.php");
    include("./src/main.php");
    include("./src/footer.php");
?>