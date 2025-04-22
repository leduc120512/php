<?php
require_once '../config/database.php';
require_once '../models/User.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $db = new Database();
        $this->user = new User($db->getConnection());
    }

    

    public function register()
    {
        if (isset($_POST['register'])) {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            // In ra các input để kiểm tra (có thể bỏ sau khi debug xong)
            echo "Username: " . htmlspecialchars($username) . "<br>";
            echo "Email: " . htmlspecialchars($email) . "<br>";
            echo "Password: " . htmlspecialchars($password) . "<br>";

            // Kiểm tra email hợp lệ
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ!";
                echo $error . "<br>";
            } elseif ($this->user->register($username, $email, $password)) { // Giả sử model User có tham số email
                header("Location: ?controller=auth&action=login");
                exit;
            } else {
                $error = "Đăng ký thất bại!";
                echo $error . "<br>";
            }
        }
        require '../view/register.php';
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?controller=auth&action=login");
        exit;
    }

    public function forgotPassword()
    {
        if (isset($_POST['forgot_password'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            // In ra input


            // Kiểm tra email có tồn tại không
            $user = $this->user->findByEmail($email);

            if ($user) {
                // Tạo mật khẩu mới
                $newPassword = $this->generateRandomPassword();

                // In ra mật khẩu mới


                if ($this->user->updatePassword($email, $newPassword)) {
                    // Gửi email chứa mật khẩu mới
                    $this->sendPasswordEmail($email, $newPassword);
                } else {
                }
            } else {
                $error = "Email không tồn tại trong hệ thống!";
                echo $error . "<br>";
            }
        }
        require dirname(__DIR__) . '/view/forgot_password.php';
    }

    // Tạo mật khẩu ngẫu nhiên
    private function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    // Gửi email chứa mật khẩu mới
    private function sendPasswordEmail($email, $newPassword)
    {
        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            // Cấu hình server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mailleduc05122004@gmail.com';
            $mail->Password = 'guezbvjtsdwubjlt';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Người gửi và người nhận
            $mail->setFrom('mailleduc05122004@gmail.com', 'Shop Admin');
            $mail->addAddress($email);

            // Nội dung emailre
            $mail->isHTML(true);
            $mail->Subject = 'Mật khẩu mới của bạn';
            $mail->Body = "Mật khẩu mới của bạn là: <b>$newPassword</b><br>Vui lòng đăng nhập và đổi mật khẩu ngay sau khi nhận được email này.";
            $mail->AltBody = "Mật khẩu mới của bạn là: $newPassword\nVui lòng đăng nhập và đổi mật khẩu ngay sau khi nhận được email này.";

            $mail->send();
            // Thay echo thông báo thường bằng SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Email đã được gửi thành công!',
                    showConfirmButton: false,
                    timer: 2000
                });
              </script>";
        } catch (Exception $e) {
            error_log("Failed to send password email: {$mail->ErrorInfo}");
            // Thông báo lỗi cũng dùng SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Không thể gửi email: " . $mail->ErrorInfo . "',
                    confirmButtonText: 'OK'
                });
              </script>";
        }
    }
}
