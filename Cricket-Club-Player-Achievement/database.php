<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "PlayerAchievement";    
    $conn = "";

    try{
        $conn = mysqli_connect($server, $username, $password, $database);
    }catch(mysqli_sql_exception $e){
        echo "Connection failed";
    }

    if($conn) {
        //echo "Connection is successful";
    }
?>