<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_system";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get order details
$sql = "SELECT order_id, supplier_name, order_date, item_name, quantity, order_type, status, created_at FROM orders"; // Replace 'orders' with your actual table name
$result = $conn->query($sql);

function loadNavbar() {
    $navbarPath = $_SERVER['DOCUMENT_ROOT'] . '/inventoryMSystem/navbar.php';
    if (file_exists($navbarPath)) {
        include $navbarPath;
    } else {
        echo "Navbar file not found.";
    }
}

// Call the function
loadNavbar();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

 


<div class="container mt-5">
    <h2 class="text-center mb-4">Order Inventory</h2>
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Supplier Name</th>
                <th>Order Date</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Order Type</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["supplier_name"] . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td>" . $row["item_name"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["order_type"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["created_at"] . "</td>";
                    echo "<td>
                        <a href='edit.php?id=" . $row["order_id"] . "' class='btn btn-warning btn-sm'>Edit</a>
       
                        <a href='delete.php?id=" . $row["order_id"] . "' class='btn btn-danger btn-sm'>Archive</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
