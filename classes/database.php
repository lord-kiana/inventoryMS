<?php
class Database {
    private $server_name = "localhost";
    private $db_username = "root";
    private $db_password = "";
    private $db_name = "inventory_system04";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->server_name, $this->db_username, $this->db_password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}

// Database connection parameters
$host = 'localhost';
$dbname = 'inventory_db';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch stock levels from the database
    $stmt = $pdo->query("SELECT product_name, location, stock_level FROM stock_levels");
    $stockLevels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display stock levels
    echo "<h1>Current Stock Levels</h1>";
    echo "<table border='1'>
            <tr>
                <th>Product Name</th>
                <th>Location</th>
                <th>Stock Level</th>
            </tr>";
    
    foreach ($stockLevels as $row) {
        echo "<tr>
                <td>{$row['product_name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['stock_level']}</td>
              </tr>";
    }
    echo "</table>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=inventory_db', 'root', '');

// Fetch stock levels
$stmt = $pdo->query("SELECT product_name, location, stock_level FROM stock_levels");
$stockLevels = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display stock levels
echo "<h1>Current Stock Levels</h1>";
echo "<table border='1'>
        <tr>
            <th>Product Name</th>
            <th>Location</th>
            <th>Stock Level</th>
        </tr>";
foreach ($stockLevels as $row) {
    echo "<tr>
            <td>{$row['product_name']}</td>
            <td>{$row['location']}</td>
            <td>{$row['stock_level']}</td>
          </tr>";
}
echo "</table>";
?>

?>