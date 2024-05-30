<?php

session_start();

// echo "<h1>Welcome ".$_SESSION['username']."!</h1>";


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

         .payment{
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

    $username = $_SESSION['username'];

    if($username == true)
    {
        
    }else{
        header('location:login.php');
    }

    $query_player = "SELECT * FROM Player Natural Join Contracts Natural Join Club Natural Join Team Natural Join installment";

    $result = mysqli_query($conn, $query_player);

    $total = mysqli_num_rows($result);

    if($total != 0) {
        ?>
        <h2 align="center" >PLAYER Contracts</h2>
        <center>
        <table  class="table1" border= "1" cellspacing = "7">
            <tr>
               
                <th>First Name</th>
                <th>Club Name</th>
                <th>Team Name</th>
                <th>Honorarium Amount</th>
                <th>Terms</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Payment Status</th>
                <th>Operations</th>
            </tr>

        <?php
        // Fetch and display all rows
        while($row = mysqli_fetch_assoc($result)) {
            echo
            "<tr>
                <td>$row[first_name]</td>
                <td>$row[club_name]</td>
                <td>$row[team_name]</td>
                <td>$row[total_amount]</td>
                <td>$row[terms]</td>
                <td>$row[start_date]</td>
                <td>$row[end_date]</td>
                <td>$row[payment_status]</td>
                
                <td><a href='contract_form_update.php?player_id=$row[player_id]'><input type ='submit' value= 'Update' class='update'></a>
                <a href='installment_payment.php?contract_id=$row[contract_id]'><input type ='submit' value= 'Payment' class='payment'></a>
              
             
            </tr>";
        }
        
    } else {
        echo "No records found";
    }
   ?>
 </table>
</center>
    
<!-- <a href="insert.php"><input type="submit" name="" value="Insert" style="background: white; 
                                                   color: black;
                                                   height: 35px;
                                                   width: 100px;
                                                   font-size: 18px;
                                                   font-family:'Times New Roman', Times, serif;
                                                   margin-left: 45%;
                                                   border: 0;
                                                   border-radius: 5px;
                                                   cursor: pointer;"></a> -->
<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this record?');
    }
</script>
