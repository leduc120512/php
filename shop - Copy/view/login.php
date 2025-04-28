<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Cửa hàng hoa quả</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1509266272358-7701da638078?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Playfair Display', serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.8s ease-in-out;
            border: 1px solid #f7d7e6;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            color: #d14781;
            text-transform: uppercase;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #f7d7e6;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-control:focus {
            border-color: #d14781;
            box-shadow: 0 0 10px rgba(209, 71, 129, 0.2);
        }

        .form-label {
            font-size: 14px;
            color: #555;
            font-weight: 500;
        }

        .btn-primary {
            background: #d14781;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #b03566;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(209, 71, 129, 0.4);
        }

        .social-buttons .btn {
            color: #d14781;
            transition: all 0.3s ease;
        }

        .social-buttons .btn:hover {
            color: #b03566;
            transform: scale(1.15);
        }

        .text-center a {
            color: #d14781;
            text-decoration: none;
            font-weight: 600;
        }

        .text-center a:hover {
            text-decoration: underline;
            color: #b03566;
        }

        .forgot-password {
            font-size: 13px;
            color: #777;
        }

        .floral-icon {
            display: block;
            margin: 0 auto 20px;
            width: 60px;
            height: 60px;
            background: url('https://img.icons8.com/color/48/000000/flower.png') no-repeat center;
            background-size: contain;
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