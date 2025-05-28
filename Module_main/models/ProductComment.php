<?php
class ProductComment
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả bình luận của một sản phẩm
    public function getByProductId($product_id)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT pc.*, u.name, u.username 
                FROM product_comments pc
                LEFT JOIN users u ON pc.user_id = u.ID
                WHERE pc.product_id = :product_id
                ORDER BY pc.created_at DESC
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching comments: " . $e->getMessage());
            return [];
        }
    }

    // Thêm bình luận mới
    public function add($product_id, $user_id, $comment)
    {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO product_comments (product_id, user_id, comment, created_at)
                VALUES (:product_id, :user_id, :comment, NOW())
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding comment: " . $e->getMessage());
            return false;
        }
    }
}
