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
        $stmt = $this->conn->prepare("SELECT o.*, p.name AS product_name
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

    public function create($user_id, $product_id, $quantity, $total_price, $name, $address, $phone)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price, status, created_at, name, address, phone) 
                                 VALUES (?, ?, ?, ?, 'Đang xử lý', NOW(), ?, ?, ?)");
        $result = $stmt->execute([$user_id, $product_id, $quantity, $total_price, $name, $address, $phone]);
        if ($result) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getAll($username = '', $product_name = '', $start_date = '', $end_date = '')
    {
        $query = "SELECT o.*, u.username, u.name, u.address, u.phone, p.name AS product_name 
              FROM orders o 
              JOIN users u ON o.user_id = u.ID 
              JOIN products p ON o.product_id = p.ID 
              WHERE 1=1";

        $params = [];

        // Filter by username
        if (!empty($username)) {
            $query .= " AND u.username LIKE ?";
            $params[] = "%" . $username . "%";
        }

        // Filter by product name
        if (!empty($product_name)) {
            $query .= " AND p.name LIKE ?";
            $params[] = "%" . $product_name . "%";
        }

        // Filter by date range
        if (!empty($start_date)) {
            $query .= " AND o.created_at >= ?";
            $params[] = $start_date;
        }
        if (!empty($end_date)) {
            $query .= " AND o.created_at <= ?";
            $params[] = date('Y-m-d', strtotime($end_date . ' +1 day')); // Include end_date
        }

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            // Log error (in production, log to a file)
            error_log("Database error: " . $e->getMessage());
            return [];
        }
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
        $valid_statuses = ['pending', 'completed', 'cancelled'];
        if (!in_array($status, $valid_statuses)) {
            error_log("Invalid status in Order: $status");
            return false;
        }

        try {
            $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
            $result = $stmt->execute([$status, $order_id]);
            if (!$result) {
                error_log("SQL Error: " . $stmt->error);
            }
            return $result;
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    public function createOrder($user_id, $product_id, $quantity, $total_price, $phone, $note)
    {
        try {
            // Fetch product name
            $stmt = $this->conn->prepare("SELECT name, price FROM products WHERE ID = :product_id");
            $stmt->execute([':product_id' => $product_id]);
            $product = $stmt->fetch();
            if (!$product) {
                return ['success' => false, 'message' => 'Sản phẩm không tồn tại'];
            }

            $product_name = $product['name'];
            $total_price = $product['price']; // Ensure total_price is from DB

            // Insert order with product_name
            $stmt = $this->conn->prepare("
                INSERT INTO orders (user_id, product_id, product_name, quantity, total_price, status, phone, note, created_at)
                VALUES (:user_id, :product_id, :product_name, :quantity, :total_price, :status, :phone, :note, :created_at)
            ");
            $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                ':product_name' => $product_name,
                ':quantity' => $quantity,
                ':total_price' => $total_price,
                ':status' => 'pending',
                ':phone' => $phone,
                ':note' => $note,
                ':created_at' => date('Y-m-d')
            ]);
            return ['success' => true, 'product_name' => $product_name]; // Add product_name to response
        } catch (PDOException $e) {
            error_log("Lỗi khi tạo đơn hàng: " . $e->getMessage());
            return ['success' => false, 'message' => 'Lỗi cơ sở dữ liệu: ' . $e->getMessage()];
        }
    }
    public function getProductPrice($product_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT price FROM products WHERE ID = :product_id");
            $stmt->execute([':product_id' => $product_id]);
            $product = $stmt->fetch();
            return $product ? $product['price'] : null;
        } catch (PDOException $e) {
            error_log("Lỗi khi lấy giá sản phẩm: " . $e->getMessage());
            return null;
        }
    }
}
