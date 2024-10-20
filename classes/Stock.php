<?php
require_once 'Database.php';  // Adjust path if necessary

class Stock {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // View stock levels across locations
    public function getStockLevels() {
        try {
            $sql = "SELECT s.stock_id, p.product_name, s.location, s.stock_level 
                    FROM stock_levels s 
                    JOIN products p ON s.product_id = p.product_id";
            $stmt = $this->db->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error fetching stock levels: " . $e->getMessage();
            return [];
        }
    }

    // Transfer stock between locations
    public function transferStock($product_id, $from_location, $to_location, $quantity) {
        $this->db->pdo->beginTransaction();
        try {
            // Check if enough stock exists at the source location
            $sql = "SELECT stock_level FROM stock_levels 
                    WHERE product_id = ? AND location = ?";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([$product_id, $from_location]);
            $stock = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$stock || $stock['stock_level'] < $quantity) {
                throw new Exception("Insufficient stock at the source location.");
            }

            // Reduce stock from source location
            $sql = "UPDATE stock_levels 
                    SET stock_level = stock_level - ? 
                    WHERE product_id = ? AND location = ?";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([$quantity, $product_id, $from_location]);

            // Add stock to destination location
            $sql = "INSERT INTO stock_levels (product_id, location, stock_level) 
                    VALUES (?, ?, ?)
                    ON DUPLICATE KEY UPDATE stock_level = stock_level + ?";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([$product_id, $to_location, $quantity, $quantity]);

            // Commit the transaction
            $this->db->pdo->commit();
            return true;
        } catch (Exception $e) {
            // Rollback transaction on failure
            $this->db->pdo->rollBack();
            echo "Stock transfer failed: " . $e->getMessage();
            return false;
        }
    }
}
?>
