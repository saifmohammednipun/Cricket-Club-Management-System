<?php
include("database.php");
session_start();

if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit();
}

// echo "<h1>Welcome " . $_SESSION['username'] . "</h1>";

$player_id = $_GET['player_id'];

// Fetch player contract & installment details
$query_player = "SELECT * FROM Contracts NATURAL JOIN Installment NATURAL JOIN Player NATURAL JOIN Club NATURAL JOIN Team WHERE player_id = '$player_id'";
$result = mysqli_query($conn, $query_player);
$row = mysqli_fetch_assoc($result);

// Fetch all clubs
$query_clubs = "SELECT club_id, club_name FROM Club";
$result_clubs = mysqli_query($conn, $query_clubs);
$clubs = mysqli_fetch_all($result_clubs, MYSQLI_ASSOC);

// Fetch all teams
$query_teams = "SELECT team_id, team_name FROM Team";
$result_teams = mysqli_query($conn, $query_teams);
$teams = mysqli_fetch_all($result_teams, MYSQLI_ASSOC);
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
        <div class="title">UPDATE Player Contract</div>
        <form action="#" method="POST">
            <div class="form">
                <h4 class="section">PLAYER CONTRACT</h4>

                <input type="hidden" value="<?php echo $player_id; ?>" name="player_id">

                <div class="inputField">
                    <label>Club</label>
                    <select name="club_id" class="input" required>
                        <?php foreach ($clubs as $club): ?>
                            <option value="<?php echo $club['club_id']; ?>" <?php if ($club['club_id'] == $row['club_id']) echo 'selected'; ?>>
                                <?php echo $club['club_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> 

                <div class="inputField">
                    <label>Team</label>
                    <select name="team_id" class="input" required>
                        <?php foreach ($teams as $team): ?>
                            <option value="<?php echo $team['team_id']; ?>" <?php if ($team['team_id'] == $row['team_id']) echo 'selected'; ?>>
                                <?php echo $team['team_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div> 

                <div class="inputField">
                    <label>Honorarium Amount</label>
                    <input type="number" value="<?php echo $row['total_amount']; ?>" class="input" placeholder="Enter Total Amount" name="total_amount">
                </div> 

                <div class="inputField">
                    <label>Terms</label>
                    <input type="text" value="<?php echo $row['terms']; ?>" class="input" placeholder="Enter Terms" name="terms" required>
                </div>  

                <div class="inputField">
                    <label>Start Date</label>
                    <input type="date" value="<?php echo $row['start_date']; ?>" class="input" placeholder="Enter Start Date" name="start_date" required>
                </div>  

                <div class="inputField">
                    <label>End Date</label>
                    <input type="date" value="<?php echo $row['end_date']; ?>" class="input" placeholder="Enter End Date" name="end_date" required>
                </div>  

                <div class="inputField">
                    <input type="submit" value="UPDATE" class="btn" name="update">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve form data
    $player_id = $_POST['player_id'];
    $total_amount = $_POST['total_amount'];
    $total_installment_number = $_POST['total_installment_number'];
    $terms = $_POST['terms'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $club_id = $_POST['club_id'];
    $team_id = $_POST['team_id'];

    // Check for empty fields
    if (empty($total_amount) || empty($terms) || empty($start_date) || empty($end_date) || empty($club_id) || empty($team_id)) {
        echo "<script>alert('Please fill all required fields')</script>";
    } else {
        // Construct SQL query
        $query_contract = "UPDATE Contracts
                  SET total_amount = '$total_amount', terms = '$terms', start_date = '$start_date', end_date = '$end_date', club_id = '$club_id', team_id = '$team_id'
                  WHERE player_id = '$player_id'";

    
        // Execute SQL query
        $result1 = mysqli_query($conn, $query_contract);

        // Check for query execution success
        if ($result1) {
            echo "<script>alert('Database updated successfully!');</script>";
            header('location:player_contracts.php');
        } else {
            echo "<script>alert('Update Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
