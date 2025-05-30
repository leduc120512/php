<?php
require_once '../config/database.php';
require_once '../models/Order.php';
require_once '../models/Product.php';
require_once '../models/User.php';
require_once '../models/Cart.php';
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class OrderController
{
    private $order;
    private $product;
    private $user;
    private $cart;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->order = new Order($db->getConnection());
        $this->product = new Product($db->getConnection());
        $this->user = new User($db->getConnection());
        $this->cart = new Cart($db->getConnection());
    }
    public function exportExcel()
    {
        try {
            $orders = $this->order->getAll();
            if (empty($orders)) {
                return '<div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; text-align: center; padding: 15px; border-radius: 5px; font-family: Arial, sans-serif;">Thất bại: Không có đơn hàng nào để xuất.</div>';
            }

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Tiêu đề chính
            $sheet->mergeCells('A1:F1');
            $sheet->setCellValue('A1', 'Shop Bán Hoa quả - Báo Cáo Đơn Hàng');
            $sheet->getStyle('A1')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 18,
                    'color' => ['argb' => 'FFFFFFFF'],
                    'name' => 'Arial'
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                    'rotation' => 90,
                    'startColor' => ['argb' => 'FF4CAF50'],
                    'endColor' => ['argb' => 'FF81C784']
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM, 'color' => ['argb' => 'FF2E7D32']]
                ]
            ]);
            $sheet->getRowDimension(1)->setRowHeight(40);

            // Header (từ dòng 2)
            $headers = [
                'A2' => 'Tên người dùng',
                'B2' => 'Tên sản phẩm',
                'C2' => 'Số lượng',
                'D2' => 'Tổng tiền',
                'E2' => 'Trạng thái',
                'F2' => 'Thời gian tạo'
            ];
            foreach ($headers as $cell => $text) {
                $sheet->setCellValue($cell, $text);
            }

            // Style header
            $sheet->getStyle('A2:F2')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                    'size' => 12,
                    'name' => 'Arial'
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => 'FF000000']]
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF388E3C']
                ]
            ]);
            $sheet->getRowDimension(2)->setRowHeight(30);

            // Dữ liệu
            $row = 3;
            foreach ($orders as $index => $order) {
                $sheet->setCellValue("A$row", $order['username']);
                $sheet->setCellValue("B$row", $order['product_name']);
                $sheet->setCellValue("C$row", $order['quantity']);
                $sheet->setCellValue("D$row", $order['total_price']);
                $sheet->setCellValue("E$row", $order['status']);

                // Format thời gian tạo
                $createdAtFormatted = date('H:i d/m/Y', strtotime($order['created_at']));
                $sheet->setCellValue("F$row", $createdAtFormatted);

                // Style dữ liệu
                $sheet->getStyle("A$row:F$row")->applyFromArray([
                    'font' => ['size' => 11, 'name' => 'Arial'],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => ['argb' => 'FF000000']]
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => ($index % 2 == 0) ? 'FFF1F8E9' : 'FFFFFFFF']
                    ]
                ]);

                // Căn giữa cột Số lượng và Trạng thái
                $sheet->getStyle("C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("E$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $row++;
            }

            // Format tiền
            $sheet->getStyle("D3:D" . ($row - 1))->getNumberFormat()->setFormatCode('#,##0 " VNĐ"');

            // Set chiều rộng cột
            $sheet->getColumnDimension('A')->setWidth(25); // Tên người dùng
            $sheet->getColumnDimension('B')->setWidth(35); // Tên sản phẩm
            $sheet->getColumnDimension('C')->setWidth(12); // Số lượng
            $sheet->getColumnDimension('D')->setWidth(18); // Tổng tiền
            $sheet->getColumnDimension('E')->setWidth(15); // Trạng thái
            $sheet->getColumnDimension('F')->setWidth(20); // Thời gian tạo

            // Đặt tiêu đề file
            $sheet->setTitle('Báo Cáo Đơn Hàng');

            // Xuất file
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="bao_cao_don_hang_shop_hoa_qua.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            return '<div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; text-align: center; padding: 15px; border-radius: 5px; font-family: Arial, sans-serif;">Thất bại: Lỗi khi xuất đơn hàng - ' . $e->getMessage() . '</div>';
        }
    }

    public function addToCart()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
            header("Location: ?controller=auth&action=login");
            exit;
        }

        if (isset($_POST['add_to_cart'])) {
            $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if (!$product_id || !$quantity || $quantity < 1) {
                $_SESSION['error'] = "Số lượng không hợp lệ.";
                header("Location: ?controller=product&action=detail&id=$product_id");
                exit;
            }

            $product = $this->product->getById($product_id);
            if (!$product) {
                $_SESSION['error'] = "Sản phẩm không tồn tại.";
                header("Location: ?controller=product&action=index");
                exit;
            }

            if ($quantity > $product['quantity']) {
                $_SESSION['error'] = "Số lượng yêu cầu vượt quá tồn kho. Còn lại: " . $product['quantity'];
                header("Location: ?controller=product&action=detail&id=$product_id");
                exit;
            }

            $result = $this->cart->addToCart($_SESSION['user_id'], $product_id, $quantity);
            if ($result) {
                $_SESSION['success'] = "Sản phẩm đã được thêm vào giỏ hàng!";
            } else {
                $_SESSION['error'] = "Không thể thêm sản phẩm vào giỏ hàng.";
            }
            header("Location: ?controller=product&action=detail&id=$product_id");
            exit;
        }
    }
    public function removeFromCart()
    {
        $product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($product_id && isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
            $_SESSION['success'] = "Đã xóa sản phẩm khỏi giỏ hàng.";
        }
        header("Location: ?controller=order&action=viewCart");
        exit;
    }
    public function viewCart()
    {
        error_log("viewCart method called"); // Log to error log
        // Output to screen
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include '../view/cart.php';
    }

    

    public function myOrders()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem đơn hàng của bạn.";
            header("Location: ?controller=auth&action=login");
            exit;
        }

        $orders = $this->order->getByUserId($_SESSION['user_id']);
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



    public function admin()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }

        // Get search parameters from GET request
        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        // Fetch orders with search filters
        $orders = $this->order->getAll($username, $product_name, $start_date, $end_date);

        require '../view/admin.php';
        require '../view/admin_order.php';
    }

    public function viewOrders()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }

        // Get search parameters
        $username = isset($_GET['username']) ? trim($_GET['username']) : '';
        $product_name = isset($_GET['product_name']) ? trim($_GET['product_name']) : '';
        $start_date = isset($_GET['start_date']) ? trim($_GET['start_date']) : '';
        $end_date = isset($_GET['end_date']) ? trim($_GET['end_date']) : '';

        // Validate date range
        if ($start_date && $end_date && strtotime($start_date) > strtotime($end_date)) {
            // Handle invalid date range (e.g., display error or swap dates)
            $temp = $start_date;
            $start_date = $end_date;
            $end_date = $temp;
        }

        // Fetch orders with filters
        $orders = $this->order->getAll($username, $product_name, $start_date, $end_date);

        // Debugging: Check the orders array
        // var_dump($orders); // Uncomment for debugging, remove after testing

        // require '../view/admin_manager.php';
        require '../view/admin.php';
    }


    public function updateStatus($order_id, $status)
    {
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');
        error_log("updateStatus called with order_id: $order_id, status: $status");

        // Kiểm tra status hợp lệ
        $valid_statuses = ['pending', 'completed', 'cancelled'];
        if (!$status || !in_array($status, $valid_statuses)) {
            error_log("Invalid or empty status: $status");
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid status']);
            exit;
        }

        // Cập nhật trạng thái
        if ($this->order->updateStatus($order_id, $status)) {
            echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
        } else {
            error_log("Failed to update status for order_id: $order_id");
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update status']);
        }
        exit;
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Phương thức không được phép']);
            exit;
        }

        $product_id = isset($_POST['product_id']) ? filter_var($_POST['product_id'], FILTER_VALIDATE_INT) : null;
        $phone = isset($_POST['phone']) ? filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) : '';
        $note = isset($_POST['note']) ? filter_input(INPUT_POST, 'note', FILTER_SANITIZE_STRING) : '';

        // Validate inputs
        if (!$product_id || !$phone) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Số điện thoại và sản phẩm là bắt buộc']);
            exit;
        }

        // Validate phone number (Vietnamese format: 10 digits, starts with 0)
        if (!preg_match('/^0[0-9]{9}$/', $phone)) {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Số điện thoại không hợp lệ']);
            exit;
        }

        // Create order
        $user_id = 1; // Default guest user ID (adjust if authenticated)
        $quantity = 1; // Default quantity
        $result = $this->order->createOrder($user_id, $product_id, $quantity, 0, $phone, $note); // total_price fetched in model
        header('Content-Type: application/json');
        if ($result['success']) {
            // Initialize PHPMailer
            require_once 'PHPMailer-master/src/Exception.php';
            require_once 'PHPMailer-master/src/PHPMailer.php';
            require_once 'PHPMailer-master/src/SMTP.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // SMTP configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mailleduc05122004@gmail.com';
                $mail->Password = 'unicbkpxtmahtuzn'; // Consider using environment variables for security
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Email configuration
                $mail->setFrom('mailleduc05122004@gmail.com', 'Shop Admin');
                $mail->addAddress('mailleduc05122004@gmail.com'); // Hardcoded recipient email
                $mail->isHTML(true);
                $mail->Subject = 'Lien he tu van';
                $mail->Body = '
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; border: 2px dashed #ff9900; padding: 20px; background: #fffbe6; border-radius: 10px;">
        <h2 style="color: #d35400; text-align: center;">🐔 Có khách cần tư vấn liền tay! 🐔</h2>
        <p style="font-size: 16px; color: #333;"><strong>Tên sản phẩm:</strong> <span style="color: #c0392b;">' . htmlspecialchars($result['product_name']) . '</span></p>
        <p style="font-size: 16px; color: #333;"><strong>Mã sản phẩm:</strong> <span style="color: #2980b9;">' . htmlspecialchars($product_id) . '</span></p>
        <p style="font-size: 16px; color: #333;"><strong>Số điện thoại khách:</strong> <span style="color: #27ae60;">' . htmlspecialchars($phone) . '</span></p>
        <p style="font-size: 16px; color: #333;"><strong>Ghi chú:</strong> ' . nl2br(htmlspecialchars($note)) . '</p>
        <p style="font-size: 16px; color: #e74c3c; font-weight: bold;">📞 Hãy gọi cho khách ngay – kẻo mất đơn nha! 📞</p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="tel:' . htmlspecialchars($phone) . '" style="background: #e67e22; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">GỌI NGAY</a>
        </div>
    </div>
';

                $mail->AltBody = 'Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đã được ghi nhận. Tên sản phẩm: ' . htmlspecialchars($result['product_name']) . ', Mã sản phẩm: ' . htmlspecialchars($product_id) . ', Số điện thoại: ' . htmlspecialchars($phone) . ', Ghi chú: ' . htmlspecialchars($note) . '.';

                // Send email
                $mail->send();
                echo json_encode(['success' => true, 'message' => 'Đơn hàng đã được tạo và email xác nhận đã được gửi']);
            } catch (Exception $e) {
                // Log the error (optional) and return success for order creation but note email failure
                error_log('PHPMailer Error: ' . $mail->ErrorInfo);
                echo json_encode(['success' => true, 'message' => 'Đơn hàng đã được tạo nhưng gửi email thất bại']);
            }
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $result['message']]);
        }
    }
}
