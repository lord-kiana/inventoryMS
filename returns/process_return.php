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

// Get the form data
$order_id = $_POST['order_id'];
$item_name = $_POST['item_name'];
$quantity = $_POST['quantity'];
$reason = $_POST['reason'];

// Insert the return into the `returns` table
$sql = "INSERT INTO returns (order_id, product_name, quantity, reason) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isis", $order_id, $item_name, $quantity, $reason);

if ($stmt->execute()) {
    // Update the order status to 'returned'
    $update_sql = "UPDATE orders SET status = 'returned' WHERE order_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $order_id);
    $update_stmt->execute();
    $update_stmt->close();

    echo "Return processed successfully.";
    header("Location: returns_list.php");  // Redirect to the returns list
    exit();
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
