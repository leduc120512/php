<?php
class CommentReply
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy tất cả trả lời của một bình luận
    public function getByCommentId($comment_id)
    {
        try {
            $stmt = $this->conn->prepare("
                SELECT cr.*, u.name, u.username 
                FROM comment_replies cr
                LEFT JOIN users u ON cr.user_id = u.ID
                WHERE cr.comment_id = :comment_id
                ORDER BY cr.created_at ASC
            ");
            $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching replies: " . $e->getMessage());
            return [];
        }
    }

    // Thêm trả lời mới
    public function add($comment_id, $user_id, $reply)
    {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO comment_replies (comment_id, user_id, reply, created_at)
                VALUES (:comment_id, :user_id, :reply, NOW())
            ");
            $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':reply', $reply, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding reply: " . $e->getMessage());
            return false;
        }
    }
}
