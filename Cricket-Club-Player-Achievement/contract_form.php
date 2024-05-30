<?php
include('database.php');

session_start();

// echo "<h1>Welcome ".$_SESSION['username']."</h1>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Info</title>
    <link rel="icon" type="png" href="./nsulogo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">Player Contract Form</div>
        
        <form action="#" method="POST">
        <div class="form">
            <h4 class="section">Contract Information</h4>

            <div class="inputField">
                <label>Player ID</label>
                <input type="number" class="input" placeholder=" Enter Player ID" name="player_id" required>
            </div>
            
            <div class="inputField">
                <label>Club ID</label>
                <input type="number" class="input" placeholder=" Enter Club ID" name="club_id" required>
            </div>

            <div class="inputField">
                <label>Team ID</label>
                <input type="number" class="input" placeholder=" Enter Team ID" name="team_id" required>
            </div>

            <div class="inputField">
                <label>Honorarium Amount</label>
                <input type="number" class="input" placeholder=" Enter Amount" name="total_amount" required>
            </div>  

            <div class="inputField">
                <label>Terms</label>
                <input type="text" class="input" placeholder=" Enter Terms" name="terms">
            </div>  

            <div class="inputField">
                <label>Start Date</label>
                <input type="date" class="input" placeholder=" Enter Start Date" name="start_date" required>
            </div>

            <div class="inputField">
                <label>End Date</label>
                <input type="date" class="input" placeholder=" Enter End Date" name="end_date" required>
            </div>

            <div class="inputField">
                <input type="submit" value="Confirm" class="btn" name="insert">
            </div>

            </div>
        </form>
        </div>

    </div>

    
</body>
</html>

<?php
include("database.php");
session_start();
$username = $_SESSION['username'];
if ($username == true) {
} else {
    header('location:login.php');
}

if (isset($_POST['insert'])) {
    // Retrieve form data
    $player_id = $_POST['player_id'];
    $club_id = $_POST['club_id'];
    $team_id = $_POST['team_id'];
    $total_amount = $_POST['total_amount'];
    $terms = $_POST['terms'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];



    // Check for empty fields
    if (empty($player_id) || empty($club_id) || empty($team_id) || empty($total_amount) || empty($start_date) || empty($end_date)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {
        // Check inserted player id with the Player table's player_id
        $query_check = "SELECT player_id FROM Player WHERE player_id = '$player_id'";
        $result_check = mysqli_query($conn, $query_check);
        
        if (mysqli_num_rows($result_check) > 0) {
            // Insert into Contracts table
            $query_contract = "INSERT INTO Contracts (total_amount, terms, start_date, end_date, club_id, team_id) 
                               VALUES('$total_amount', '$terms', '$start_date', '$end_date', $club_id', '$team_id')";

            $result_contract = mysqli_query($conn, $query_contract);
            if ($result_contract) {
                // Insertion into Contracts table successful
                echo "<script>alert('Inserted in database successfully!');</script>";
                header('location:display.php');
                exit();
            } else {
                // Error inserting into Contracts table
                echo "<script>alert('Insertion Failed!');</script>";
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Player ID not found in Player table
            echo "<script>alert('Player ID not found!');</script>";
        }
    }
}


?> 