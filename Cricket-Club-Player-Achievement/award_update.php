<?php
// Include database connection
include("database.php");

// Start session
session_start();

// Check if user is logged in
if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit();
}

// Retrieve award information based on award_id passed via GET method
if (isset($_GET['award_id'])) {
    $award_id = $_GET['award_id'];

    $query_award = "SELECT * FROM Player 
                    NATURAL JOIN Awards 
                    NATURAL JOIN Matches 
                    NATURAL JOIN Venue 
                    NATURAL JOIN Contracts 
                    NATURAL JOIN Team 
                    WHERE award_id = '$award_id'";
    $result_award = mysqli_query($conn, $query_award);
    $row = mysqli_fetch_assoc($result_award);
} else {
    echo "<script>alert('No award selected!'); window.location='achievement.php';</script>";
}

// Handle form submission to update award details
if(isset($_POST['update'])) {
    // Retrieve form data
    $award_name = $_POST['award_name'];
    $award_category = $_POST['award_category'];
    $description = $_POST['description'];
    $match_date = $_POST['match_date'];
    $venue_name = $_POST['venue_name'];

    // Validate form data
    if(empty($award_name) || empty($award_category) || empty($description) || empty($match_date) || empty($venue_name)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {
        // Construct SQL query to update award details
        $query_update = "UPDATE Awards 
                         SET award_name = '$award_name', award_category = '$award_category', description = '$description' 
                         WHERE award_id = '$award_id'";

        $result_update = mysqli_query($conn, $query_update);

        // Check for query execution success
        if($result_update) {
            echo "<script>alert('Award details updated successfully!'); window.location='achievement.php';</script>";
        } else {
            echo "<script>alert('Update Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player Achievement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">UPDATE PLAYER ACHIEVEMENT DETAILS</div>

        <form action="#" method="POST">
            <div class="form">
                <h4 class="section">Achievement Details</h4>

                <div class="inputField">
                    <label>Player Name</label>
                    <select class="input" name="player_id" required>
                        <option value="">Select Player</option>
                        <?php 
                        $query_players = "SELECT * FROM Player";
                        $result_players = mysqli_query($conn, $query_players);
                        while($player = mysqli_fetch_assoc($result_players)) { ?>
                            <option value="<?php echo $player['player_id']; ?>" <?php if($player['player_id'] == $row['player_id']) echo 'selected'; ?>><?php echo $player['first_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inputField">
                    <label>Award Name</label>
                    <input type="text" class="input" value="<?php echo $row['award_name']; ?>" name="award_name" required>
                </div>  

                <div class="inputField">
                    <label>Award Category</label>
                    <input type="text" class="input" value="<?php echo $row['award_category']; ?>" name="award_category" required>
                </div>  

                <div class="inputField">
                    <label>Description</label>
                    <input type="text" class="input" value="<?php echo $row['description']; ?>" name="description" required>
                </div>  

                <div class="inputField">
                    <label>Match Date</label>
                    <input type="date" class="input" value="<?php echo $row['match_date']; ?>" name="match_date" required>
                </div>  


                <div class="inputField">
                    <label>Venue Name</label>
                    <select class="input" name="venue_name" required>
                        <option value="">Select Venue</option>
                        <?php 
                        $query_venues = "SELECT * FROM Venue";
                        $result_venues = mysqli_query($conn, $query_venues);
                        while($venue = mysqli_fetch_assoc($result_venues)) { ?>
                            <option value="<?php echo $venue['venue_name']; ?>" <?php if($venue['venue_name'] == $row['venue_name']) echo 'selected'; ?>><?php echo $venue['venue_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inputField">
                    <input type="submit" value="UPDATE" class="btn" name="update">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
