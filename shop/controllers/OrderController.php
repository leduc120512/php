<?php
require_once '../config/database.php';
require_once '../models/Order.php';
require_once '../models/Product.php';
require_once '../models/User.php';

class OrderController
{
    private $order;
    private $product;
    private $user;

    public function __construct()
    {
        $db = new Database();
        $this->order = new Order($db->getConnection());
        $this->product = new Product($db->getConnection());
        $this->user = new User($db->getConnection());
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
        if (isset($_POST['buy'])) {
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

            $total_price = $product['price'] * $quantity;
            $order_id = $this->order->create($_SESSION['user_id'], $product_id, $quantity, $total_price);

            if ($order_id === false) {
                $_SESSION['error'] = "Không thể tạo đơn hàng. Vui lòng thử lại.";
                header("Location: ?controller=product&action=detail&id=$product_id");
                exit;
            }

            $new_quantity = $product['quantity'] - $quantity;
            $this->product->update($product_id, $product['name'], $product['img'], $product['price'], $new_quantity, $product['description']);

            $user = $this->user->getById($_SESSION['user_id']);
            if ($user && isset($user['email'])) {
                $this->sendOrderEmail($user['email'], $product['name'], $quantity, $total_price, $order_id);
            } else {
                error_log("Không tìm thấy email của người dùng ID: " . $_SESSION['user_id']);
            }

            $_SESSION['success'] = "Đơn hàng đã được tạo thành công!";
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

        $orders = $this->order->getAll();
        require_once '../PHPExcel/Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();

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

    public function updateStatus($order_id)
    {
        if ($_SESSION['role'] === 'admin' && isset($_POST['status'])) {
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $this->order->updateStatus($order_id, $status);
        }
        header("Location: ?controller=order&action=admin");
    }
}
