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

    public function add()
    {
        header('Content-Type: application/json');
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_farming_process'])) {
            // Lọc và xác thực dữ liệu đầu vào
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $process_order = filter_input(INPUT_POST, 'process_order', FILTER_VALIDATE_INT);
            $start_day = filter_input(INPUT_POST, 'start_day', FILTER_VALIDATE_INT);
            $end_day = filter_input(INPUT_POST, 'end_day', FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);
            $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

            // Kiểm tra các trường bắt buộc
            if (!$title || $process_order === false || $start_day === false || $end_day === false) {
                echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ và đúng các trường bắt buộc.']);
                exit;
            }

            // Kiểm tra logic ngày bắt đầu và kết thúc
            if ($start_day >= $end_day) {
                echo json_encode(['success' => false, 'message' => 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc.']);
                exit;
            }

            // Gọi phương thức add của model
            if ($this->farmingProcess->add($title, $description, $process_order, $start_day, $end_day, $note, $image_url)) {
                echo json_encode(['success' => true, 'message' => 'Thêm giai đoạn chăn nuôi thành công.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Thêm giai đoạn chăn nuôi thất bại.']);
            }
            exit;
        }

        // Tải view thêm giai đoạn
        require '../view/admin_farming_process_add.php';
    }
    public function edit($id)
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        $process = $this->farmingProcess->getById($id);
        if (!$process) {
            $_SESSION['error'] = "Không tìm thấy giai đoạn chăn nuôi.";
            header("Location: ?controller=farming_process&action=manage");
            exit;
        }

        if (isset($_POST['update_farming_process'])) {
            // Lọc và xác thực dữ liệu đầu vào
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            $process_order = filter_input(INPUT_POST, 'process_order', FILTER_VALIDATE_INT);
            $start_day = filter_input(INPUT_POST, 'start_day', FILTER_VALIDATE_INT);
            $end_day = filter_input(INPUT_POST, 'end_day', FILTER_VALIDATE_INT);
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);
            $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

            // Kiểm tra các trường bắt buộc
            if (!$title || $process_order === false || $start_day === false || $end_day === false) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ và đúng các trường bắt buộc.";
                header("Location: ?controller=farming_process&action=edit&id=$id");
                exit;
            }

            // Kiểm tra logic ngày bắt đầu và kết thúc
            if ($start_day >= $end_day) {
                $_SESSION['error'] = "Ngày bắt đầu phải nhỏ hơn ngày kết thúc.";
                header("Location: ?controller=farming_process&action=edit&id=$id");
                exit;
            }

            // Gọi phương thức update
            if ($this->farmingProcess->update($id,$title, $description, $process_order, $start_day, $end_day, $note, $image_url)) {
                $_SESSION['success'] = "Cập nhật giai đoạn chăn nuôi thành công.";
                header("Location: ?controller=farming_process&action=manage");
            } else {
                $_SESSION['error'] = "Cập nhật giai đoạn chăn nuôi thất bại.";
                header("Location: ?controller=farming_process&action=edit&id=$id");
            }
            exit;
        }

        // Tải view chỉnh sửa giai đoạn
        require '../view/edit_farming_process.php';
    }

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
        header('Content-Type: application/json');
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            echo json_encode(['success' => false, 'message' => 'Bạn không có quyền truy cập.']);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $process = $this->farmingProcess->getById($id);
            if (!$process) {
                echo json_encode(['success' => false, 'message' => 'Không tìm thấy giai đoạn chăn nuôi.']);
                exit;
            }

            if ($this->farmingProcess->delete($id)) {
                echo json_encode(['success' => true, 'message' => 'Xóa giai đoạn chăn nuôi thành công.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Xóa giai đoạn chăn nuôi thất bại.']);
            }
            exit;
        }

        echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
        exit;
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
    
}
