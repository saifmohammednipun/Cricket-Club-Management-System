<?php

session_start();

echo "<h1>Welcome Admin, ".$_SESSION['username']."!</h1>";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Information List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-color: rgb(130,106,251);
        }
        
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
         /* New styles for button alignment */
.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center; /* Align items vertically */
    margin: 20px auto; /* Adjust margin as needed */
    width: 80%; /* Adjust width as needed */
}

/* Adjust individual button styles if needed */
.button-container a {
    text-decoration: none;
    padding: 5px 20px; /* Add padding to the buttons */
    background-color: white; /* Add background color */
    border: 1px solid black; /* Add border */
    border-radius: 5px; /* Add border radius */
    color: black; /* Add text color */
    font-size: 16px; /* Add font size */
    font-family: 'Times New Roman', Times, serif
}

.button-container a:hover {
    background-color: lavender; /* Add hover effect */
}



   </style>

</head>
<body>

<div class="button-container">
    <a href="Insert.php">Insert</a>
    <a href="contract_form_display.php">Player Contracts</a>
    <a href="match.php">Matches</a>
    <a href="match_scorer.php">Match Scorer</a>
    <a href ="award.php">Achievments</a>
    <a href="logout.php">Logout</a>
</div>


</body>
</html>


<?php
    include ("database.php");

   // Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit;
}

    $query_player = "SELECT * FROM Player NATURAL JOIN Player_Education NATURAL JOIN Player_Training NATURAL JOIN Registration";

    $result = mysqli_query($conn, $query_player);

    $total = mysqli_num_rows($result);

    if($total != 0) {
        ?>
        <h2 align="center" >PLAYER Information List</h2>
        <center>
        <table  class="table1" border= "1" cellspacing = "7">
            <tr>
                <th>First Name</th>
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
        
        while($row = mysqli_fetch_assoc($result)) {
            echo
            "<tr>
                
                <td>".$row['first_name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone_number']."</td>
                <td>".$row['nationality']."</td>
                <td>".$row['dob']."</td>
                <td>".$row['age']."</td>
                <td>".$row['degree']."</td>
                <td>".$row['institution']."</td>
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
    
<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this record?');
    }
</script>
