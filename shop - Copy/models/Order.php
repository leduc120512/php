<?php
class Order
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // public function getByUserId($user_id)
    // {
    //     $stmt = $this->conn->prepare("SELECT o.*, p.name AS product_name, p.img AS product_image 
    //         FROM orders o 
    //         JOIN products p ON o.product_id = p.ID 
    //         WHERE o.user_id = ? 
    //         ORDER BY o.id DESC"); // Thay order_id thành id
    //     $stmt->execute([$user_id]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function getByUserId($user_id)
    {
        $stmt = $this->conn->prepare("SELECT o.*, p.name AS product_name, p.img AS product_image 
        FROM orders o 
        JOIN products p ON o.product_id = p.ID 
        WHERE o.user_id = ? 
        ORDER BY o.order_id DESC"); // Changed o.id to o.order_id
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function searchOrders($order_id = '', $start_date = '', $end_date = '')
    // {
    //     $query = "SELECT o.*, u.username, p.name AS product_name 
    //               FROM orders o 
    //               JOIN users u ON o.user_id = u.ID 
    //               JOIN products p ON o.product_id = p.ID 
    //               WHERE 1=1";

    //     $params = [];
    //     if (!empty($order_id)) {
    //         $query .= " AND o.id = ?"; // Thay order_id thành id
    //         $params[] = $order_id;
    //     }
    //     if (!empty($start_date)) {
    //         $query .= " AND DATE(o.created_at) >= ?";
    //         $params[] = $start_date;
    //     }
    //     if (!empty($end_date)) {
    //         $query .= " AND DATE(o.created_at) <= ?";
    //         $params[] = $end_date;
    //     }

    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute($params);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function create($user_id, $product_id, $quantity, $total_price)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price, status, created_at) 
                                     VALUES (?, ?, ?, ?, 'Đang xử lý', NOW())");
        $result = $stmt->execute([$user_id, $product_id, $quantity, $total_price]);
        if ($result) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT o.*, u.username, p.name AS product_name 
            FROM orders o 
            JOIN users u ON o.user_id = u.ID 
            JOIN products p ON o.product_id = p.ID");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function updateStatus($order_id, $status)
    // {
    //     $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE id = ?"); // Thay order_id thành id
    //     return $stmt->execute([$status, $order_id]);
    // }
    public function searchOrders($order_id = '', $start_date = '', $end_date = '')
    {
        $query = "SELECT o.*, u.username, p.name AS product_name 
              FROM orders o 
              JOIN users u ON o.user_id = u.ID 
              JOIN products p ON o.product_id = p.ID 
              WHERE 1=1";

        $params = [];
        if (!empty($order_id)) {
            $query .= " AND o.order_id = ?"; // Changed o.id to o.order_id
            $params[] = $order_id;
        }
        if (!empty($start_date)) {
            $query .= " AND DATE(o.created_at) >= ?";
            $params[] = $start_date;
        }
        if (!empty($end_date)) {
            $query .= " AND DATE(o.created_at) <= ?";
            $params[] = $end_date;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($order_id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?"); // Changed id to order_id
        return $stmt->execute([$status, $order_id]);
    }
}
