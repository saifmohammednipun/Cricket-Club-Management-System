<?php

session_start();

//echo "<h1>Welcome ".$_SESSION['username']."!</h1>";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Information List</title>
    <link rel="stylesheet" href="style.css">
    <style>
         table {
            background-color: white;
            justify-content: center;
            align-items: center;
            margin: 30px;
         }

         .update{
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            height: 25px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
         }

         .delete{
            background-color: red;
            color: white;
            border: 0;
            outline: none;
            height: 25px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
         }
   </style>
</head>
<body>
<a href="logout.php"><input type="submit" name="" value="Logout" style="background: white; 
                                                   color: black;
                                                   height: 35px;
                                                   width: 100px;
                                                   font-size: 18px;
                                                   font-family:'Times New Roman', Times, serif;
                                                   margin-left: 90%;
                                                   border: 0;
                                                   border-radius: 5px;
                                                   cursor: pointer;"></a>

</body>
</html>


<?php
    include ("database.php");

   // Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit;
}

    $query_player = "SELECT * FROM Player Natural Join Contracts";

    $result = mysqli_query($conn, $query_player);

    $total = mysqli_num_rows($result);

    if($total != 0) {
        ?>
        <h2 align="center" >Payment Installments</h2>
        <center>
        <table  class="table1" border= "1" cellspacing = "7">
            <tr>
                <th>Contract ID</th>
                <th>Player ID</th>
                <th>Club ID</th>
                <th>Team ID</th>
                <th>Honorarium Amount</th>
                <th>Terms</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Operations</th>
            </tr>

        <?php
        // Fetch and display all rows
        while($row = mysqli_fetch_assoc($result)) {
            echo
            "<tr>
                <td>$row[contract_id]</td>
                <td>$row[player_id]</td>
                <td>$row[club_id]</td>
                <td>$row[team_id]</td>
                <td>$row[total_amount]</td>
                <td>$row[terms]</td>
                <td>$row[start_date]</td>
                <td>$row[end_date]</td>
                
                <td><a href='contract_form_update.php?player_id=$row[player_id]'><input type ='submit' value= 'Update' class='update'></a>
             
            </tr>";
        }
        
    } else {
        echo "No records found";
    }
   ?>
 </table>
</center>

<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this record?');
    }
</script>
