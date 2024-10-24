<?php
// Sample sales data
$salesData = [
    "Product A" => 150,
    "Product B" => 300,
    "Product C" => 250,
    "Product D" => 400,
    "Product E" => 200,
];

// Find the maximum sales value for scaling the chart
$maxSales = max($salesData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        /* Chart Styles */
        .chart {
            display: flex;
            align-items: flex-end;
            margin: 20px 0;
            height: 300px;
            border-left: 2px solid #000;
            border-bottom: 2px solid #000;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Chart Title */
        .chart-title {
            font-size: 28px;
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }

        /* Chart Legend Styles */
        .chart-legend {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        /* Legend Item */
        .legend-item {
            display: flex;
            align-items: center;
        }

        /* Legend Color Box */
        .legend-color {
            width: 15px;
            height: 15px;
            margin-right: 5px;
        }

        /* Legend Text */
        .legend-text {
            font-size: 14px;
            color: #555;
        }

        /* Bar Styles */
        .bar {
            width: 50px;
            margin: 0 10px;
            background-color: #007bff;
            text-align: center;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .bar:hover {
            background-color: #0056b3;
        }

        .label {
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="chart-title">Best Sales Chart</h1>
        <div class="chart">
            <?php foreach ($salesData as $product => $sales): ?>
                <div class="bar" style="height: <?= ($sales / $maxSales) * 100 ?>%;">
                    <?= $sales ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="labels">
            <?php foreach ($salesData as $product => $sales): ?>
                <div class="label"><?= $product ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
