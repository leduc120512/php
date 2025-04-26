<?php
require_once 'database.php'; 

function getById($id)
{
    try {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT * FROM products WHERE ID = :id LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
        return false;
    }
}
