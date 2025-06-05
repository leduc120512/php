<?php
require_once '../config/database.php';
require_once '../models/Product.php';

class CategoryController
{
    private $category;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->category = new Product($db->getConnection());
      
    }

    public function index()
    {
        $top_only = isset($_GET['top_only']) && $_GET['top_only'] == 1;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search) {
            $categories = $this->category->searchByName_category($search);
        } else {
            $categories = $this->category->getAllCategory($top_only);
        }

        require '../view/CategoryList.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $top = isset($_POST['top']) ? 1 : 0;
            if ($this->category->create($name, $description, $top)) {
                header("Location: ?controller=category_art&action=index");
                exit;
            } else {
                echo "Lỗi khi tạo danh mục.";
            }
        }
        $category = null; // For create form
        require '../view/form_category.php';
    }

    public function edit($id)
    {
        $category = $this->category->getById_category($id);
        if (!$category) {
            echo "Danh mục không tồn tại.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $top = isset($_POST['top']) ? 1 : 0;
            if ($this->category->update($id, $name, $description, $top)) {
                header("Location: ?controller=category_art&action=index");
                exit;
            } else {
                echo "Lỗi khi cập nhật danh mục.";
            }
        }
        require '../view/form_category.php';
    }

    public function delete($id)
    {
        if ($this->category->delete_category($id)) {
            header("Location: ?controller=category_art&action=index");
            exit;
        } else {
            echo "Lỗi khi xóa danh mục.";
        }
    }
}
