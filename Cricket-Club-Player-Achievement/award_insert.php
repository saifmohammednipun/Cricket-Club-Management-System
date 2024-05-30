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

// Handle form submission to insert new award
if(isset($_POST['insert'])) {
    // Retrieve form data
    $player_id = $_POST['player_id'];
    $award_name = $_POST['award_name'];
    $award_category = $_POST['award_category'];
    $description = $_POST['description'];
    $match_id = $_POST['match_id'];
    $venue_id = $_POST['venue_id'];

    // Validate form data
    if(empty($player_id) || empty($award_id) || empty($award_category) || empty($description) || empty($match_id) || empty($venue_id)) {
        echo "<script>alert('Please fill all required fields');</script>";
    } else {
        // Construct SQL query to insert new award
        $query_insert = "INSERT INTO Awards (player_id, award_id, award_category, description, match_id, venue_id) 
                         VALUES ('$player_id', '$award_id', '$award_category', '$description', '$match_id', '$venue_id')";

        $result_insert = mysqli_query($conn, $query_insert);

        // Check for query execution success
        if($result_insert) {
            echo "<script>alert('New award inserted successfully!'); window.location='achievement.php';</script>";
        } else {
            echo "<script>alert('Insertion Failed!');</script>";
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
    <title>Insert Player Achievement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="title">INSERT PLAYER ACHIEVEMENT DETAILS</div>

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
                            <option value="<?php echo $player['player_id']; ?>"><?php echo $player['first_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inputField">
                    <label>Match Date</label>
                    <select class="input" name="match_date" required>
                        <option value="">Select Match Date</option>
                        <?php 
                        $query_match = "SELECT * FROM Matches";
                        $result_match = mysqli_query($conn, $query_match);
                        while($match = mysqli_fetch_assoc($result_match)) { ?>
                            <option value="<?php echo $match['match_id']; ?>"><?php echo $match['match_date']; ?></option>
                        <?php } ?>
                    </select>
                </div>




                <div class="inputField">
                    <label>Award Name</label>
                    <input type="text" class="input" name="award_name" required>
                </div>  

                <div class="inputField">
                    <label>Award Category</label>
                    <input type="text" class="input" name="award_category" required>
                </div>  

              

                <div class="inputField">
                    <label>Description</label>
                    <input type="text" class="input" name="description" required>
                </div>  


                <div class="inputField">
                    <label>Venue Name</label>
                    <select class="input" name="venue_name" required>
                        <option value="">Select Venue</option>
                        <?php 
                        $query_venues = "SELECT * FROM Venue";
                        $result_venues = mysqli_query($conn, $query_venues);
                        while($venue = mysqli_fetch_assoc($result_venues)) { ?>
                            <option value="<?php echo $venue['venue_id']; ?>"><?php echo $venue['venue_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="inputField">
                    <input type="submit" value="INSERT" class="btn" name="insert">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
