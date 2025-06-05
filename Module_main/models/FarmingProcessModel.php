<?php
class FarmingProcessModel
{
    private $conn;
    private $table_name = "category_faming";
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
    public function getAllMain()
    {
        try {
            $stmt = $this->conn->prepare("
                 SELECT ID, title, description, image_url, created_at, note
FROM farming_process
ORDER BY created_at DESC
LIMIT 10
        ");
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






    //category
    // Create
    public function create($name, $description, $top)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "INSERT INTO " . $this->table_name . " (name, description, top) VALUES (:name, :description, :top)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':top', $top, PDO::PARAM_INT);
            $stmt->execute();
            error_log("create: CategoryFaming '$name' created successfully");
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi tạo danh mục: " . $e->getMessage());
            return false;
        }
    }

    // Read all
    public function getAllCategory($top_only = false)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "SELECT id, name, description, top, created_at FROM " . $this->table_name;
            if ($top_only) {
                $query .= " WHERE top = 1";
            }
            $query .= " ORDER BY name ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("getAllCategory: Found " . count($categories) . " category_faming records");
            return $categories;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy danh mục: " . $e->getMessage());
            return [];
        }
    }

    // Search by name
    public function searchByName($search_term)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "SELECT id, name, description, top, created_at FROM " . $this->table_name . " WHERE name LIKE :search_term ORDER BY name ASC";
            $stmt = $this->conn->prepare($query);
            $search_term = "%" . $search_term . "%";
            $stmt->bindParam(':search_term', $search_term);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("searchByName: Found " . count($categories) . " category_faming records for term '$search_term'");
            return $categories;
        } catch (Exception $e) {
            error_log("Lỗi khi tìm kiếm danh mục: " . $e->getMessage());
            return [];
        }
    }

    // Read one
    public function getById_category($id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "SELECT id, name, description, top, created_at FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("getById: " . ($category ? "Found category_faming ID $id" : "CategoryFaming ID $id not found"));
            return $category;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy danh mục: " . $e->getMessage());
            return false;
        }
    }

    // Update
    public function update_category($id, $name, $description, $top)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, top = :top WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':top', $top, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            error_log("update: CategoryFaming ID $id updated successfully");
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi cập nhật danh mục: " . $e->getMessage());
            return false;
        }
    }

    // Delete
    public function delete_category($id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            error_log("delete: CategoryFaming ID $id deleted successfully");
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi xóa danh mục: " . $e->getMessage());
            return false;
        }
    }
}
