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
        $db = new Database();
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
                return '<div style="color: red; text-align: center;">Thất bại: Không có đơn hàng nào để xuất.</div>';
            }

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Tiêu đề chính
            $sheet->mergeCells('A1:F1');
            $sheet->setCellValue('A1', 'Shop bán hoa');
            $sheet->getStyle('A1')->applyFromArray([
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);

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
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCCE5FF']
                ]
            ]);

            // Dữ liệu
            $row = 3;
            foreach ($orders as $order) {
                $sheet->setCellValue("A$row", $order['username']);
                $sheet->setCellValue("B$row", $order['product_name']);
                $sheet->setCellValue("C$row", $order['quantity']);
                $sheet->setCellValue("D$row", $order['total_price']);
                $sheet->setCellValue("E$row", $order['status']);

                // Format thời gian tạo
                $createdAtFormatted = date('H:i d/m/Y', strtotime($order['created_at']));
                $sheet->setCellValue("F$row", $createdAtFormatted);

                $sheet->getStyle("A$row:F$row")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
                    'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
                ]);
                $row++;
            }

            // Format tiền
            $sheet->getStyle("D3:D$row")->getNumberFormat()->setFormatCode('#,##0 \₫');

            // Set chiều rộng
            $sheet->getColumnDimension('A')->setWidth(25); // Tên người dùng
            $sheet->getColumnDimension('B')->setWidth(30); // Tên sản phẩm
            $sheet->getColumnDimension('C')->setWidth(15); // Số lượng
            $sheet->getColumnDimension('D')->setWidth(20); // Tổng tiền
            $sheet->getColumnDimension('E')->setWidth(20); // Trạng thái
            $sheet->getColumnDimension('F')->setWidth(25); // Thời gian tạo

            // Xuất file
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="don_hang_shop_hoa.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit;
        } catch (Exception $e) {
            return '<div style="color: red; text-align: center;">Thất bại: Lỗi khi xuất đơn hàng - ' . $e->getMessage() . '</div>';
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

    private function sendOrderEmail($email, $product_name, $quantity, $total_price, $order_id)
    {
        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mailleduc05122004@gmail.com';
            $mail->Password = 'guezbvjtsdwubjlt'; // 👉 Gợi ý: nên dùng biến môi trường để bảo mật hơn
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('mailleduc05122004@gmail.com', 'Shop Admin');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đơn hàng #' . $order_id;

            // Nội dung email đẹp hơn với CSS inline
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;'>
                <div style='max-width: 600px; margin: auto; background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);'>
                    <h2 style='color: #2a9d8f; text-align: center;'>🎉 Cảm ơn bạn đã mua hàng!</h2>
                    <p style='font-size: 16px; color: #333;'>Đơn hàng của bạn đã được ghi nhận với các thông tin sau:</p>
                    <table style='width: 100%; border-collapse: collapse; font-size: 15px; margin-top: 15px;'>
                        <tr>
                            <td style='padding: 8px; font-weight: bold;'>Mã đơn hàng:</td>
                            <td style='padding: 8px;'>#$order_id</td>
                        </tr>
                        <tr style='background-color: #f9f9f9;'>
                            <td style='padding: 8px; font-weight: bold;'>Sản phẩm:</td>
                            <td style='padding: 8px;'>$product_name</td>
                        </tr>
                        <tr>
                            <td style='padding: 8px; font-weight: bold;'>Số lượng:</td>
                            <td style='padding: 8px;'>$quantity</td>
                        </tr>
                        <tr style='background-color: #f9f9f9;'>
                            <td style='padding: 8px; font-weight: bold;'>Tổng tiền:</td>
                            <td style='padding: 8px;'>" . number_format($total_price, 0, ',', '.') . " VND</td>
                        </tr>
                        <tr>
                            <td style='padding: 8px; font-weight: bold;'>Trạng thái:</td>
                            <td style='padding: 8px;'>Đang xử lý</td>
                        </tr>
                    </table>
                    <p style='margin-top: 20px; font-size: 15px; color: #555;'>Bạn có thể kiểm tra đơn hàng của mình trong tài khoản cá nhân.</p>
                    <div style='text-align: center; margin-top: 30px;'>
                        <a href='http://localhost:3000/orders' style='display: inline-block; background-color: #2a9d8f; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 6px;'>Xem đơn hàng</a>
                    </div>
                    <p style='margin-top: 30px; font-size: 13px; color: #999; text-align: center;'>Liên hệ với chúng tôi nếu bạn cần hỗ trợ thêm.</p>
                </div>
            </div>
        ";

            // Nội dung văn bản thuần (AltBody) nếu không hiển thị được HTML
            $mail->AltBody = "Cảm ơn bạn đã mua hàng!\n"
                . "Đơn hàng của bạn đã được ghi nhận:\n"
                . "Mã đơn hàng: #$order_id\n"
                . "Sản phẩm: $product_name\n"
                . "Số lượng: $quantity\n"
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

        $orders = $this->order->getAll();
        require '../view/admin.php';
        require '../view/admin_order.php';
    }

    public function viewOrders()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: ?controller=product&action=index");
            exit;
        }
        $orders = $this->order->getAll();
        require '../view/admin_manager.php';
        require '../view/admin.php';
    }
    public function checkout()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Giỏ hàng trống.";
            header("Location: ?controller=order&action=viewCart");
            exit;
        }

        foreach ($_SESSION['cart'] as $product_id => $item) {
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

            $total_price = $product['price'] * $item['quantity'];
            $order_id = $this->order->create(
                $_SESSION['user_id'],
                $product_id,
                $item['quantity'],
                $total_price
            );

            if ($order_id === false) {
                $_SESSION['error'] = "Không thể tạo đơn hàng cho {$product['name']}.";
                header("Location: ?controller=order&action=viewCart");
                exit;
            }

            $new_quantity = $product['quantity'] - $item['quantity'];
            $this->product->update(
                $product_id,
                $product['name'],
                $product['img'],
                $product['price'],
                $new_quantity,
                $product['description']
            );

            $user = $this->user->getById($_SESSION['user_id']);
            if ($user && isset($user['email'])) {
                $this->sendOrderEmail(
                    $user['email'],
                    $product['name'],
                    $item['quantity'],
                    $total_price,
                    $order_id
                );
            }
        }

        unset($_SESSION['cart']);
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
