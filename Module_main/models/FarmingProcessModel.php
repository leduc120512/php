<?php
class FarmingProcessModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAll($category_id_fm = null)
    {
        try {
            if ($category_id_fm) {
                $stmt = $this->conn->prepare("
                SELECT ID, title, description, image_url, created_at, note
                FROM farming_process
                WHERE category_id = :category_id_fm
                ORDER BY created_at DESC
            ");
                $stmt->bindParam(':category_id_fm', $category_id_fm, PDO::PARAM_INT);
            } else {
                $stmt = $this->conn->prepare("
                SELECT ID, title, description, image_url, created_at, note
                FROM farming_process
                ORDER BY created_at DESC
            ");
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching farming processes: " . $e->getMessage());
            return [];
        }
    }
    public function CatergorygetAllfm()
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, name FROM category_faming;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching categories: " . $e->getMessage());
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

    public function add($title, $description, $process_order, $start_day, $end_day, $note, $image_url = null, $video_url = null, $category_id = 1)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                INSERT INTO farming_process (title, description, process_order, start_day, end_day, note, image_url, video_url, category_id, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([$title, $description, $process_order, $start_day, $end_day, $note, $image_url, $video_url, $category_id]);
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error adding farming process: " . $e->getMessage());
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function update($id, $title, $description, $process_order, $start_day, $end_day, $note, $image_url = null, $video_url = null, $category_id = 1)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                UPDATE farming_process
                SET title = ?, description = ?, process_order = ?, start_day = ?, end_day = ?, note = ?, image_url = ?, video_url = ?, category_id = ?
                WHERE id = ?
            ");
            $stmt->execute([$title, $description, $process_order, $start_day, $end_day, $note, $image_url, $video_url, $category_id, $id]);
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
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
            $stmt = $this->conn->prepare("DELETE FROM farming_process WHERE ID = :ID");
            $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Lỗi khi quy trình chăn nuôi: " . $e->getMessage());
            return false;
        }
    }
   
}
