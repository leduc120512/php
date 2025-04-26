<?php
class Product
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getById($id)
    {
        try {
            $query = "SELECT * FROM products WHERE ID = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Có thể log lỗi thay vì hiển thị trực tiếp
            error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
            return false;
        }
    }
    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY ID ASC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotal()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getLatest()
    {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY ID DESC LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add($name, $img, $price, $quantity, $description)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (name, img, price, quantity, description) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $img, $price, $quantity, $description]);
    }

    public function update($id, $name, $img, $price, $quantity, $description)
    {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, img = ?, price = ?, quantity = ?, description = ? WHERE ID = ?");
        return $stmt->execute([$name, $img, $price, $quantity, $description, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE ID = ?");
        return $stmt->execute([$id]);
    }
    public function searchByName($keyword, $limit, $offset)
    {
        $keyword = "%" . $keyword . "%"; // Thêm wildcard để tìm kiếm gần đúng
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name LIKE :keyword ORDER BY ID ASC LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalByName($keyword)
    {
        $keyword = "%" . $keyword . "%";
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products WHERE name LIKE :keyword");
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function searchAjax()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        $keyword = isset($_GET['search']) ? trim($_GET['search']) : '';
        $itemsPerPage = 9;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($currentPage < 1) $currentPage = 1;

        $offset = ($currentPage - 1) * $itemsPerPage;

        if (!empty($keyword)) {
            $products = $this->product->searchByName($keyword, $itemsPerPage, $offset);
            $totalItems = $this->product->getTotalByName($keyword);
        } else {
            $products = $this->product->getPaginated($itemsPerPage, $offset);
            $totalItems = $this->product->getTotal();
        }

        $totalPages = ceil($totalItems / $itemsPerPage);

        // Trả về dữ liệu JSON
        echo json_encode([
            'products' => $products,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ]);
        exit;
    }
}
