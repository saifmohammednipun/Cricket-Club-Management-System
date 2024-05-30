<?php
include ("database.php");

if($username == true)
{
    
}else{
    header('location:login.php');
}

$player_id = $_GET['player_id'];

$query_basic = "DELETE FROM Player WHERE player_id = '$player_id'";


$result1 = mysqli_query($conn, $query_basic);
if($result1) {
            echo "<script>alert('Player deleted successfully!');</script>";
            header('location:admin_dasboard.php');
} else {
    echo "<script>alert('Player deletion failed!');</script>";
    echo "Error: " . mysqli_error($conn);
}


?>