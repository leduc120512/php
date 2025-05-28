<?php
class FarmingProcessModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT * FROM farming_process
                ORDER BY process_order ASC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching farming processes: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT * FROM farming_process
                WHERE ID = :id
                LIMIT 1
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching farming process: " . $e->getMessage());
            return false;
        }
    }

    public function add($title, $description, $process_order, $start_day, $end_day, $note, $image_url)
    {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO farming_process (title, description, process_order, start_day, end_day, note, image_url)
                VALUES (:title, :description, :process_order, :start_day, :end_day, :note, :image_url)
            ");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':process_order', $process_order, PDO::PARAM_INT);
            $stmt->bindParam(':start_day', $start_day, PDO::PARAM_INT);
            $stmt->bindParam(':end_day', $end_day, PDO::PARAM_INT);
            $stmt->bindParam(':note', $note);
            $stmt->bindParam(':image_url', $image_url);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding farming process: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $title, $description, $process_order, $start_day, $end_day, $note, $image_url)
    {
        try {
            $stmt = $this->conn->prepare("
                UPDATE farming_process
                SET title = :title, description = :description, process_order = :process_order,
                    start_day = :start_day, end_day = :end_day, note = :note, image_url = :image_url
                WHERE ID = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':process_order', $process_order, PDO::PARAM_INT);
            $stmt->bindParam(':start_day', $start_day, PDO::PARAM_INT);
            $stmt->bindParam(':end_day', $end_day, PDO::PARAM_INT);
            $stmt->bindParam(':note', $note);
            $stmt->bindParam(':image_url', $image_url);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating farming process: " . $e->getMessage());
            return false;
        }
    }
    public function delete($id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare(" DELETE FROM farming_process WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Lỗi khi quy trình chăn nuôi: " . $e->getMessage());
            return false;
        }
    }
   
}
