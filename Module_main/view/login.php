<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Cửa hàng hoa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        /* Đặt background cho toàn trang */
        body {
            background: linear-gradient(to bottom, #f5ffe0, #ffffff);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container đăng nhập */
        .login-container {
            background-color: #fff;
            max-width: 400px;
            margin: 80px auto;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
            border: 2px solid #e0f7e9;
        }

        /* Icon hoa quả phía trên */
        .floral-icon {
            width: 80px;
            height: 80px;
            background-image: url('https://cdn-icons-png.flaticon.com/512/135/135620.png');
            /* icon trái cây */
            background-size: cover;
            background-position: center;
            margin: 0 auto 20px auto;
        }

        /* Tiêu đề */
        .login-title {
            font-size: 28px;
            color: #4caf50;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Form input */
        .form-outline {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #c8e6c9;
            border-radius: 10px;
            background-color: #f9fff9;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #66bb6a;
            outline: none;
            background-color: #ffffff;
        }

        /* Label */
        .form-label {
            display: block;
            text-align: left;
            margin-top: 8px;
            font-size: 14px;
            color: #757575;
        }

        /* Link quên mật khẩu */
        .forgot-password {
            font-size: 14px;
            color: #66bb6a;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        /* Nút đăng nhập */
        .btn-primary {
            background-color: #66bb6a;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #43a047;
        }

        /* Đăng ký và social */
        .text-center p {
            font-size: 14px;
            margin-top: 20px;
        }

        .text-center a {
            color: #4caf50;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        /* Social buttons */
        .social-buttons {
            margin-top: 15px;
        }

        .social-buttons .btn-link {
            color: #66bb6a;
            font-size: 20px;
        }

        .social-buttons .btn-link:hover {
            color: #43a047;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="floral-icon"></div>
        <p class="login-title">Đăng nhập</p>
        <form method="POST">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-outline mb-4">
                <input type="text" id="form2Example1" class="form-control" name="username" required />
                <label class="form-label" for="form2Example1">Tên đăng nhập</label>
            </div>

            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control" name="password" required />
                <label class="form-label" for="form2Example2">Mật khẩu</label>
            </div>

            <div class="row mb-4">
                <div class="col text-right">
                    <a href="?controller=auth&action=forgotPassword" class="forgot-password">Quên mật khẩu?</a>
                </div>
            </div>

            <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Đăng nhập</button>

            <div class="text-center">
                <p>Chưa có tài khoản? <a href="?controller=auth&action=register">Đăng ký ngay</a></p>
                <div class="social-buttons">
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-instagram"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>