
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
        <div class="title">INSERT MATCH DETAILS</div>
        
        <form action="#" method="POST">
        <div class="form">
            <h4 class="section">MATCH INFO</h4>

            <!-- <div class="inputField">
                <label>Player ID</label>
                <input type="number" class="input" placeholder=" Enter Player ID" name="player_id" required>
            </div> -->
            
            <div class="inputField">
                <label>Match Date</label>
                <input type="date" class="input" placeholder=" Enter Match Date" name="match_date" required>
            </div>  

            <div class="inputField">
                <label>Home Team ID</label>
                <input type="number" class="input" placeholder=" Enter Home Team ID" name="home_team_id">
            </div>  

            <div class="inputField">
                <label>Away Team ID</label>
                <input type="number" class="input" placeholder=" Enter Away Team ID" name="away_team_id">
            </div>  


            <div class="inputField">
                <label>Result</label>
                <input type="text" class="input" placeholder=" Enter Result" name="result" required>

            </div>


            <div class="inputField">
                <label>Venue ID</label>
                <input type="number" class="input" placeholder=" Enter Venue ID" name="venue_id">
            </div>

            <div class="inputField">
                <input type="submit" value="INSERT" class="btn" name="insert">
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

// check if user is logged admin user


// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit;
}

if (isset($_POST['insert'])) {
    // Retrieve form data
    $match_date = $_POST['match_date'];
    $home_team_id = $_POST['home_team_id'];
    $away_team_id = $_POST['away_team_id'];
    $result = $_POST['result'];
    $venue_id = $_POST['venue_id'];
    $venue_name = $_POST['venue_name'];

    // Check for empty fields
    if(empty($match_date) || empty($home_team_id) || empty($away_team_id)|| empty($venue_id)) {
        echo "<script>alert('Please fill all fields')</script>";
    }
    
    else{
    // // Read the home Id and opponent id matches table
    // $query_home = mysqli_insert_id($conn);
    // $result_home = mysqli_query($conn, $query_home);
    
    // $query_away = mysqli_insert_id($conn);
    // $result_away = mysqli_query($conn, $query_away);

    // // read venue id from venue table
    // $query_venue = mysqli_insert_id($conn);
    // $result_venue = mysqli_query($conn, $query_venue);

    // Insert data into database
    $query = "INSERT INTO Matches (match_date, home_team_id, away_team_id, result, venue_id) 
    VALUES ('$match_date', '$home_team_id', '$away_team_id', '$result', '$venue_id')";
    $result = mysqli_query($conn, $query);

    // Check for query execution success
    if ($result) {
        echo "<script>alert('Match details inserted successfully')</script>";
        header('location:match_best_scorer.php');
    } else {
        echo "<script>alert('Failed to insert match details')</script>";
    }
 }
}

?>

