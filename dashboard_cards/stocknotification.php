<?php

class StockAlert {
    private $inventory = [];
    private $lowStockThreshold;
    private $overstockThreshold;

    public function __construct($lowStockThreshold = 5, $overstockThreshold = 30) {
        $this->lowStockThreshold = $lowStockThreshold;
        $this->overstockThreshold = $overstockThreshold;
        $this->inventory = [
            'item1' => 10,
            'item2' => 5,
            'item3' => 20,
            'item4' => 2,
            'item5' => 50,
        ];
    }

    public function checkStock() {
        foreach ($this->inventory as $item => $stock) {
            if ($stock <= $this->lowStockThreshold) {
                $this->sendNotification($item, "low stock");
            } elseif ($stock >= $this->overstockThreshold) {
                $this->sendNotification($item, "overstocked");
            }
        }
    }

    private function sendNotification($item, $status) {
        echo "Alert: $item is $status (Current stock: " . $this->inventory[$item] . ")\n";
    }
}

$stockAlert = new StockAlert();
$stockAlert->checkStock();

?>

John Harvey
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Alerts</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .alert { color: red; margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Stock Alerts</h1>
    <div id="alerts">
        <?php
        if (!empty($alerts)) {
            foreach ($alerts as $alert) {
                echo "<div class='alert'>$alert</div>";
            }
        } else {
            echo "<div class='alert'>All items are at acceptable stock levels.</div>";
        }
        ?>
    </div>
</body>
</html>