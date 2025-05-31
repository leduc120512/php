<?php
class ArticleModel
{
    private $conn;

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
                WHERE ID = :id
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
}
