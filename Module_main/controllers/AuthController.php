<?php
require_once '../config/database.php';
require_once '../models/User.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $db = Database::getInstance();
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
    public function login()
    {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

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

                // Add the new session variable when role is 'create'
                if (!empty($user['role']) && $user['role'] === 'create') {
                    $_SESSION['can_create_accounts'] = true;
                }

                if (!empty($user['role']) && $user['role'] === 'admin') {
                    header("Location: http://localhost:3000/AdminLTE-master/index.php");
                } else if ($user['role'] === 'customer') {
                    header("Location: ?controller=product&action=index");
                } else {
                    header("Location: ?controller=auth&action=list_accounts");
                }
                exit;
            } else {
                $error = "Sai thông tin đăng nhập!";
                echo $error . "<br>";
            }
        }
        require dirname(__DIR__) . '../view/login.php';
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
    //             // Initialize $_SESSION['user'] with user data
    //             $_SESSION['user'] = [
    //                 'email' => $user['email'] ?? '',
    //                 'name' => $user['name'] ?? '',
    //                 'address' => $user['address'] ?? '',
    //                 'phone' => $user['phone'] ?? ''
    //             ];

    //             if ($user['role'] === 'admin') {
    //                 header("Location: http://localhost:3000/adminkit/static/index.php");
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
    public function list_accounts()
    {
        // Check if user is logged in and has admin permissions
        if (
            !isset($_SESSION['user_id']) ||
            ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'create' && !isset($_SESSION['can_create_accounts']))
        ) {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        // Get all user accounts
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Get accounts based on search term
        $accounts = $this->user->searchAccounts($search);

        // Load the view
        require dirname(__DIR__) . '../view/list_accounts.php';
    }
    public function edit_account()
    {
        // Check if user is logged in and has required permissions
        if (
            !isset($_SESSION['user_id']) ||
            ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'create' && !isset($_SESSION['can_create_accounts']))
        ) {
            header("Location: ?controller=auth&action=login");
            exit;
        }

        $error = '';
        $success = '';
        $user = null;

        // Get user ID from URL
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header("Location: ?controller=auth&action=list_accounts");
            exit;
        }

        // Get user data for editing
        $user = $this->user->getUserById($id);

        if (!$user) {
            header("Location: ?controller=auth&action=list_accounts");
            exit;
        }

        // Handle form submission
        if (isset($_POST['update_account'])) {
            $username = htmlspecialchars(trim($_POST['username']));
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $role = htmlspecialchars(trim($_POST['role']));
            $name = htmlspecialchars(trim($_POST['name']));
            $address = htmlspecialchars(trim($_POST['address']));
            $phone = htmlspecialchars(trim($_POST['phone']));


            // Check if password should be updated
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            // Validate inputs
            if (empty($username) || empty($email) || empty($role)) {
                $error = "Vui lòng điền đầy đủ thông tin cần thiết!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ!";
            } else {
                // Attempt to update the account
                if ($this->user->updateAccount($id, $username, $email, $password, $role, $name, $address, $phone)) {
                    $success = "Cập nhật tài khoản thành công!";
                    // Refresh user data
                    $user = $this->user->getUserById($id);
                } else {
                    $error = "Cập nhật tài khoản thất bại! Tên đăng nhập hoặc email có thể đã tồn tại.";
                }
            }
        }

        // Load the view
        require dirname(__DIR__) . '../view/edit_account.php';
    }
    
    public function delete_account()
    {
        // Check if user is logged in and has admin permissions


        // Get user ID from URL
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header("Location: ?controller=auth&action=list_accounts");
            exit;
        }

        // Prevent deleting your own account
        if ($id == $_SESSION['user_id']) {
            $_SESSION['delete_error'] = "Không thể xóa tài khoản của chính bạn!";
            header("Location: ?controller=auth&action=list_accounts");
            exit;
        }

        // Delete the account
        if ($this->user->deleteAccount($id)) {
            $_SESSION['delete_success'] = "Xóa tài khoản thành công!";
        } else {
            $_SESSION['delete_error'] = "Xóa tài khoản thất bại!";
        }

        header("Location: ?controller=auth&action=list_accounts");
        exit;
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

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Mật khẩu mới của bạn';

            // Template HTML
            $htmlContent = '
        <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mật khẩu mới của bạn</title>
            <style>
                /* Reset styles cho email */
                body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
                table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
                img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
                body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; font-family: \'Roboto\', \'Arial\', sans-serif; }

                /* Font Google */
                @import url(\'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap\');

                /* Container chính */
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                }

                /* Header */
                .header {
                    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                    padding: 40px 20px;
                    text-align: center;
                    color: #ffffff;
                }
                .header h1 {
                    margin: 0;
                    font-size: 28px;
                    font-weight: 700;
                    letter-spacing: 0.5px;
                }

                /* Content */
                .content {
                    padding: 40px 30px;
                    text-align: center;
                    color: #2d3748;
                }
                .content p {
                    font-size: 16px;
                    line-height: 1.8;
                    margin: 0 0 20px;
                    color: #4a5568;
                }
                .password-box {
                    background-color: #f7fafc;
                    border: 2px dashed #e2e8f0;
                    border-radius: 8px;
                    padding: 20px;
                    margin: 25px 0;
                    font-size: 20px;
                    font-weight: 700;
                    color: #2575fc;
                    letter-spacing: 1px;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
                }
                .cta-button {
                    display: inline-block;
                    padding: 14px 30px;
                    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                    color: #ffffff !important;
                    text-decoration: none;
                    border-radius: 50px;
                    font-size: 16px;
                    font-weight: 700;
                    margin: 20px 0;
                    transition: transform 0.2s ease, box-shadow 0.2s ease;
                }
                .cta-button:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                }

                /* Footer */
                .footer {
                    background-color: #edf2f7;
                    padding: 25px;
                    text-align: center;
                    font-size: 14px;
                    color: #718096;
                }
                .footer a {
                    color: #2575fc;
                    text-decoration: none;
                    font-weight: 700;
                }
                .footer a:hover {
                    text-decoration: underline;
                }

                /* Responsive */
                @media only screen and (max-width: 600px) {
                    .container {
                        width: 100% !important;
                        margin: 0 !important;
                        border-radius: 0;
                    }
                    .header {
                        padding: 30px 15px;
                    }
                    .header h1 {
                        font-size: 22px;
                    }
                    .content {
                        padding: 30px 20px;
                    }
                    .content p {
                        font-size: 14px;
                    }
                    .password-box {
                        font-size: 18px;
                        padding: 15px;
                    }
                    .cta-button {
                        font-size: 14px;
                        padding: 12px 25px;
                    }
                    .footer {
                        font-size: 12px;
                        padding: 20px;
                    }
                }
            </style>
        </head>
        <body style="background-color: #edf2f7; margin: 0; padding: 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #edf2f7; padding: 20px 0;">
                <tr>
                    <td align="center">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="container">
                            <!-- Header -->
                            <tr>
                                <td class="header">
                                    <h1>Mật Khẩu Mới Của Bạn</h1>
                                </td>
                            </tr>
                            <!-- Content -->
                            <tr>
                                <td class="content">
                                    <p>Xin chào,</p>
                                    <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Dưới đây là mật khẩu mới của bạn:</p>
                                    <div class="password-box">' . htmlspecialchars($newPassword) . '</div>
                                    <p>Vui lòng đăng nhập bằng mật khẩu này và đổi ngay để đảm bảo an toàn cho tài khoản của bạn.</p>
                                    <a href="https://yourwebsite.com/login" class="cta-button">Đăng Nhập Ngay</a>
                                </td>
                            </tr>
                            <!-- Footer -->
                            <tr>
                                <td class="footer">
                                    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng liên hệ tại <a href="mailto:support@shopadmin.com">qquynhanh176@gmail.com</a>.</p>
                                    <p>© 2025 Shop Hoa quả. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';

            // Gán nội dung HTML vào email
            $mail->Body = $htmlContent;
            $mail->AltBody = "Mật khẩu mới của bạn là: $newPassword\nVui lòng đăng nhập tại https://yourwebsite.com/login và đổi mật khẩu ngay.";

            $mail->send();
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
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Không thể gửi email: " . addslashes($mail->ErrorInfo) . "',
                confirmButtonText: 'OK'
            });
        </script>";
        }
    }
}
