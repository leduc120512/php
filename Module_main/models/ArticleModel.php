<?php
class ArticleModel
{
    private $conn;
    private $table_name = "categories_art";
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllAt($category_id_art = null)
    {
        try {
            if ($category_id_art) {
                $stmt = $this->conn->prepare("
                    SELECT id, title, decription, note, image_url, created_at 
                    FROM articles 
                    WHERE category_id = :category_id_art
                ");
                $stmt->bindParam(':category_id_art', $category_id_art, PDO::PARAM_INT);
            } else {
                $stmt = $this->conn->prepare("
                    SELECT id, title, decription, note, image_url, created_at 
                    FROM articles 
                
                ");
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching articles: " . $e->getMessage());
            return [];
        }
    }
    public function getAllAttop3($category_id_art = null)
    {
        try {
            if ($category_id_art) {
                $stmt = $this->conn->prepare("
                    SELECT id, title, decription, note, image_url, created_at 
                    FROM articles 
                    WHERE category_id = :category_id_art
                ");
                $stmt->bindParam(':category_id_art', $category_id_art, PDO::PARAM_INT);
            } else {
                $stmt = $this->conn->prepare("
                 SELECT id, title, decription, note, image_url, created_at 
FROM articles 
LIMIT 8;
                ");
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching articles: " . $e->getMessage());
            return [];
        }
    }


    // Lấy danh sách danh mục
    public function CatergorygetAllAt()
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, name FROM categories_art;");
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
                SELECT * FROM articles
                WHERE id = :id
                LIMIT 1
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching article: " . $e->getMessage());
            return false;
        }
    }

    public function add($title, $content, $author, $decription, $note, $image_url = null, $category_id = 1)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                INSERT INTO articles (title, content, author, decription, note, image_url, created_at, category_id)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)
            ");
            $stmt->execute([$title, $content, $author, $decription, $note, $image_url, $category_id]);
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error adding article: " . $e->getMessage());
            return ['success' => false, 'message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage()];
        }
    }
    public function update($id, $title, $content, $author, $decription, $note, $image_url = null)
    {
        try {
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                UPDATE articles
                SET title = ?, content = ?, author = ?, decription = ?, note = ?, image_url = ?
                WHERE ID = ?
            ");
            $stmt->execute([$title, $content, $author, $decription, $note, $image_url, $id]);
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error updating article: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("DELETE FROM articles WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Lỗi khi xóa sản phẩm: " . $e->getMessage());
            return false;
        }
    }



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
            error_log("create: CategoriesArt '$name' created successfully");
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
            error_log("getAllCategory: Found " . count($categories) . " categories_art records");
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
            error_log("searchByName: Found " . count($categories) . " categories_art records for term '$search_term'");
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
            error_log("getById: " . ($category ? "Found categories_art ID $id" : "CategoriesArt ID $id not found"));
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
            error_log("update: CategoriesArt ID $id updated successfully");
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
            error_log("delete: CategoriesArt ID $id deleted successfully");
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi xóa danh mục: " . $e->getMessage());
            return false;
        }
    }   
}
