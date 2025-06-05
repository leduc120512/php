<?php
require_once '../config/database.php';
require_once '../models/ArticleModel.php';

class ArticleController
{
    private $article;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->article = new ArticleModel($db->getConnection());
    }

    // public function add()
    // {
    //     // Kiểm tra quyền truy cập
    //     if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    //         header('Content-Type: application/json');
    //         echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
    //         exit;
    //     }

    //     // Nếu là phương thức POST thì xử lý dữ liệu
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    //         header('Content-Type: application/json');

    //         // Lọc và xác thực dữ liệu đầu vào
    //         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS); // Sửa decription thành description
    //         $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT) ?: 1; // Thêm category_id

    //         // Kiểm tra trường bắt buộc
    //         if (!$title || !$content) {
    //             echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ tiêu đề và nội dung.']);
    //             exit;
    //         }

    //         // Xử lý ảnh
    //         $image_url = null;
    //         $upload_dir = "../public/img/";
    //         if (!is_writable($upload_dir)) {
    //             echo json_encode(['success' => false, 'message' => 'Thư mục img không có quyền ghi.']);
    //             exit;
    //         }

    //         if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    //             $img_name = $_FILES['img']['name'];
    //             $img_tmp = $_FILES['img']['tmp_name'];
    //             $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    //             $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

    //             if (!in_array($img_ext, $allowed_exts)) {
    //                 echo json_encode(['success' => false, 'message' => "Định dạng ảnh $img_name không hợp lệ. Chỉ chấp nhận JPG, PNG, hoặc GIF."]);
    //                 exit;
    //             }

    //             $img_new_name = uniqid() . '.' . $img_ext;
    //             $target = $upload_dir . $img_new_name;
    //             if (!move_uploaded_file($img_tmp, $target)) {
    //                 echo json_encode(['success' => false, 'message' => "Tải ảnh $img_name lên thất bại."]);
    //                 exit;
    //             }
    //             $image_url = $img_new_name;
    //         }

    //         // Lưu vào database
    //         if ($this->article->add($title, $content, $author, $description, $note, $image_url, $category_id)) {
    //             echo json_encode(['success' => true, 'message' => 'Thêm bài báo thành công.']);
    //         } else {
    //             echo json_encode(['success' => false, 'message' => 'Thêm bài báo thất bại. Vui lòng kiểm tra log lỗi server.']);
    //         }
    //         exit;
    //     }

    //     // Nếu không phải POST thì hiển thị view thêm bài báo
    //     require '../view/admin_article_add.php';
    // }


    // public function edit($id)
    // {
    //     if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    //         header("Location: ?controller=auth&action=login");
    //         exit;
    //     }

    //     $article = $this->article->getById($id);
    //     if (!$article) {
    //         $_SESSION['error'] = "Không tìm thấy bài báo.";
    //         header("Location: ?controller=article&action=manage");
    //         exit;
    //     }

    //     if (isset($_POST['update_article'])) {
    //         // Lọc và xác thực dữ liệu đầu vào
    //         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $decription = filter_input(INPUT_POST, 'decription', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);

    //         // Kiểm tra các trường bắt buộc
    //         if (!$title || !$content) {
    //             $_SESSION['error'] = "Vui lòng điền đầy đủ tiêu đề và nội dung.";
    //             header("Location: ?controller=article&action=edit&id=$id");
    //             exit;
    //         }

    //         // Xử lý upload ảnh
    //         $image_url = $article['image_url'] ?? null;
    //         $upload_dir = "../public/img/";
    //         if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    //             $img_name = $_FILES['img']['name'];
    //             $img_tmp = $_FILES['img']['tmp_name'];
    //             $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    //             $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

    //             if (!in_array($img_ext, $allowed_exts)) {
    //                 $_SESSION['error'] = "Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPG, PNG, hoặc GIF.";
    //                 header("Location: ?controller=article&action=edit&id=$id");
    //                 exit;
    //             }

    //             $img_new_name = uniqid() . '.' . $img_ext;
    //             $target = $upload_dir . $img_new_name;
    //             if (move_uploaded_file($img_tmp, $target)) {
    //                 // Xóa ảnh cũ nếu tồn tại
    //                 if ($image_url && file_exists("../public/img/" . $image_url)) {
    //                     unlink("../public/img/" . $image_url);
    //                 }
    //                 $image_url = $img_new_name;
    //                 error_log("Uploaded new image: $img_new_name");
    //             } else {
    //                 $_SESSION['error'] = "Tải ảnh lên thất bại.";
    //                 header("Location: ?controller=article&action=edit&id=$id");
    //                 exit;
    //             }
    //         }

    //         // Gọi phương thức update
    //         if ($this->article->update($id, $title, $content, $author, $decription, $note, $image_url)) {
    //             $_SESSION['success'] = "Cập nhật bài báo thành công.";
    //             header("Location: ?controller=article&action=manage");
    //         } else {
    //             $_SESSION['error'] = "Cập nhật bài báo thất bại.";
    //             header("Location: ?controller=article&action=edit&id=$id");
    //         }
    //         exit;
    //     }

    //     require '../view/edit_article.php';
    // }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $author = $_POST['author'] ?? '';
            $description = $_POST['description'] ?? '';
            $note = $_POST['note'] ?? '';
            $category_id = $_POST['category_id'] ?? 1;
            $image_url = null;

            // Handle file upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../public/img/";
                $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
                $image_url = $upload_dir . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
            }

            $result = $this->article->add($title, $content, $author, $description, $note, $image_url, $category_id);

            if ($result === true) {
                header("Location: ?controller=article&action=manage&success=added");
                exit;
            } else {
                $error = $result['message'] ?? 'Error adding article';
                require '../view/admin_article_add.php';
            }
        } else {
            $categories = $this->article->CatergorygetAllAt();
            require '../view/admin_article_add.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $author = $_POST['author'] ?? '';
            $description = $_POST['description'] ?? '';
            $note = $_POST['note'] ?? '';
            $image_url = $_POST['existing_image'] ?? null;

            // Handle new file upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../public/img/";
                $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
                $image_url = $upload_dir . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
            }

            if ($this->article->update($id, $title, $content, $author, $description, $note, $image_url)) {
                header("Location: ?controller=article&action=manage&success=updated");
                exit;
            } else {
                $error = 'Error updating article';
                $article = $this->article->getById($id);
                $categories = $this->article->CatergorygetAllAt();
                require '../view/edit_article.php';
            }
        } else {
            $article = $this->article->getById($id);
            if (!$article) {
                header("Location: ?controller=article&action=manage&error=notfound");
                exit;
            }
            $categories = $this->article->CatergorygetAllAt();
            require '../view/edit_article.php';
        }
    }

    // public function delete($id)
    // {
    //     try {
    //         $stmt = $this->article->conn->prepare("DELETE FROM articles WHERE id = :id");
    //         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //         $stmt->execute();
    //         header("Location: ?controller=article&action=manage&success=deleted");
    //         exit;
    //     } catch (PDOException $e) {
    //         error_log("Error deleting article: " . $e->getMessage());
    //         header("Location: ?controller=article&action=manage&error=delete_failed");
    //         exit;
    //     }
    // }
    public function manage()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        // Lấy danh sách bài báo từ model
        $articles = $this->article->getAllAt();

        // Tải view và truyền dữ liệu
        require '../view/admin_article.php';
    }
    // public function index()
    // {
    //     $articles = $this->article->getAllAt() ?: []; // Fallback to empty array
    //     if (empty($articles)) {
    //         error_log("No articles found in index method");
    //     }
    //     require '../view/Art.php';
    // } // Trong ArticleController
    public function searchAjax()
    {
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
        $articles = $this->article->getAllAt($category_id);
        header('Content-Type: application/json');
        echo json_encode($articles);
        exit;
    }
    public function delete($id)
    {
        if ($_SESSION['role'] !== 'admin') return;
        $this->article->delete($id);
        header("Location: ?controller=product&action=manage");
    }
    public function index()
    {
        // Lấy category_id từ request
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

        // Gọi Model để lấy dữ liệu
        $articles = $this->article->getAllAt($category_id);
        $categoryArt = $this->article->CatergorygetAllAt();

        // Load view và truyền dữ liệu
        require '../view/Art.php';
    }
    public function detail2($id)
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        error_log("Received ID: " . var_export($id, true));
        $article = $this->article->getById($id);
        error_log("Fetched Article: " . var_export($article, true));
        require_once '../view/detailArt.php';
    }
