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

    public function buyFromCart()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để đặt hàng.";
            header("Location: ?controller=auth&action=login");
            exit;
        }

        $cart_items = $this->cart->getCartByUserId($_SESSION['user_id']);
        if (empty($cart_items)) {
            $_SESSION['error'] = "Giỏ hàng của bạn đang trống.";
            header("Location: ?controller=order&action=viewCart");
            exit;
        }

        foreach ($cart_items as $item) {
            $product = $this->product->getById($item['product_id']);
            if ($item['quantity'] > $product['quantity']) {
                $_SESSION['error'] = "Số lượng sản phẩm {$product['name']} vượt quá tồn kho. Còn lại: " . $product['quantity'];
                header("Location: ?controller=order&action=viewCart");
                exit;
            }

            $total_price = $product['price'] * $item['quantity'];
            $order_id = $this->order->create($_SESSION['user_id'], $item['product_id'], $item['quantity'], $total_price);

            if ($order_id === false) {
                $_SESSION['error'] = "Không thể tạo đơn hàng cho sản phẩm {$product['name']}.";
                header("Location: ?controller=order&action=viewCart");
                exit;
            }

            $new_quantity = $product['quantity'] - $item['quantity'];
            $this->product->update($item['product_id'], $product['name'], $product['img'], $product['price'], $new_quantity, $product['description']);

            $user = $this->user->getById($_SESSION['user_id']);
            if ($user && isset($user['email'])) {
                $this->sendOrderEmail($user['email'], $product['name'], $item['quantity'], $total_price, $order_id);
            }
        }

        // Clear the cart after successful order
        $this->cart->clearCart($_SESSION['user_id']);
        $_SESSION['success'] = "Đơn hàng đã được tạo thành công từ giỏ hàng!";
        header("Location: ?controller=order&action=myOrders");
        exit;
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

    private function sendOrderEmail($email, $products, $total_price, $order_id)
    {
        require_once 'PHPMailer-master/src/Exception.php';
        require_once 'PHPMailer-master/src/PHPMailer.php';
        require_once 'PHPMailer-master/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mailleduc05122004@gmail.com';
            $mail->Password = 'guezbvjtsdwubjlt'; // Gợi ý: nên dùng biến môi trường để bảo mật hơn
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('mailleduc05122004@gmail.com', 'Shop Admin');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đơn hàng #' . $order_id;

            // Build product list for the email
            $product_list_html = '';
            $product_list_text = '';
            foreach ($products as $product) {
                $subtotal = $product['price'] * $product['quantity'];
                $product_list_html .= "
                <tr>
                    <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>{$product['name']}</td>
                    <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>{$product['quantity']}</td>
                    <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>" . number_format($subtotal, 0, ',', '.') . " VND</td>
                </tr>";
                $product_list_text .= "Sản phẩm: {$product['name']}, Số lượng: {$product['quantity']}, Tổng: " . number_format($subtotal, 0, ',', '.') . " VND\n";
            }

            // Enhanced email template with modern design
            $mail->Body = "
        <!DOCTYPE html>
        <html lang='vi'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Xác nhận đơn hàng</title>
        </head>
        <body style='margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, Arial, sans-serif; background-color: #f1f5f9;'>
            <div style='max-width: 640px; margin: 20px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);'>
                <!-- Header -->
                <div style='background: linear-gradient(135deg, #2a9d8f, #34d399); padding: 20px; text-align: center;'>
                    <h1 style='color: #ffffff; font-size: 24px; margin: 0; font-weight: 600;'>Shop Name</h1>
                    <p style='color: #e6fffa; font-size: 14px; margin: 5px 0 0;'>Xác nhận đơn hàng của bạn</p>
                </div>

                <!-- Content -->
                <div style='padding: 24px;'>
                    <h2 style='color: #1f2937; font-size: 20px; font-weight: 600; text-align: center; margin-bottom: 16px;'>🎉 Cảm ơn bạn đã mua sắm!</h2>
                    <p style='color: #4b5563; font-size: 15px; line-height: 1.5; margin-bottom: 20px;'>Chúng tôi đã nhận được đơn hàng của bạn với thông tin chi tiết như sau:</p>
                    
                    <!-- Order Details Table -->
                    <table style='width: 100%; border-collapse: collapse; font-size: 14px; color: #374151;'>
                        <tr style='background-color: #f8fafc;'>
                            <td style='padding: 12px; font-weight: 600; border-bottom: 1px solid #e5e7eb;'>Mã đơn hàng</td>
                            <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>#$order_id</td>
                        </tr>
                        <tr>
                          
                            <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>
                                <table style='width: 100%; border-collapse: collapse;'>
                                    <tr style='background-color: #f8fafc;'>
                                        <th style='padding: 12px; font-weight: 600; text-align: left;'>Tên sản phẩm</th>
                                        <th style='padding: 12px; font-weight: 600; text-align: left;'>Số lượng</th>
                                        <th style='padding: 12px; font-weight: 600; text-align: left;'>Tổng</th>
                                    </tr>
                                    $product_list_html
                                </table>
                            </td>
                        </tr>
                        <tr style='background-color: #f8fafc;'>
                            <td style='padding: 12px; font-weight: 600; border-bottom: 1px solid #e5e7eb;'>Tổng tiền</td>
                            <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>" . number_format($total_price, 0, ',', '.') . " VND</td>
                        </tr>
                        <tr>
                            <td style='padding: 12px; font-weight: 600; border-bottom: 1px solid #e5e7eb;'>Trạng thái</td>
                            <td style='padding: 12px; border-bottom: 1px solid #e5e7eb;'>Đang xử lý</td>
                        </tr>
                    </table>

                    <!-- Call to Action -->
                    <p style='color: #4b5563; font-size: 15px; line-height: 1.5; margin: 20px 0;'>Bạn có thể theo dõi trạng thái đơn hàng trong tài khoản cá nhân của mình.</p>
                    <div style='text-align: center; margin: 24px 0;'>
                        <a href='http://localhost:3000/orders' style='display: inline-block; background-color: #2a9d8f; color: #ffffff; font-size: 15px; font-weight: 500; padding: 12px 24px; text-decoration: none; border-radius: 8px; transition: background-color 0.2s;'>Xem đơn hàng</a>
                    </div>
                </div>

                <!-- Footer -->
                <div style='background-color: #f8fafc; padding: 16px; text-align: center; border-top: 1px solid #e5e7eb;'>
                    <p style='color: #6b7280; font-size: 13px; margin: 0;'>Cần hỗ trợ? <a href='mailto:support@shopname.com' style='color: #2a9d8f; text-decoration: none;'>Liên hệ chúng tôi</a></p>
                    <p style='color: #6b7280; font-size: 13px; margin: 8px 0 0;'>© 2025 Shop Name. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";

            // Plain text alternative
            $mail->AltBody = "Cảm ơn bạn đã mua hàng!\n"
                . "Đơn hàng của bạn đã được ghi nhận:\n"
                . "Mã đơn hàng: #$order_id\n"
                . $product_list_text
                . "Tổng tiền: " . number_format($total_price, 0, ',', '.') . " VND\n"
                . "Trạng thái: Đang xử lý\n"
                . "Vui lòng kiểm tra đơn hàng trong tài khoản của bạn.";

            $mail->send();
            $_SESSION['success'] = "Email xác nhận đơn hàng đã được gửi!";
        } catch (Exception $e) {
            error_log("Failed to send order email: {$mail->ErrorInfo}");
            $_SESSION['error'] = "Không thể gửi email xác nhận: " . $mail->ErrorInfo;
        }
    }
    public function buy()
    {
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

        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add or update product in cart
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'img' => $product['img']
            ];
        }

        $_SESSION['success'] = "Sản phẩm đã được thêm vào giỏ hàng!";
        header("Location: ?controller=product&action=detail&id=$product_id");
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
    public function checkout()
    {
        // Kiểm tra giỏ hàng có tồn tại và không rỗng
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Giỏ hàng trống.";
            header("Location: ?controller=order&action=viewCart");
            exit;
        }

        // Kiểm tra xem có sản phẩm nào được chọn hay không
        if (!isset($_POST['selected_products']) || empty($_POST['selected_products'])) {
            $_SESSION['error'] = "Vui lòng chọn ít nhất một sản phẩm để thanh toán.";
            header("Location: ?controller=order&action=viewCart");
            exit;
        }

        // Fetch user details
        $user = $this->user->getById($_SESSION['user_id']);
        if (!$user) {
            $_SESSION['error'] = "Không thể lấy thông tin người dùng.";
            header("Location: ?controller=order&action=viewCart");
            exit;
        }

        $name = $user['name'] ?? '';
        $address = $user['address'] ?? '';
        $phone = $user['phone'] ?? '';
        $email = $user['email'] ?? '';

        // Lọc giỏ hàng dựa trên các sản phẩm được chọn
        $selected_products = $_POST['selected_products']; // Mảng chứa product_id được chọn
        $products = [];
        $total_price = 0;

        // Validate products and stock
        foreach ($selected_products as $product_id) {
            if (!isset($_SESSION['cart'][$product_id])) {
                continue; // Bỏ qua nếu product_id không có trong giỏ hàng
            }

            $item = $_SESSION['cart'][$product_id];
            $product = $this->product->getById($product_id);
            if (!$product) {
                unset($_SESSION['cart'][$product_id]);
                continue;
            }

            if ($item['quantity'] > $product['quantity']) {
                $_SESSION['error'] = "Số lượng {$product['name']} vượt quá tồn kho.";
                header("Location: ?controller=order&action=viewCart");
                exit;
            }

            // Add product to the order
            $subtotal = $product['price'] * $item['quantity'];
            $products[] = [
                'product_id' => $product_id,
                'name' => $product['name'],
                'quantity' => $item['quantity'],
                'price' => $product['price'],
                'subtotal' => $subtotal
            ];
            $total_price += $subtotal;
        }

        if (empty($products)) {
            $_SESSION['error'] = "Không có sản phẩm hợp lệ được chọn.";
            header("Location: ?controller=order&action=viewCart");
            exit;
        }

        // Create a single order for all selected products
        $order_id = false;
        foreach ($products as $product) {
            $order_id = $this->order->create(
                $_SESSION['user_id'],
                $product['product_id'],
                $product['quantity'],
                $product['subtotal'],
                $name,
                $address,
                $phone
            );

            if ($order_id === false) {
                $_SESSION['error'] = "Không thể tạo đơn hàng cho {$product['name']}.";
                header("Location: ?controller=order&action=viewCart");
                exit;
            }

            // Update product quantity
            $current_product = $this->product->getById($product['product_id']);
            $new_quantity = $current_product['quantity'] - $product['quantity'];
            $this->product->update(
                $product['product_id'],
                $current_product['name'],
                $current_product['img'],
                $current_product['price'],
                $new_quantity,
                $current_product['description']
            );
        }

        // Prepare products for email
        $email_products = array_map(function ($product) {
            return [
                'name' => $product['name'],
                'quantity' => $product['quantity'],
                'price' => $product['price']
            ];
        }, $products);

        // Send order confirmation email
        if (!empty($email)) {
            $this->sendOrderEmail($email, $email_products, $total_price, $order_id);
        }

        // Xóa các sản phẩm đã thanh toán khỏi giỏ hàng
        foreach ($selected_products as $product_id) {
            unset($_SESSION['cart'][$product_id]);
        }

        // Nếu giỏ hàng rỗng sau khi xóa, xóa luôn session cart
        if (empty($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        $_SESSION['success'] = "Đơn hàng đã được tạo thành công!";
        header("Location: ?controller=product&action=index");
        exit;
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
}
