<?php
class ArticleController
{
    private $article;

    public function __construct($db)
    {
        $this->article = new ArticleModel($db);
    }

    public function add()
    {
        header('Content-Type: application/json');
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
            // Lọc và xác thực dữ liệu đầu vào
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);

            // Kiểm tra các trường bắt buộc
            if (!$title || !$content) {
                echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ tiêu đề và nội dung.']);
                exit;
            }

            // Xử lý upload ảnh
            $image_url = null;
            $upload_dir = "../public/img/";
            if (!is_writable($upload_dir)) {
                echo json_encode(['success' => false, 'message' => 'Thư mục img không có quyền ghi.']);
                exit;
            }

            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img_name = $_FILES['img']['name'];
                $img_tmp = $_FILES['img']['tmp_name'];
                $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($img_ext, $allowed_exts)) {
                    echo json_encode(['success' => false, 'message' => "Định dạng ảnh $img_name không hợp lệ. Chỉ chấp nhận JPG, PNG, hoặc GIF."]);
                    exit;
                }

                $img_new_name = uniqid() . '.' . $img_ext;
                $target = $upload_dir . $img_new_name;
                if (!move_uploaded_file($img_tmp, $target)) {
                    echo json_encode(['success' => false, 'message' => "Tải ảnh $img_name lên thất bại."]);
                    exit;
                }
                $image_url = $img_new_name;
                error_log("Uploaded image: $img_new_name");
            }

            // Gọi phương thức add của model
            if ($this->article->add($title, $content, $author, $description, $note, $image_url)) {
                echo json_encode(['success' => true, 'message' => 'Thêm bài báo thành công.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Thêm bài báo thất bại.']);
            }
            exit;
        }

        // Tải view thêm bài báo
        require '../view/admin_article_add.php';
    }

    public function edit($id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        $article = $this->article->getById($id);
        if (!$article) {
            $_SESSION['error'] = "Không tìm thấy bài báo.";
            header("Location: ?controller=article&action=manage");
            exit;
        }

        if (isset($_POST['update_article'])) {
            // Lọc và xác thực dữ liệu đầu vào
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
            $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);

            // Kiểm tra các trường bắt buộc
            if (!$title || !$content) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ tiêu đề và nội dung.";
                header("Location: ?controller=article&action=edit&id=$id");
                exit;
            }

            // Xử lý upload ảnh
            $image_url = $article['image_url'] ?? null;
            $upload_dir = "../public/img/";
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img_name = $_FILES['img']['name'];
                $img_tmp = $_FILES['img']['tmp_name'];
                $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($img_ext, $allowed_exts)) {
                    $_SESSION['error'] = "Định dạng ảnh không hợp lệ. Chỉ chấp nhận JPG, PNG, hoặc GIF.";
                    header("Location: ?controller=article&action=edit&id=$id");
                    exit;
                }

                $img_new_name = uniqid() . '.' . $img_ext;
                $target = $upload_dir . $img_new_name;
                if (move_uploaded_file($img_tmp, $target)) {
                    // Xóa ảnh cũ nếu tồn tại
                    if ($image_url && file_exists("../public/img/" . $image_url)) {
                        unlink("../public/img/" . $image_url);
                    }
                    $image_url = $img_new_name;
                    error_log("Uploaded new image: $img_new_name");
                } else {
                    $_SESSION['error'] = "Tải ảnh lên thất bại.";
                    header("Location: ?controller=article&action=edit&id=$id");
                    exit;
                }
            }

            // Gọi phương thức update
            if ($this->article->update($id, $title, $content, $author, $description, $note, $image_url)) {
                $_SESSION['success'] = "Cập nhật bài báo thành công.";
                header("Location: ?controller=article&action=manage");
            } else {
                $_SESSION['error'] = "Cập nhật bài báo thất bại.";
                header("Location: ?controller=article&action=edit&id=$id");
            }
            exit;
        }

        require '../view/edit_article.php';
    }

    public function manage()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        // Lấy danh sách bài báo từ model
        $articles = $this->article->getAll();

        // Tải view và truyền dữ liệu
        require '../view/admin_article.php';
    }
}
