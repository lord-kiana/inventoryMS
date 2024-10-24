<?php
require_once 'Database.php';  // Since both files are in the same directory


class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Add or update a product
    public function saveProduct($product_name, $category, $description, $stock_level) {
        try {
            // Input validation: Ensure no empty product name and stock level is not negative
            if (empty($product_name)) {
                throw new Exception("Product name cannot be empty.");
            }
            if ($stock_level < 0) {
                throw new Exception("Stock level cannot be negative.");
            }

            // Prepare SQL query with ON DUPLICATE KEY UPDATE logic
            $sql = "INSERT INTO products (product_name, category, description, stock_level) 
                    VALUES (?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE 
                        category = VALUES(category), 
                        description = VALUES(description), 
                        stock_level = VALUES(stock_level)";
            
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([$product_name, $category, $description, $stock_level]);

            return true;
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Validation Error: " . $e->getMessage();
            return false;
        }
    }

    // Retrieve all products
    public function getAllProducts() {
        try {
            $sql = "SELECT * FROM products";
            $stmt = $this->db->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return [];
        }
    }
}
?>
