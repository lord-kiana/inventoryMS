<?php
require_once '../../classes/Database.php'; // Adjust path if necessary

// Initialize database connection
$db = new Database();
$conn = $db->pdo;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'];
    $order_date = $_POST['order_date'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $order_type = 'incoming';  // Assuming all orders from this form are 'incoming'

    try {
        // Validate inputs
        if (empty($supplier_name) || empty($order_date) || empty($item_name) || $quantity <= 0) {
            throw new Exception("All fields are required and quantity must be greater than 0.");
        }

        // Insert order using prepared statements to prevent SQL injection
        $sql = "INSERT INTO orders (supplier_name, order_date, item_name, quantity, order_type) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$supplier_name, $order_date, $item_name, $quantity, $order_type]);

        echo "<div style='color: green;'>New order added successfully!</div>";
    } catch (PDOException $e) {
        echo "<div style='color: red;'>Error adding order: " . $e->getMessage() . "</div>";
    } catch (Exception $e) {
        echo "<div style='color: red;'>Validation Error: " . $e->getMessage() . "</div>";
    }
}
?>

<!-- HTML Form -->
<form method="post" action="add_order.php">
    <label>Supplier Name:</label>
    <input type="text" name="supplier_name" required><br><br>

    <label>Order Date:</label>
    <input type="date" name="order_date" required><br><br>

    <label>Item Name:</label>
    <input type="text" name="item_name" required><br><br>

    <label>Quantity:</label>
    <input type="number" name="quantity" required><br><br>

    <input type="submit" value="Add Order">
</form>
