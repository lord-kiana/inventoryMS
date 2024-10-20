<?php
require_once '../../classes/Database.php';  // Adjust path if necessary

class Archive {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Archive old orders (example: orders older than 1 year)
    public function archiveOldOrders() {
        try {
            $this->db->pdo->beginTransaction();

            // Select old orders to archive (older than 1 year)
            $sql = "SELECT * FROM orders WHERE order_date < DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
            $stmt = $this->db->pdo->query($sql);
            $oldOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($oldOrders)) {
                throw new Exception("No old orders to archive.");
            }

            // Insert old orders into the archive table
            $archiveStmt = $this->db->pdo->prepare(
                "INSERT INTO archive (table_name, record_id, data) 
                 VALUES ('orders', ?, ?)"
            );

            foreach ($oldOrders as $order) {
                $archiveStmt->execute([$order['order_id'], json_encode($order)]);
            }

            // Delete old orders from the original table
            $deleteStmt = $this->db->pdo->prepare("DELETE FROM orders WHERE order_id = ?");
            foreach ($oldOrders as $order) {
                $deleteStmt->execute([$order['order_id']]);
            }

            $this->db->pdo->commit();
            return "Old orders archived successfully.";
        } catch (Exception $e) {
            $this->db->pdo->rollBack();
            return "Error archiving records: " . $e->getMessage();
        }
    }

    // Retrieve all archived records from the archive table
    public function getArchivedRecords() {
        try {
            $sql = "SELECT * FROM archive ORDER BY archived_at DESC";
            $stmt = $this->db->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving archived records: " . $e->getMessage();
            return [];
        }
    }
}
?>
