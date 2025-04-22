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
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?controller=auth&action=login");
            exit;
        }

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
        if ($_SESSION['role'] !== 'admin') return;
        if (isset($_POST['add_product'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $target = "../public/img/" . basename($img);
            if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
                $this->product->add($name, $img, $price, $quantity, $description);
                header("Location: ?controller=order&action=admin");
                exit;
            }
        }
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
        require_once '../view/detail.php';
    }

    public function edit($id)
    {
        if ($_SESSION['role'] !== 'admin') return;
        $product = $this->product->getById($id);

        if (isset($_POST['update_product'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $img = $product['img'];
            if ($_FILES['img']['name']) {
                $img = $_FILES['img']['name'];
                $target = "../public/img/" . basename($img);
                move_uploaded_file($_FILES['img']['tmp_name'], $target);
            }

            $this->product->update($id, $name, $img, $price, $quantity, $description);
            header("Location: ?controller=order&action=admin");
            exit;
        }
        require '../view/edit_product.php';
    }

    public function delete($id)
    {
        if ($_SESSION['role'] !== 'admin') return;
        $this->product->delete($id);
        header("Location: ?controller=order&action=admin");
    }
}
