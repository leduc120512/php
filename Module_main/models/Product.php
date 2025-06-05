<?php
class Product
{
    private $conn;
    private $table_name = "categories";
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
            WHERE p.is_locked = 0
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
    public function getAlltop()
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
            WHERE p.is_locked = 0 and p.top=1
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
    // public function getAllAdmin()
    // {
    //     try {
    //         if ($this->conn === null) {
    //             throw new Exception("Không thể kết nối cơ sở dữ liệu.");
    //         }
    //         // Lấy tất cả sản phẩm và ảnh liên quan trong một truy vấn
    //         $stmt = $this->conn->prepare("
    //             SELECT p.*, pi.image_url, pi.is_main
    //             FROM products p
    //             LEFT JOIN product_images pi ON p.ID = pi.product_id
    //             ORDER BY p.ID ASC, pi.is_main DESC, pi.created_at ASC
    //         ");
    //         $stmt->execute();
    //         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         // Nhóm ảnh theo sản phẩm
    //         $products = [];
    //         foreach ($rows as $row) {
    //             $productId = $row['ID'];
    //             if (!isset($products[$productId])) {
    //                 $products[$productId] = [
    //                     'ID' => $row['ID'],
    //                     'name' => $row['name'],
    //                     'price' => $row['price'],
    //                     'quantity' => $row['quantity'],
    //                     'description' => $row['description'],
    //                     'created_at' => $row['created_at'],
    //                     'category_id' => $row['category_id'],
    //                     'is_locked' => $row['is_locked'],
    //                     'images' => [],
    //                     'main_image' => null
    //                 ];
    //             }
    //             if ($row['image_url']) {
    //                 $products[$productId]['images'][] = [
    //                     'image_url' => $row['image_url'],
    //                     'is_main' => $row['is_main']
    //                 ];
    //                 // Gán ảnh chính
    //                 if ($row['is_main'] == 1) {
    //                     $products[$productId]['main_image'] = $row['image_url'];
    //                 }
    //                 // Nếu chưa có ảnh chính, chọn ảnh đầu tiên làm mặc định
    //                 elseif ($products[$productId]['main_image'] === null) {
    //                     $products[$productId]['main_image'] = $row['image_url'];
    //                 }
    //             }
    //         }
    //         return array_values($products);
    //     } catch (Exception $e) {
    //         error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
    //         return [];
    //     }
    // }
    public function getAllAdmin($name = '', $id = null, $start_date = null, $end_date = null)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }

            // Build the SQL query with dynamic conditions
            $query = "
            SELECT p.*, pi.image_url, pi.is_main
            FROM products p
            LEFT JOIN product_images pi ON p.ID = pi.product_id
            WHERE 1=1
        ";

            // Add conditions based on search parameters
            $params = [];
            if (!empty($name)) {
                $query .= " AND p.name LIKE :name";
                $params[':name'] = '%' . $name . '%';
            }
            if (!empty($id)) {
                $query .= " AND p.ID = :id";
                $params[':id'] = $id;
            }
            if (!empty($start_date)) {
                $query .= " AND p.created_at >= :start_date";
                $params[':start_date'] = $start_date;
            }
            if (!empty($end_date)) {
                $query .= " AND p.created_at <= :end_date";
                $params[':end_date'] = $end_date . ' 23:59:59'; // Include full day
            }

            $query .= " ORDER BY p.ID ASC, pi.is_main DESC, pi.created_at ASC";

            // Prepare and execute the query
            $stmt = $this->conn->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Group images by product
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
                        'images' => [],
                        'main_image' => null
                    ];
                }
                if ($row['image_url']) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                    // Set main image
                    if ($row['is_main'] == 1) {
                        $products[$productId]['main_image'] = $row['image_url'];
                    } elseif ($products[$productId]['main_image'] === null) {
                        $products[$productId]['main_image'] = $row['image_url'];
                    }
                }
            }

            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
            return [];
        }
    }

    // public function getById($id)
    // {
    //     try {
    //         if ($this->conn === null) {
    //             throw new Exception("Không thể kết nối cơ sở dữ liệu.");
    //         }
    //         $stmt = $this->conn->prepare("
    //             SELECT p.*, pi.image_url, pi.is_main
    //             FROM products p
    //             LEFT JOIN product_images pi ON p.ID = pi.product_id
    //             WHERE p.ID = :id
    //             ORDER BY pi.is_main DESC, pi.created_at ASC
    //         ");
    //         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         if (empty($rows)) {
    //             return false;
    //         }

    //         $product = [
    //             'ID' => $rows[0]['ID'],
    //             'name' => $rows[0]['name'],
    //             'price' => $rows[0]['price'],
    //             'quantity' => $rows[0]['quantity'],
    //             'description' => $rows[0]['description'],
    //             'created_at' => $rows[0]['created_at'],
    //             'category_id' => $rows[0]['category_id'],
    //             'is_locked' => $rows[0]['is_locked'],
    //             'images' => []
    //         ];

    //         foreach ($rows as $row) {
    //             if ($row['image_url']) {
    //                 $product['images'][] = [
    //                     'image_url' => $row['image_url'],
    //                     'is_main' => $row['is_main']
    //                 ];
    //             }
    //         }
    //         return $product;
    //     } catch (Exception $e) {
    //         error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
    //         return false;
    //     }
    // }


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

    public function add($name, $price, $quantity, $description, $category_id, $top, $image_urls = [])
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $this->conn->beginTransaction();
            $stmt = $this->conn->prepare("
                INSERT INTO products (name, price, quantity, description, category_id, top, created_at)
                VALUES (:name, :price, :quantity, :description, :category_id, :top, NOW())
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':top', $top, PDO::PARAM_BOOL);
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
    public function edit($product_id, $name, $price, $quantity, $description, $category_id, $is_locked, $top, $image_urls = [])
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $this->conn->beginTransaction();

            // Update product details
            $stmt = $this->conn->prepare("
                UPDATE products 
                SET name = :name, price = :price, quantity = :quantity, description = :description, 
                    category_id = :category_id, is_locked = :is_locked, top = :top
                WHERE ID = :product_id
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':is_locked', $is_locked, PDO::PARAM_BOOL);
            $stmt->bindParam(':top', $top, PDO::PARAM_BOOL);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();

            // Insert new images if any
            if (!empty($image_urls)) {
                $stmt = $this->conn->prepare("
                    INSERT INTO product_images (product_id, image_url, is_main, created_at)
                    VALUES (:product_id, :image_url, :is_main, NOW())
                ");
                foreach ($image_urls as $index => $image_url) {
                    $is_main = ($index === 0 && !$this->hasMainImage($product_id)) ? true : false;
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
            error_log("Lỗi khi sửa sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    // Helper method to check if a product has a main image
    private function hasMainImage($product_id)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM product_images WHERE product_id = ? AND is_main = 1");
        $stmt->execute([$product_id]);
        return $stmt->fetchColumn() > 0;
    }
    public function getById($product_id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("
                SELECT p.*, pi.ID as image_id, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                WHERE p.ID = :product_id
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $product = [];
            if (!empty($result)) {
                $product = $result[0];
                $product['images'] = [];
                foreach ($result as $row) {
                    $product['images'][] = [
                        'ID' => $row['image_id'],
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            } else {
                $product = ['ID' => $product_id, 'images' => []]; // Default empty product if not found
            }
            return $product;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
            return ['ID' => $product_id, 'images' => []]; // Return empty structure on error
        }
    }
   
    public function deleteImage($image_id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("DELETE FROM product_images WHERE ID = ?");
            $stmt->execute([$image_id]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Lỗi khi xóa ảnh: " . $e->getMessage());
            return false;
        }
    }
    public function getImageById($image_id)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $stmt = $this->conn->prepare("SELECT * FROM product_images WHERE ID = ?");
            $stmt->execute([$image_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Lỗi khi lấy ảnh: " . $e->getMessage());
            return false;
        }
    }
    public function removeImage($product_id, $image_url)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }

            $stmt = $this->conn->prepare("
                DELETE FROM product_images 
                WHERE product_id = :product_id AND image_url = :image_url
            ");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Lỗi khi xóa ảnh: " . $e->getMessage());
            return false;
        }
    }

    // public function getById($id)
    // {
    //     try {
    //         if ($this->conn === null) {
    //             throw new Exception("Không thể kết nối cơ sở dữ liệu.");
    //         }
    //         $stmt = $this->conn->prepare("
    //             SELECT p.*, pi.image_url, pi.is_main
    //             FROM products p
    //             LEFT JOIN product_images pi ON p.ID = pi.product_id
    //             WHERE p.ID = :id
    //             ORDER BY pi.is_main DESC, pi.created_at ASC
    //         ");
    //         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //         if (empty($rows)) {
    //             return false;
    //         }

    //         $product = [
    //             'ID' => $rows[0]['ID'],
    //             'name' => $rows[0]['name'],
    //             'price' => $rows[0]['price'],
    //             'quantity' => $rows[0]['quantity'],
    //             'description' => $rows[0]['description'],
    //             'created_at' => $rows[0]['created_at'],
    //             'category_id' => $rows[0]['category_id'],
    //             'is_locked' => $rows[0]['is_locked'],
    //             'images' => []
    //         ];

    //         foreach ($rows as $row) {
    //             if ($row['image_url']) {
    //                 $product['images'][] = [
    //                     'image_url' => $row['image_url'],
    //                     'is_main' => $row['is_main']
    //                 ];
    //             }
    //         }
    //         return $product;
    //     } catch (Exception $e) {
    //         error_log("Lỗi khi lấy sản phẩm: " . $e->getMessage());
    //         return false;
    //     }
    // }
    public function deleteImages($product_id, $image_ids)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $placeholders = implode(',', array_fill(0, count($image_ids), '?'));
            $stmt = $this->conn->prepare("DELETE FROM product_images WHERE product_id = ? AND ID IN ($placeholders)");
            $stmt->bindParam(1, $product_id, PDO::PARAM_INT);
            $stmt->execute($image_ids);
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi xóa ảnh: " . $e->getMessage());
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
    public function searchByName($keyword, $limit, $offset, $sort = 'ASC', $category_id = null)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }

            $keyword = "%$keyword%";
            $sort = strtoupper($sort) === 'DESC' ? 'DESC' : 'ASC';

            $sql = "
                SELECT p.*, pi.image_url, pi.is_main
                FROM products p
                LEFT JOIN product_images pi ON p.ID = pi.product_id
                WHERE p.name LIKE :keyword and p.is_locked = 0
            ";

            $params = [':keyword' => $keyword, ':limit' => $limit, ':offset' => $offset];

            if ($category_id !== null && $category_id > 0) {
                $sql .= " AND p.category_id = :category_id";
                $params[':category_id'] = $category_id;
            }

            $sql .= " ORDER BY p.price $sort, pi.is_main DESC, pi.created_at ASC
                      LIMIT :limit OFFSET :offset";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            if (isset($params[':category_id'])) {
                $stmt->bindParam(':category_id', $params[':category_id'], PDO::PARAM_INT);
            }

            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // ✅ GỘP sản phẩm theo ID
            $products = [];
            foreach ($rows as $row) {
                $productId = $row['ID'];

                // Nếu sản phẩm chưa được thêm vào
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
                        'images' => [] // Gộp ảnh vào đây
                    ];
                }

                // Nếu có ảnh, thêm ảnh vào mảng images[]
                if (!empty($row['image_url'])) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }

            // Trả về danh sách đã group lại
            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi trong searchByName: " . $e->getMessage());
            throw $e;
        }
    }


    public function getTotalByNameAndCategory($keyword, $category_id = null)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $keyword = "%$keyword%";
            $sql = "SELECT COUNT(*) as total FROM products WHERE name LIKE :keyword";
            $params = [':keyword' => $keyword];

            if ($category_id !== null && $category_id > 0) {
                $sql .= " AND category_id = :category_id";
                $params[':category_id'] = $category_id;
            }

            error_log("getTotalByNameAndCategory SQL: $sql");
            error_log("getTotalByNameAndCategory params: " . json_encode($params));

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
            if (isset($params[':category_id'])) {
                $stmt->bindParam(':category_id', $params[':category_id'], PDO::PARAM_INT);
            }
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            error_log("getTotalByNameAndCategory total: $total");
            return $total;
        } catch (Exception $e) {
            error_log("Lỗi trong getTotalByNameAndCategory: " . $e->getMessage());
            throw $e;
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
            error_log("create: Category '$name' created successfully");
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
            $query = "SELECT ID, name, description, top, created_at FROM " . $this->table_name . " WHERE top = 1 ";
           
            $query .= " ORDER BY name ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("getAllCategory: Found " . count($categories) . " categories");
            return $categories;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy danh mục: " . $e->getMessage());
            return [];
        }
    }

    // Search by name
    public function searchByName_category($search_term)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "SELECT ID, name, description, top, created_at FROM " . $this->table_name . " WHERE name LIKE :search_term ORDER BY name ASC";
            $stmt = $this->conn->prepare($query);
            $search_term = "%" . $search_term . "%";
            $stmt->bindParam(':search_term', $search_term);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("searchByName: Found " . count($categories) . " categories for term '$search_term'");
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
            $query = "SELECT ID, name, description, top, created_at FROM " . $this->table_name . " WHERE ID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("getById: " . ($category ? "Found category ID $id" : "Category ID $id not found"));
            return $category;
        } catch (Exception $e) {
            error_log("Lỗi khi lấy danh mục: " . $e->getMessage());
            return false;
        }
    }

    // Update
    public function update($id, $name, $description, $top)
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }
            $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, top = :top WHERE ID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':top', $top, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            error_log("update: Category ID $id updated successfully");
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
            $query = "DELETE FROM " . $this->table_name . " WHERE ID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            error_log("delete: Category ID $id deleted successfully");
            return true;
        } catch (Exception $e) {
            error_log("Lỗi khi xóa danh mục: " . $e->getMessage());
            return false;
        }
    }
    public function getPaginated($limit, $offset, $sort = 'ASC')
    {
        try {
            if ($this->conn === null) {
                throw new Exception("Không thể kết nối cơ sở dữ liệu.");
            }

            $sort = strtoupper($sort) === 'DESC' ? 'DESC' : 'ASC';

            // B1: Lấy ID sản phẩm theo LIMIT/OFFSET
            $stmt = $this->conn->prepare("
            SELECT ID FROM products
            ORDER BY price $sort
            LIMIT :limit OFFSET :offset
        ");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if (empty($ids)) {
                return [];
            }

            // Tạo chuỗi ID dạng ?,?,?
            $placeholders = implode(',', array_fill(0, count($ids), '?'));

            // B2: Lấy sản phẩm + ảnh theo ID
            $sql = "
            SELECT p.*, pi.image_url, pi.is_main
            FROM products p
            LEFT JOIN product_images pi ON p.ID = pi.product_id
            WHERE p.ID IN ($placeholders) and p.is_locked = 0
            ORDER BY p.price $sort, pi.is_main DESC
        ";
            $stmt = $this->conn->prepare($sql);
            foreach ($ids as $k => $id) {
                $stmt->bindValue($k + 1, $id, PDO::PARAM_INT);
            }
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Gộp ảnh theo sản phẩm ID
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

                if (!empty($row['image_url'])) {
                    $products[$productId]['images'][] = [
                        'image_url' => $row['image_url'],
                        'is_main' => $row['is_main']
                    ];
                }
            }

            return array_values($products);
        } catch (Exception $e) {
            error_log("Lỗi khi phân trang sản phẩm: " . $e->getMessage());
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
