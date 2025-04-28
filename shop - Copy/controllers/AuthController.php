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

    // public function login()
    // {
    //     if (isset($_POST['login'])) {
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];

    //         // In ra các input
    //         echo "Username: " . htmlspecialchars($username) . "<br>";
    //         echo "Password: " . htmlspecialchars($password) . "<br>";

    //         $user = $this->user->login($username, $password);

    //         if ($user) {
    //             $_SESSION['user_id'] = $user['ID'];
    //             $_SESSION['role'] = $user['role'];

    //             if ($user['role'] === 'admin') {
    //                 header("Location: http://localhost:3000/bs-advance-admin/advance-admin/index.php");
    //             } else {
    //                 header("Location: ?controller=product&action=index");
    //             }
    //             exit;
    //         } else {
    //             $error = "Sai thông tin đăng nhập!";
    //             echo $error . "<br>";
    //         }
    //     }
    //     require dirname(__DIR__) . '/view/login.php';
    // }

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
    // public function updateUser()
    // {
    //     // Check if user is logged in
    //     if (!isset($_SESSION['user_id'])) {
    //         header("Location: ?controller=auth&action=login");
    //         exit;
    //     }

    //     if (isset($_POST['update'])) {
    //         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    //         $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
    //         $password = $_POST['password'] ?? '';

    //         if (!$email || !$name || !$address || !$phone) {
    //             echo "Vui lòng điền đầy đủ thông tin!";
    //             require '../view/update_user.php';
    //             return;
    //         }

    //         // Check if email exists in the database
    //         if (!$this->user->userExists($email)) {
    //             echo "Email không tồn tại trong hệ thống!";
    //             require '../view/update_user.php';
    //             return;
    //         }

    //         // Update user with or without password
    //         if ($password) {
    //             $result = $this->user->updateUser($email, $name, $address, password_hash($password, PASSWORD_DEFAULT), $phone);
    //         } else {
    //             $result = $this->user->updateUserWithoutPassword($email, $name, $address, $phone);
    //         }

    //         if ($result) {
    //             $_SESSION['user']['email'] = $email;
    //             $_SESSION['user']['name'] = $name;
    //             $_SESSION['user']['address'] = $address;
    //             $_SESSION['user']['phone'] = $phone;
    //             header("Location: ?controller=auth&action=profile&success=1");
    //             exit;
    //         } else {
    //             echo "Cập nhật thất bại!";
    //             require '../view/update_user.php';
    //         }
    //     } else {
    //         require '../view/update_user.php';
    //     }
    // }
    public function login()
    {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // In ra các input
            echo "Username: " . htmlspecialchars($username) . "<br>";
            echo "Password: " . htmlspecialchars($password) . "<br>";

            $user = $this->user->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['role'] = $user['role'];
                // Initialize $_SESSION['user'] with user data
                $_SESSION['user'] = [
                    'email' => $user['email'] ?? '',
                    'name' => $user['name'] ?? '',
                    'address' => $user['address'] ?? '',
                    'phone' => $user['phone'] ?? ''
                ];

                if ($user['role'] === 'admin') {
                    header("Location: http://localhost:3000/plain-free-bootstrap-admin-template\index.php");
                } else {
                    header("Location: ?controller=product&action=index");
                }
                exit;
            } else {
                $error = "Sai thông tin đăng nhập!";
                echo $error . "<br>";
            }
        }
        require dirname(__DIR__) . '/view/login.php';
    }

    public function updateUser()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        if (isset($_POST['update'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = $_POST['password'] ?? '';

            if (!$email || !$name || !$address || !$phone) {
                echo "Vui lòng điền đầy đủ thông tin!";
                require '../view/update_user.php';
                return;
            }

            // Optional: Check if email changed and is taken
            if ($email !== $_SESSION['user']['email'] && $this->user->userExists($email)) {
                echo "Email đã được sử dụng bởi người dùng khác!";
                require '../view/update_user.php';
                return;
            }

            // Update user with or without password
            if ($password) {
                $result = $this->user->updateUserById($_SESSION['user_id'], $email, $name, $address, $password, $phone);
            } else {
                $result = $this->user->updateUserByIdWithoutPassword($_SESSION['user_id'], $email, $name, $address, $phone);
            }

            if ($result) {
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['address'] = $address;
                $_SESSION['user']['phone'] = $phone;
                header("Location: ?controller=product&action=index");
                exit;
            } else {
                echo "Cập nhật thất bại!";
                require '../view/update_user.php';
            }
        } else {
            require '../view/update_user.php';
        }
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
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Người gửi và người nhận
            $mail->setFrom('', 'Shop Admin');
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
