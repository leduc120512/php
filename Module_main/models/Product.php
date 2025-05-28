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
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            // Lấy tất cả sản phẩm và ảnh liên quan trong một truy vấn
            $stmt = $this->conn->prepare("
                SELECT p.*, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                ORDER BY p.ID ASC, pi.is_main DESC, pi.created_at ASC
            ");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Nhóm ảnh theo sản phẩm
            $products = [];
            foreach ($rows as $row) {
                $productId = $row['ID'];
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'ID' => $row['ID'],
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'quantity' => $row['quantity'],
                        'description' => $row['description'],
                        'created_at' => $row['created_at'],
                        'category_id' => $row['category_id'],
                        'is_locked' => $row['is_locked'],
                        'images' => []
                    ];
                }
                if ($row['image_url']) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }
            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
            return [];
        }
    }

    public function getAllCategory()
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("SELECT ID, name FROM categories");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy danh mục: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("
                SELECT p.*, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                WHERE p.ID = :id
                ORDER BY pi.is_main DESC, pi.created_at ASC
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($rows)) {
                return false;
            }

            $product = [
                'ID' => $rows[0]['ID'],
                'name' => $rows[0]['name'],
                'price' => $rows[0]['price'],
                'quantity' => $rows[0]['quantity'],
                'description' => $rows[0]['description'],
                'created_at' => $rows[0]['created_at'],
                'category_id' => $rows[0]['category_id'],
                'is_locked' => $rows[0]['is_locked'],
                'images' => []
            ];

            foreach ($rows as $row) {
                if ($row['image_url']) {
                    $product['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }
            return $product;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    public function getPaginated($limit, $offset)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("
                SELECT p.*, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                ORDER BY p.ID ASC, pi.is_main DESC, pi.created_at ASC
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($rows as $row) {
                $productId = $row['ID'];
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'ID' => $row['ID'],
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'quantity' => $row['quantity'],
                        'description' => $row['description'],
                        'created_at' => $row['created_at'],
                        'category_id' => $row['category_id'],
                        'is_locked' => $row['is_locked'],
                        'images' => []
                    ];
                }
                if ($row['image_url']) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }
            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm phân trang: " . $e->getMessage());
            return [];
        }
    }

    public function getTotal()
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products");
            $stmt->execute();
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            error_log("Lỗi khi lấy tổng số sản phẩm: " . $e->getMessage());
            return 0;
        }
    }

    public function getLatest()
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("
                SELECT p.*, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                WHERE pi.is_main = TRUE OR pi.is_main IS NULL
                ORDER BY p.created_at DESC
                LIMIT 3
            ");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($rows as $row) {
                $productId = $row['ID'];
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'ID' => $row['ID'],
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'quantity' => $row['quantity'],
                        'description' => $row['description'],
                        'created_at' => $row['created_at'],
                        'category_id' => $row['category_id'],
                        'is_locked' => $row['is_locked'],
                        'images' => []
                    ];
                }
                if ($row['image_url']) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }
            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm mới nhất: " . $e->getMessage());
            return [];
        }
    }

    public function add($name, $price, $quantity, $description, $category_id, $image_urls = [])
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                INSERT INTO products (name, price, quantity, description, category_id, created_at)
                VALUES (:name, :price, :quantity, :description, :category_id, NOW())
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();
            $product_id = $this->conn->lastInsertId();

            if (!empty($image_urls)) {
                $stmt = $this->conn->prepare("
                    INSERT INTO product_images (product_id, image_url, is_main, created_at)
                    VALUES (:product_id, :image_url, :is_main, NOW())
                ");
                foreach ($image_urls as $index => $image_url) {
                    $is_main = ($index === 0) ? true : false;
                    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
                    $stmt->bindParam(':is_main', $is_main, PDO::PARAM_BOOL);
                    $stmt->execute();
                }
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Lỗi khi thêm sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $name, $price, $quantity, $description, $category_id, $image_url = null)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("
                UPDATE products
                SET name = :name, price = :price, quantity = :quantity, 
                    description = :description, category_id = :category_id
                WHERE ID = :id
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($image_url) {
                $stmt = $this->conn->prepare("
                    SELECT ID FROM product_images
                    WHERE product_id = :id AND is_main = TRUE
                ");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $existing_image = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existing_image) {
                    $stmt = $this->conn->prepare("
                        UPDATE product_images
                        SET image_url = :image_url, created_at = NOW()
                        WHERE ID = :image_id
                    ");
                    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
                    $stmt->bindParam(':image_id', $existing_image['ID'], PDO::PARAM_INT);
                    $stmt->execute();
                } else {
                    $stmt = $this->conn->prepare("
                        INSERT INTO product_images (product_id, image_url, is_main, created_at)
                        VALUES (:product_id, :image_url, TRUE, NOW())
                    ");
                    $stmt->bindParam(':product_id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Lỗi khi cập nhật sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    public function getUnsoldProducts($limit, $offset)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("
                SELECT p.ID, p.name, p.quantity, p.price, p.created_at
                FROM products p
                LEFT JOIN orders o ON p.ID = o.product_id 
                    AND o.created_at >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                WHERE p.quantity > 0 AND o.order_id IS NULL
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm không bán: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalUnsoldProducts()
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("
                SELECT COUNT(*) as total
                FROM products p
                LEFT JOIN orders o ON p.ID = o.product_id 
                    AND o.created_at >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                WHERE p.quantity > 0 AND o.order_id IS NULL
            ");
            $stmt->execute();
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            error_log("Lỗi khi lấy tổng sản phẩm không bán: " . $e->getMessage());
            return 0;
        }
    }

    public function delete($id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("DELETE FROM products WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Lỗi khi xóa sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    public function searchByName($keyword, $limit, $offset)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $keyword = "%$keyword%";
            $stmt = $this->conn->prepare("
                SELECT p.*, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                WHERE p.name LIKE :keyword
                ORDER BY p.ID ASC, pi.is_main DESC, pi.created_at ASC
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($rows as $row) {
                $productId = $row['ID'];
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'ID' => $row['ID'],
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'quantity' => $row['quantity'],
                        'description' => $row['description'],
                        'created_at' => $row['created_at'],
                        'category_id' => $row['category_id'],
                        'is_locked' => $row['is_locked'],
                        'images' => []
                    ];
                }
                if ($row['image_url']) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }
            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi khi tìm kiếm sản phẩm: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalByName($keyword)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $keyword = "%$keyword%";
            $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products WHERE name LIKE :keyword");
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
            $stmt->execute();
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            error_log("Lỗi khi lấy tổng số sản phẩm tìm kiếm: " . $e->getMessage());
            return 0;
        }
    }
}
