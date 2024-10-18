<?php

class Order
{
    // Method to track incoming orders
    public function incomingOrders()
    {
        // Sample data for incoming orders
        return [
            ['order_id' => 201, 'product' => 'Widget A', 'quantity' => 50, 'status' => 'Pending'],
            ['order_id' => 202, 'product' => 'Widget B', 'quantity' => 100, 'status' => 'Received']
        ];
    }

    // Method to manage outgoing orders
    public function outgoingOrders()
    {
        // Sample data for outgoing orders
        return [
            ['order_id' => 301, 'product' => 'Widget A', 'quantity' => 20, 'status' => 'Dispatched'],
            ['order_id' => 302, 'product' => 'Widget C', 'quantity' => 10, 'status' => 'Pending']
        ];
    }

    // Method to process and track product returns
    public function processReturns($orderId, $productId, $quantity)
    {
        // Logic to process returns
        return "Processed return for Order ID {$orderId}, Product ID {$productId}, Quantity {$quantity}";
    }
}

?>
