<?php
class Product {
    private $conn;

    public function __construct() {
        // Database connection
        $this->conn = new mysqli('localhost', 'root', '', 'inventory_system');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch all products
    public function getAllProducts() {
        $query = "SELECT * FROM `dashboard_db`";
        $result = $this->conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Fetch product by ID
    public function getProductById($id) {
        $query = "SELECT `id`, `name`, `price`, `quantity` FROM `dashboard_db` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add a new product
    // Add a new product
    public function addProduct($name, $price, $quantity) {
        $query = "INSERT INTO dashboard_db (name, price, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param('sdi', $name, $price, $quantity);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
        return true;
    }

    // Update an existing product
    public function updateProduct($id, $name, $price, $quantity) {
        $query = "UPDATE `dashboard_db` SET `name` = ?, `price` = ?, `quantity` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        // Correct the binding parameters
        $stmt->bind_param('sdii', $name, $price, $quantity, $id);
        return $stmt->execute();
    }

    // Delete a product
    public function deleteProduct($id) {
        $query = "DELETE FROM `dashboard_db` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>
