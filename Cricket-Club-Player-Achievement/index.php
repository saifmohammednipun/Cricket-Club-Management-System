<?php
    include("database.php");

    $sql = "INSERT INTO playerinfo (name, age, gpa) 
            VALUES ('Saif', 24,  3.7)";
    $result = mysqli_query($sql);
    
    try{
        mysqli_query($conn, $sql);
    }catch(Exception $e){
        echo "". $e->getMessage();
    }
    mysqli_close($conn);
 ?>