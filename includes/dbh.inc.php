<?php

    $server = "localhost";
    $dbuname = "root";
    $dbpwd = "";
    $dbname = "swiDel";

    $conn = mysqli_connect($server,$dbuname,$dbpwd,$dbname);

    if(!$conn){
        die("Connection failed" . mysqli_connect_error());
    }