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