//category


    public function index_category()
    {
        $top_only = isset($_GET['top_only']) && $_GET['top_only'] == 1;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search) {
            $categories = $this->article->searchByName($search);
        } else {
            $categories = $this->article->getAllCategory($top_only);
        }

        require '../view/art/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $top = isset($_POST['top']) ? 1 : 0;
            if ($this->article->create($name, $description, $top)) {
                header("Location: ?controller=categories_art&action=index");
                exit;
            } else {
                echo "Lỗi khi tạo danh mục.";
            }
        }
        $category = null; // For create form
        require '../view/art/form.php';
    }

    public function edit_catergory($id)
    {
        $category = $this->article->getById_category($id);
        if (!$category) {
            echo "Danh mục không tồn tại.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $top = isset($_POST['top']) ? 1 : 0;
            if ($this->article->update_category($id, $name, $description, $top)) {
                header("Location: ?controller=categories_art&action=index");
                exit;
            } else {
                echo "Lỗi khi cập nhật danh mục.";
            }
        }
        require '../view/art/form.php';
    }

    public function delete_category($id)
    {
        if ($this->article->delete_category($id)) {
            header("Location: ?controller=categories_art&action=index");
            exit;
        } else {
            echo "Lỗi khi xóa danh mục.";
        }
    }
}
