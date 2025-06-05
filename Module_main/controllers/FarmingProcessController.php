<?php
require_once '../config/database.php';
require_once '../models/FarmingProcessModel.php';

class FarmingProcessController
{
    private $farmingProcess;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->farmingProcess = new FarmingProcessModel($db->getConnection());
    }

    // public function add()
    // {
    //     header('Content-Type: application/json');
    //     if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    //         echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
    //         exit;
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_farming_process'])) {
    //         // Lọc và xác thực dữ liệu đầu vào
    //         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $process_order = filter_input(INPUT_POST, 'process_order', FILTER_VALIDATE_INT);
    //         $start_day = filter_input(INPUT_POST, 'start_day', FILTER_VALIDATE_INT);
    //         $end_day = filter_input(INPUT_POST, 'end_day', FILTER_VALIDATE_INT);
    //         $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

    //         // Kiểm tra các trường bắt buộc
    //         if (!$title || $process_order === false || $start_day === false || $end_day === false) {
    //             echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ và đúng các trường bắt buộc.']);
    //             exit;
    //         }

    //         // Kiểm tra logic ngày bắt đầu và kết thúc
    //         if ($start_day >= $end_day) {
    //             echo json_encode(['success' => false, 'message' => 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc.']);
    //             exit;
    //         }

    //         // Gọi phương thức add của model
    //         if ($this->farmingProcess->add($title, $description, $process_order, $start_day, $end_day, $note, $image_url)) {
    //             echo json_encode(['success' => true, 'message' => 'Thêm giai đoạn chăn nuôi thành công.']);
    //         } else {
    //             echo json_encode(['success' => false, 'message' => 'Thêm giai đoạn chăn nuôi thất bại.']);
    //         }
    //         exit;
    //     }

    //     // Tải view thêm giai đoạn
    //     require '../view/admin_farming_process_add.php';
    // }
    // public function edit($id)
    // {
    //     if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    //         header("Location: ?controller=auth&action=login");
    //         exit;
    //     }

    //     $process = $this->farmingProcess->getById($id);
    //     if (!$process) {
    //         $_SESSION['error'] = "Không tìm thấy giai đoạn chăn nuôi.";
    //         header("Location: ?controller=farming_process&action=manage");
    //         exit;
    //     }

    //     if (isset($_POST['update_farming_process'])) {
    //         // Lọc và xác thực dữ liệu đầu vào
    //         $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $process_order = filter_input(INPUT_POST, 'process_order', FILTER_VALIDATE_INT);
    //         $start_day = filter_input(INPUT_POST, 'start_day', FILTER_VALIDATE_INT);
    //         $end_day = filter_input(INPUT_POST, 'end_day', FILTER_VALIDATE_INT);
    //         $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

    //         // Kiểm tra các trường bắt buộc
    //         if (!$title || $process_order === false || $start_day === false || $end_day === false) {
    //             $_SESSION['error'] = "Vui lòng điền đầy đủ và đúng các trường bắt buộc.";
    //             header("Location: ?controller=farming_process&action=edit&id=$id");
    //             exit;
    //         }

    //         // Kiểm tra logic ngày bắt đầu và kết thúc
    //         if ($start_day >= $end_day) {
    //             $_SESSION['error'] = "Ngày bắt đầu phải nhỏ hơn ngày kết thúc.";
    //             header("Location: ?controller=farming_process&action=edit&id=$id");
    //             exit;
    //         }

    //         // Gọi phương thức update
    //         if ($this->farmingProcess->update($id,$title, $description, $process_order, $start_day, $end_day, $note, $image_url)) {
    //             $_SESSION['success'] = "Cập nhật giai đoạn chăn nuôi thành công.";
    //             header("Location: ?controller=farming_process&action=manage");
    //         } else {
    //             $_SESSION['error'] = "Cập nhật giai đoạn chăn nuôi thất bại.";
    //             header("Location: ?controller=farming_process&action=edit&id=$id");
    //         }
    //         exit;
    //     }

    //     // Tải view chỉnh sửa giai đoạn
    //     require '../view/edit_farming_process.php';
    // }
    public function detail2($id)
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        error_log("Received ID: " . var_export($id, true));
        $farmingProcess = $this->farmingProcess->getById($id);
        error_log("Fetched Article: " . var_export($farmingProcess, true));
        require_once '../view/detailfm.php';
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $process_order = $_POST['process_order'] ?? 0;
            $start_day = $_POST['start_day'] ?? 0;
            $end_day = $_POST['end_day'] ?? 0;
            $note = $_POST['note'] ?? '';
            $category_id = $_POST['category_id'] ?? 1;
            $image_url = null;
            $video_url = null;

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../public/img/";
                $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
                $image_url = $upload_dir . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
            }

            // Handle video upload
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../public/video/";
                $video_name = uniqid() . '_' . basename($_FILES['video']['name']);
                $video_url = $upload_dir . $video_name;
                move_uploaded_file($_FILES['video']['tmp_name'], $video_url);
            }

            $result = $this->farmingProcess->add($title, $description, $process_order, $start_day, $end_day, $note, $image_url, $video_url, $category_id);

            if ($result === true) {
                header("Location: ?controller=farming_process&action=manage&success=added");
                exit;
            } else {
                $error = $result['message'] ?? 'Error adding farming process';
                require '../view/admin_farming_process_add.php';
            }
        } else {
            $categories = $this->farmingProcess->CatergorygetAllfm();
            require '../view/admin_farming_process_add.php';
        }
    }
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $process_order = $_POST['process_order'] ?? 0;
            $start_day = $_POST['start_day'] ?? 0;
            $end_day = $_POST['end_day'] ?? 0;
            $note = $_POST['note'] ?? '';
            $category_id = $_POST['category_id'] ?? 1;
            $image_url = $_POST['existing_image'] ?? null;
            $video_url = $_POST['existing_video'] ?? null;

            // Handle new image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../public/img/";
                $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
                $image_url = $upload_dir . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
            }

            // Handle new video upload
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../public/video/";
                $video_name = uniqid() . '_' . basename($_FILES['video']['name']);
                $video_url = $upload_dir . $video_name;
                move_uploaded_file($_FILES['video']['tmp_name'], $video_url);
            }

            if ($this->farmingProcess->update($id, $title, $description, $process_order, $start_day, $end_day, $note, $image_url, $video_url, $category_id)) {
                header("Location: ?controller=farming_process&action=manage&success=updated");
                exit;
            } else {
                $error = 'Error updating farming process';
                $process = $this->farmingProcess->getById($id);
                $categories = $this->farmingProcess->CatergorygetAllfm();
                require '../view/edit_farming_process.php';
            }
        } else {
            $process = $this->farmingProcess->getById($id);
            if (!$process) {
                header("Location: ?controller=farming_process&action=manage&error=notfound");
                exit;
            }
            $categories = $this->farmingProcess->CatergorygetAllfm();
            require '../view/edit_farming_process.php';
        }
    }

    // public function delete($id)
    // {
    //     if ($this->model->delete($id)) {
    //         header("Location: ?controller=farming_process&action=manage&success=deleted");
    //         exit;
    //     } else {
    //         header("Location: ?controller=farming_process&action=manage&error=delete_failed");
    //         exit;
    //     }
    // }
    public function getAll()
    {
        header('Content-Type: application/json');
        $processes = $this->farmingProcess->getAll();

        if ($processes === []) {
            echo json_encode(['success' => false, 'message' => 'Không thể lấy danh sách giai đoạn chăn nuôi.']);
            exit;
        }

        echo json_encode(['success' => true, 'data' => $processes]);
        exit;
    }

    public function delete($id)
    {
        if ($_SESSION['role'] !== 'admin') return;
        $this->farmingProcess->delete($id);
        header("Location: ?controller=product&action=manage");
    }

    public function manage()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        // Lấy danh sách giai đoạn từ model
        $processes = $this->farmingProcess->getAll();

        // Tải view và truyền dữ liệu
        require '../view/admin_farming_process_list.php';
    
    }












