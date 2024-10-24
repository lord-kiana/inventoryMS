<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the order ID from the query string
$order_id = $_GET['id'];

// Fetch order details
$sql = "SELECT item_name, quantity FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Process Return</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Process Return for Order #<?php echo $order_id; ?></h2>
    <form action="process_return.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <div class="mb-3">
            <label>Item Name</label>
            <input type="text" class="form-control" name="item_name" value="<?php echo $order['item_name']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Quantity to Return</label>
            <input type="number" class="form-control" name="quantity" max="<?php echo $order['quantity']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Reason for Return</label>
            <textarea class="form-control" name="reason" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit Return</button>
    </form>
</div>
</body>
</html>
