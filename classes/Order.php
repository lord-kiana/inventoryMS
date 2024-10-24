<?php
require_once 'classes/Database.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Add a new order
    public function addOrder($supplier_name, $order_date, $item_name, $quantity, $order_type) {
        try {
            // Input validation: Ensure no empty values
            if (empty($supplier_name) || empty($order_date) || empty($item_name) || $quantity <= 0 || empty($order_type)) {
                throw new Exception("All fields are required, and quantity must be greater than 0.");
            }

            $sql = "INSERT INTO orders (supplier_name, order_date, item_name, quantity, order_type) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([$supplier_name, $order_date, $item_name, $quantity, $order_type]);

            return true;
        } catch (PDOException $e) {
            // Log error message or display it for debugging
            echo "Error adding order: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            // Handle validation exception
            echo "Validation Error: " . $e->getMessage();
            return false;
        }
    }

    // Retrieve all orders
    public function getAllOrders() {
        try {
            $sql = "SELECT * FROM orders ORDER BY order_date DESC";
            $stmt = $this->db->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving orders: " . $e->getMessage();
            return [];
        }
    }

    // Update order status
    public function updateOrderStatus($order_id, $status) {
        try {
            $validStatuses = ['pending', 'completed', 'returned'];
            if (!in_array($status, $validStatuses)) {
                throw new Exception("Invalid status value.");
            }

            $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute([$status, $order_id]);

            return true;
        } catch (PDOException $e) {
            echo "Error updating order status: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Validation Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