/// category
    public function index2()
    {
        $top_only = isset($_GET['top_only']) && $_GET['top_only'] == 1;
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($search) {
            $categories = $this->farmingProcess->searchByName($search);
        } else {
            $categories = $this->farmingProcess->getAllCategory($top_only);
        }

        require '../view/far/index.php';
    }

    // public function create()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $name = $_POST['name'];
    //         $description = $_POST['description'];
    //         $top = isset($_POST['top']) ? 1 : 0;
    //         if ($this->farmingProcess->create($name, $description, $top)) {
    //             header("Location: ?controller=category_faming&action=index");
    //             exit;
    //         } else {
    //             echo "Lỗi khi tạo danh mục.";
    //         }
    //     }
    //     $category = null; // For create form
    //     require '../view/far/form.php';
    // }

    // public function edit_category($id)
    // {
    //     $category = $this->farmingProcess->getById_category($id);
    //     if (!$category) {
    //         echo "Danh mục không tồn tại.";
    //         return;
    //     }
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $name = $_POST['name'];
    //         $description = $_POST['description'];
    //         $top = isset($_POST['top']) ? 1 : 0;
    //         if ($this->farmingProcess->update_category($id, $name, $description, $top)) {
    //             header("Location: ?controller=category_faming&action=index");
    //             exit;
    //         } else {
    //             echo "Lỗi khi cập nhật danh mục.";
    //         }
    //     }
    //     require '../view/far/form.php';
    // }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $top = isset($_POST['top']) ? 1 : 0;

            if ($this->create($name, $description, $top)) {
                header("Location: ?controller=category_art&action=index");
                exit;
            } else {
                // Xử lý lỗi, ví dụ hiển thị thông báo
                echo "Lỗi khi tạo danh mục.";
            }
        } else {
            // Hiển thị form thêm mới
            require '../view/far/form.php';
        }
    }

    public function edit_category($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $top = isset($_POST['top']) ? 1 : 0;

            if ($this->farmingProcess->update_category($id, $name, $description, $top)) {
                header("Location: ?controller=category_art&action=index");
                exit;
            } else {
                // Xử lý lỗi
                echo "Lỗi khi cập nhật danh mục.";
            }
        } else {
            // Lấy dữ liệu danh mục để hiển thị form chỉnh sửa
            $category = $this->farmingProcess->getById_category($id);
            if ($category) {
                require '../view/far/form.php';;
            } else {
                echo "Danh mục không tồn tại.";
            }
        }
    }
    public function delete_category($id)
    {
        if ($this->farmingProcess->delete_category($id)) {
            header("Location: ?controller=category_faming&action=index");
            exit;
        } else {
            echo "Lỗi khi xóa danh mục.";
        }
    }
}
