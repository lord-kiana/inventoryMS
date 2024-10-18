<?php

class Stock
{
    // Method to add a new product
    public function addProduct($productName, $quantity, $category, $location)
    {
        // Add product to the database
        return "Product {$productName} added with quantity {$quantity}";
    }

    // Method to update an existing product
    public function updateProduct($productId, $newDetails)
    {
        // Update product details in the database
        return "Product ID {$productId} updated";
    }

    // Method to view stock levels across multiple locations
    public function viewStockLevels()
    {
        // Sample output
        return [
            ['location' => 'Warehouse 1', 'product' => 'Widget A', 'stock' => 100],
            ['location' => 'Warehouse 2', 'product' => 'Widget B', 'stock' => 50]
        ];
    }

    // Method to transfer stock between branches
    public function transferStock($productId, $fromLocation, $toLocation, $quantity)
    {
        // Logic for transferring stock
        return "Transferred {$quantity} of Product ID {$productId} from {$fromLocation} to {$toLocation}";
    }
}

?>
