<?php
class ProductReview
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả đánh giá của một sản phẩm
    public function getByProductId($product_id)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT pr.*, u.name, u.username 
                FROM product_reviews pr
                LEFT JOIN users u ON pr.user_id = u.ID
                WHERE pr.product_id = :product_id
                ORDER BY pr.created_at DESC
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching reviews: " . $e->getMessage());
            return [];
        }
    }

    // Thêm đánh giá mới
    public function add($product_id, $user_id, $rating, $comment)
    {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO product_reviews (product_id, user_id, rating, comment, created_at)
                VALUES (:product_id, :user_id, :rating, :comment, NOW())
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding review: " . $e->getMessage());
            return false;
        }
    }

    // Lấy trung bình đánh giá của sản phẩm
    public function getAverageRating($product_id)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT AVG(rating) as average_rating, COUNT(*) as total_reviews
                FROM product_reviews
                WHERE product_id = :product_id
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching average rating: " . $e->getMessage());
            return ['average_rating' => 0, 'total_reviews' => 0];
        }
    }
}
