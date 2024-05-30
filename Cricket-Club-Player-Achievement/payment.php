<?php
    include("database.php");

    session_start();

    // echo "<h1>Welcome ".$_SESSION['username']."</h1>";
// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
    header('location:login.php');
    exit;
}

    $contract_id = $_GET['contract_id'];

    $query_player = "SELECT * FROM Contracts NATURAL JOIN Installment WHERE contract_id = '$contract_id'";
    
    $result = mysqli_query($conn, $query_player);

    $row = mysqli_fetch_assoc($result);
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
        <div class="title">HONORARIUM PAYMENT</div>
        
        <form action="#" method="POST">
        <div class="form">
            <h4 class="section">HONORARIUM PAYMENT</h4>

            <input type="hidden" value="<?php echo $contract_id; ?>" name="contract_id">
          
            <div class="inputField">
                <label>Installment Amount</label>
                <input type="number" value= "<?php echo $row['installment_amount'];?>" class="input" placeholder=" Enter Installment Amount" name="installment_amount" required>
            </div> 

            <div class="inputField">
                <label>Payment Date</label>
                <input type="date" value= "<?php echo $row['installment_date'];?>" class="input"  placeholder=" Enter Intallment Date" name="installment_date" required>
            </div>


            <div class="inputField">
                <input type="submit" value="PAYMENT" class="btn" name="update">
            </div>

            </div>
        </form>
        </div>

    </div>

    
</body>
</html>

<?php
include("database.php");

if(isset($_POST['update'])) {
    // Retrieve form data
    $contract_id = $_POST['contract_id'];
    $installment_amount = $_POST['installment_amount'];
    $installment_date = $_POST['installment_date'];
    $payment_status = 'Paid';

    // Check for empty fields
    if(empty($installment_amount) || empty($installment_date)) {
        echo "<script>alert('Please fill all required fields')</script>";
    } else {

        //query to get the payment status
        $query_payment_status = "SELECT payment_status FROM Installment WHERE contract_id = '$contract_id'";
        $result_payment_status = mysqli_query($conn, $query_payment_status);
        $row_payment_status = mysqli_fetch_assoc($result_payment_status);
        $payment_status = $row_payment_status['payment_status'];


        if($payment_status == 'Paid') {
            echo "<script>alert('Payment already done!')</script>";
        }else{

            // Query to get the total contract amount
         $query_total_amount = "SELECT total_amount FROM Contracts WHERE contract_id = '$contract_id'";
         $result_total_amount = mysqli_query($conn, $query_total_amount);
         $row_total_amount = mysqli_fetch_assoc($result_total_amount);
         $total_amount = $row_total_amount['total_amount']; 
            
            if($existing_user_amount <= $installment_amount) {
                // Construct SQL queries
            $query = "UPDATE Installment
            SET installment_amount = '$installment_amount', installment_date = '$installment_date', payment_status = 'Paid'
            WHERE contract_id = '$contract_id'";

            // Execute SQL queries
            $result1 = mysqli_query($conn, $query);

            // Check for query execution success
            if($result1) {
            echo "<script>alert('Payment DONE!');</script>";
            header('location:player_contracts.php');
            } else {
            echo "<script>alert('Update Failed!');</script>";
            echo "Error: " . mysqli_error($conn);
            }
                
            } else {
        
            echo "<script>alert('Installment amount is not same as total amount')</script>";
    }
        }

}
}
?>