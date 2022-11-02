<?php
    
    //CONNECT TO MYSQL DATABASE USING MYSQLI
    $serverName     = "localhost";
    $userName       = "root";
    $userPassword   = "";
    $dbName         ="youcodescrumboard";
    global $connection;
    $connection = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    if(!$connection){
        echo "connection is failed".mysqli_connect_errno() ;
    }
    
?>