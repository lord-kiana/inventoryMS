<?php

// Include necessary classes
require_once 'Dashboard.php';
require_once 'Stock.php';
require_once 'Order.php';
require_once 'Archive.php';

// Instantiate the classes
$dashboard = new Dashboard();
$stock = new Stock();
$order = new Order();
$archive = new Archive();

// 1. Dashboard operations
$summary = $dashboard->getSummaryOverview();
$recentOrders = $dashboard->getRecentOrders();
$stockAlerts = $dashboard->getStockAlerts();
$graphsTrends = $dashboard->getGraphsAndTrends();

// 2. Stock management
$newProduct = $stock->addProduct('Widget Z', 200, 'Category A', 'Warehouse 1');
$stockLevels = $stock->viewStockLevels();
$transferStock = $stock->transferStock(1, 'Warehouse 1', 'Warehouse 2', 50);

// 3. Orders management
$incomingOrders = $order->incomingOrders();
$outgoingOrders = $order->outgoingOrders();
$returnOrder = $order->processReturns(201, 1, 5);

// 4. Archive
$archivedRecords = $archive->archiveRecords();

// Output (example - you can format the output for a frontend)
echo "Summary Overview: ";
print_r($summary);
echo "\nRecent Orders: ";
print_r($recentOrders);
echo "\nStock Alerts: ";
print_r($stockAlerts);
echo "\nGraphs and Trends: ";
echo $graphsTrends;
echo "\nAdd Product: ";
echo $newProduct;
echo "\nStock Levels: ";
print_r($stockLevels);
echo "\nStock Transfer: ";
echo $transferStock;
echo "\nIncoming Orders: ";
print_r($incomingOrders);
echo "\nOutgoing Orders: ";
print_r($outgoingOrders);
echo "\nReturn Process: ";
echo $returnOrder;
echo "\nArchived Records: ";
print_r($archivedRecords);

?>
