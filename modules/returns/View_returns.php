<?php
require_once '../../classes/Database.php';

function viewReturns() {
    $db = new Database();
    $conn = $db->pdo;  // Accessing the PDO instance

    $stmt = $conn->query(
        "SELECT r.return_id, o.item_name, r.quantity, o.status, r.reason, r.return_date 
         FROM returns r 
         JOIN orders o ON r.order_id = o.order_id"
    );

    $returns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Return Records</h2>";
    echo "<table border='1'>
            <tr>
                <th>Return ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Reason</th>
                <th>Return Date</th>
            </tr>";
    foreach ($returns as $return) {
        echo "<tr>
                <td>{$return['return_id']}</td>
                <td>{$return['item_name']}</td>
                <td>{$return['quantity']}</td>
                <td>{$return['status']}</td>
                <td>{$return['reason']}</td>
                <td>{$return['return_date']}</td>
              </tr>";
    }
    echo "</table>";
}

viewReturns();
?>
