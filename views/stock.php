<?php

include './classes/Stock.php';        // Include the Stock class

// Create an instance of the Stock class
$stock = new Stock();
$stockLevels = $stock->getStockLevels();  // Fetch the stock levels
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Stock Levels</title>
</head>
<body>
    <h1>View Stock Levels</h1>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Location</th>
            <th>Quantity</th>
        </tr>
        <?php if (!empty($stockLevels)): ?>
            <?php foreach ($stockLevels as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                <td><?php echo htmlspecialchars($row['location']); ?></td>
                <td><?php echo htmlspecialchars($row['stock_level']); ?></td> <!-- Adjusted column to stock_level -->
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No stock levels found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
