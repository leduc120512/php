<?php
// Xóa session_start() ở đây
require_once '../config/database.php';
require_once '../models/Order.php';
require_once '../models/Product.php';

class OrderController
{
    private $order;
    private $product;

    public function __construct()
    {
        $db = new Database();
        $this->order = new Order($db->getConnection());
        $this->product = new Product($db->getConnection());
    }
    public function myOrders()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem đơn hàng của bạn.";
            header("Location: ?controller=auth&action=login");
            exit;
        }

        // Lấy danh sách đơn hàng của người dùng hiện tại
        $orders = $this->order->getByUserId($_SESSION['user_id']);

        // Load view để hiển thị đơn hàng
        require '../view/my_orders.php';
    }
    public function search()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            echo json_encode([]);
            exit;
        }

        $order_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_STRING);
        $start_date = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
        $end_date = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);

        $orders = $this->order->searchOrders($order_id, $start_date, $end_date);
        header('Content-Type: application/json');
        echo json_encode($orders);
        exit;
    }
    public function buy()
    {
        if (isset($_POST['buy'])) {
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            // Kiểm tra dữ liệu đầu vào
            if (!$product_id || !$quantity || $quantity < 1) {
                $_SESSION['error'] = "Số lượng không hợp lệ.";
                header("Location: ?controller=product&action=detail&id=$product_id");
                exit;
            }

            // Lấy thông tin sản phẩm
            $product = $this->product->getById($product_id);
            if (!$product) {
                $_SESSION['error'] = "Sản phẩm không tồn tại.";
                header("Location: ?controller=product&action=index");
                exit;
            }

            // Kiểm tra số lượng có vượt quá tồn kho không
            if ($quantity > $product['quantity']) {
                $_SESSION['error'] = "Số lượng yêu cầu vượt quá tồn kho. Còn lại: " . $product['quantity'];
                header("Location: ?controller=product&action=detail&id=$product_id");
                exit;
            }

            // Tính tổng tiền và tạo đơn hàng
            $total_price = $product['price'] * $quantity;
            $this->order->create($_SESSION['user_id'], $product_id, $quantity, $total_price);

            // Cập nhật số lượng sản phẩm trong database
            $new_quantity = $product['quantity'] - $quantity;
            $this->product->update($product_id, $product['name'], $product['img'], $product['price'], $new_quantity, $product['description']);

            // Chuyển hướng về trang chính
            header("Location: ?controller=product&action=index");
            exit;
        }
    }

    public function exportExcel()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }

        // Lấy tất cả đơn hàng
        $orders = $this->order->getAll();

        // Include PHPExcel
        require_once '../PHPExcel/Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();

        // Tiêu đề cột
        $sheet->setCellValue('A1', 'Tên người dùng');
        $sheet->setCellValue('B1', 'Tên sản phẩm');
        $sheet->setCellValue('C1', 'Số lượng');
        $sheet->setCellValue('D1', 'Tổng tiền');
        $sheet->setCellValue('E1', 'Trạng thái');

        $row = 2;
        foreach ($orders as $order) {
            $sheet->setCellValue('A' . $row, $order['username']);
            $sheet->setCellValue('B' . $row, $order['product_name']);
            $sheet->setCellValue('C' . $row, $order['quantity']);
            $sheet->setCellValue('D' . $row, $order['total_price']);
            $sheet->setCellValue('E' . $row, $order['status']);
            $row++;
        }

        // Header cho trình duyệt tải về
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="don_hang.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function admin()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }

        $orders = $this->order->getAll();

        // Load cả hai file view
        require '../view/admin.php';         // File chính cho giao diện admin
        // File phụ, có thể là nội dung bổ sung
        require '../view/admin_order.php';
        // Hoặc bạn có thể kiểm soát việc hiển thị bằng cách tách biệt
        // echo "<div class='admin-main'>";
        // require '../view/admin.php';
        // echo "</div><div class='admin-remote'>";
        // require '../view/admin_remote.php';
        // echo "</div>";
    }
    public function viewOrders()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }
        $orders = $this->order->getAll();
        require '../view/admin_manager.php'; // Hiển thị danh sách đơn hàng

        require '../view/admin.php';
    }
    public function updateStatus($order_id)
    {
        if ($_SESSION['role'] === 'admin' && isset($_POST['status'])) {
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $this->order->updateStatus($order_id, $status);
        }
        header("Location: ?controller=order&action=admin");
    }
}
