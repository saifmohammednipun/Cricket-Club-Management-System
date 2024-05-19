<?php

session_start();

echo "<h1>Welcome ".$_SESSION['username']."</h1>";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Player Info List</title>
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

    $query_player = "SELECT * FROM Player NATURAL JOIN Player_Education NATURAL JOIN Player_Training";

    $result = mysqli_query($conn, $query_player);

    $total = mysqli_num_rows($result);

    if($total != 0) {
        ?>
        <h2 align="center">Display Player Info List</h2>
        <center>
        <table  class="table1" border= "1" cellspacing = "7">
            <tr>
                <th>Player ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Nationality</th>
                <th>Date of Birth</th>
                <th>Age</th>
                <th>Degree</th>
                <th>Institute</th>
                <th>Passing Year</th>
                <th>Academy</th>
                <th>Specialization</th>
                <th>Operations</th>

            </tr>

        <?php
        // Fetch and display all rows
        while($row = mysqli_fetch_assoc($result)) {
            echo
            "<tr>
                <td>".$row['player_id']."</td>
                <td>".$row['first_name']."</td>
                <td>".$row['middle_name']."</td>
                <td>".$row['last_name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone_number']."</td>
                <td>".$row['nationality']."</td>
                <td>".$row['dob']."</td>
                <td>".$row['age']."</td>
                <td>".$row['degree']."</td>
                <td>".$row['institute']."</td>
                <td>".$row['passing_year']."</td>
                <td>".$row['academy']."</td>
                <td>".$row['specialization']."</td>
                
                <td><a href='update.php?player_id=$row[player_id]'><input type ='submit' value= 'Update' class='update'></a>
                
                <a href='delete.php?player_id=$row[player_id]'><input type ='submit' value= 'Delete' class='delete' onclick= 'return checkdelete()'></a>
                </td>
             
            </tr>";
        }
        
    } else {
        echo "No records found";
    }
   ?>
 </table>
</center>
    
<a href="logout.php"><input type="submit" name="" value="Logout" style="background: white; 
                                                   color: black;
                                                   height: 35px;
                                                   width: 100px;
                                                   font-size: 18px;
                                                   font-family:'Times New Roman', Times, serif;
                                                   margin-left: 45%;
                                                   border: 0;
                                                   border-radius: 5px;
                                                   cursor: pointer;"></a>
<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this record?');
    }
</script>
