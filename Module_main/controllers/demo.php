<?php
require_once '../config/database.php';
require_once '../models/Product.php';

class ProductController
{
    private $product;

    public function __construct()
    {
        $db = new Database();
        $this->product = new Product($db->getConnection());
    }
    public function index()
    {


        // Lấy 3 sản phẩm mới nhất
        $latestProducts = $this->product->getLatest();

        // Thiết lập phân trang và tìm kiếm
        $itemsPerPage = 9; // Số sản phẩm mỗi trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
        if ($currentPage < 1) $currentPage = 1;

        $keyword = isset($_GET['search']) ? trim($_GET['search']) : ''; // Từ khóa tìm kiếm từ URL
        $offset = ($currentPage - 1) * $itemsPerPage; // Vị trí bắt đầu

        if (!empty($keyword)) {
            // Nếu có từ khóa, tìm kiếm theo tên
            $allProducts = $this->product->searchByName($keyword, $itemsPerPage, $offset);
            $totalItems = $this->product->getTotalByName($keyword);
        } else {
            // Nếu không có từ khóa, lấy tất cả sản phẩm
            $allProducts = $this->product->getPaginated($itemsPerPage, $offset);
            $totalItems = $this->product->getTotal();
        }

        $totalPages = ceil($totalItems / $itemsPerPage); // Tổng số trang
        if ($currentPage > $totalPages) $currentPage = $totalPages;

        require '../view/index.php';
    }
    public function inventory()
    {


        // Thiết lập phân trang
        $itemsPerPage = 9; // Số sản phẩm mỗi trang
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Trang hiện tại
        if ($currentPage < 1) $currentPage = 1;
        $offset = ($currentPage - 1) * $itemsPerPage; // Vị trí bắt đầu

        // Lấy danh sách sản phẩm tồn kho trên 3 tháng với phân trang
        $unsoldProducts = $this->product->getUnsoldProducts($itemsPerPage, $offset);
        $totalUnsoldItems = $this->product->getTotalUnsoldProducts();

        $totalPages = ceil($totalUnsoldItems / $itemsPerPage); // Tổng số trang
        if ($currentPage > $totalPages) $currentPage = $totalPages;

        require '../view/inventory.php';
    }
    public function manage()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }
        require '../view/admin_manager.php'; // Danh sách sản phẩm
    }

    public function add()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        if (isset($_POST['add_product'])) {
            // Sanitize and validate inputs
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

            // Validate required fields
            if (!$name || $price === false || $quantity === false || !$category_id) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ và đúng các trường bắt buộc.";
                header("Location: ?controller=product&action=add");
                exit;
            }

            // Handle file upload
            $image_url = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img_name = $_FILES['img']['name'];
                $img_tmp = $_FILES['img']['tmp_name'];
                $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                // Validate file extension
                if (!in_array($img_ext, $allowed_exts)) {
                    $_SESSION['error'] = "Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPG, PNG, hoặc GIF.";
                    header("Location: ?controller=product&action=add");
                    exit;
                }

                // Generate unique file name
                $img_new_name = uniqid() . '.' . $img_ext;
                $target = "../public/img/" . $img_new_name;

                if (move_uploaded_file($img_tmp, $target)) {
                    $image_url = $img_new_name;
                } else {
                    $_SESSION['error'] = "Tải ảnh lên thất bại.";
                    header("Location: ?controller=product&action=add");
                    exit;
                }
            }

            // Call model’s add method
            if ($this->product->add($name, $price, $quantity, $description, $category_id, $image_url)) {
                $_SESSION['success'] = "Thêm sản phẩm thành công.";
                header("Location: ?controller=product&action=manage");
            } else {
                $_SESSION['error'] = "Thêm sản phẩm thất bại.";
                header("Location: ?controller=product&action=add");
            }
            exit;
        }

        // Load the add product view
        require '../view/add_product.php';
    }

    public function edit($id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        $product = $this->product->getById($id);
        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm.";
            header("Location: ?controller=product&action=manage");
            exit;
        }

        if (isset($_POST['update_product'])) {
            // Sanitize and validate inputs
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

            // Validate required fields
            if (!$name || $price === false || $quantity === false || !$category_id) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ và đúng các trường bắt buộc.";
                header("Location: ?controller=product&action=edit&id=$id");
                exit;
            }

            // Handle file upload
            $image_url = $product['image_url'] ?? null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img_name = $_FILES['img']['name'];
                $img_tmp = $_FILES['img']['tmp_name'];
                $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                // Validate file extension
                if (!in_array($img_ext, $allowed_exts)) {
                    $_SESSION['error'] = "Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPG, PNG, hoặc GIF.";
                    header("Location: ?controller=product&action=edit&id=$id");
                    exit;
                }

                // Generate unique file name
                $img_new_name = uniqid() . '.' . $img_ext;
                $target = "../public/img/" . $img_new_name;

                if (move_uploaded_file($img_tmp, $target)) {
                    // Delete old image file if it exists
                    if ($image_url && file_exists("../public/img/" . $image_url)) {
                        unlink("../public/img/" . $image_url);
                    }
                    $image_url = $img_new_name;
                } else {
                    $_SESSION['error'] = "Tải ảnh lên thất bại.";
                    header("Location: ?controller=product&action=edit&id=$id");
                    exit;
                }
            }

            // Call model’s update method
            if ($this->product->update($id, $name, $price, $quantity, $description, $category_id, $image_url)) {
                $_SESSION['success'] = "Cập nhật sản phẩm thành công.";
                header("Location: ?controller=product&action=manage");
            } else {
                $_SESSION['error'] = "Cập nhật sản phẩm thất bại.";
                header("Location: ?controller=product&action=edit&id=$id");
            }
            exit;
        }

        // Load the edit product view
        require '../view/edit_product.php';
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
    public function detail($id)
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = "?controller=product&action=detail&id=$id";
            header("Location: ?controller=auth&action=login");
            exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === false || $id === null) {
            $_SESSION['error'] = "ID sản phẩm không hợp lệ.";
            header("Location: ?controller=product&action=index&redirected=1");
            exit;
        }
        $product = $this->product->getById($id);
        if (!$product) {
            $_SESSION['error'] = "Sản phẩm không tồn tại.";
            header("Location: ?controller=product&action=index&redirected=1");
            exit;
        }
        $categoryFmProductsone = $this->FarmingProcess->getAllMain();
        require_once '../view/detail.php';
    }



    public function delete($id)
    {
        if ($_SESSION['role'] !== 'admin') return;
        $this->product->delete($id);
        header("Location: ?controller=product&action=manage");
    }
}
