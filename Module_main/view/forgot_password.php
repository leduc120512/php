<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        /* Container quên mật khẩu */
        .forgot-container {
            background-color: #fff;
            max-width: 420px;
            margin: 80px auto;
            padding: 40px 45px;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
            border: 2px solid #e0f7e9;
            text-align: center;
        }

        /* Tiêu đề quên mật khẩu */
        .forgot-title {
            font-size: 30px;
            color: #4caf50;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /* Form input */
        .form-outline {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #c8e6c9;
            border-radius: 12px;
            background-color: #f9fff9;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #66bb6a;
            outline: none;
            background-color: #ffffff;
        }

        /* Label */
        .form-label {
            position: absolute;
            top: 12px;
            left: 16px;
            color: #757575;
            font-size: 14px;
            pointer-events: none;
            transition: all 0.2s ease-out;
        }

        /* Khi focus hoặc có nội dung thì label nổi lên */
        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            background: #fff;
            padding: 0 4px;
            color: #43a047;
        }

        /* Nút gửi mật khẩu */
        .btn-primary {
            background-color: #66bb6a;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #43a047;
        }

        /* Link quay lại đăng nhập */
        .text-center {
            margin-top: 20px;
        }

        .text-center p {
            font-size: 14px;
        }

        .text-center a {
            color: #4caf50;
            text-decoration: none;
            font-weight: 500;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        /* Alert thông báo thành công */
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Alert lỗi */
        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="forgot-container">
        <h3 class="forgot-title">Quên mật khẩu</h3>
        <form method="POST">
            <?php if (isset($message)): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-outline mb-4">
                <input type="email" id="formEmail" class="form-control" name="email" required />
                <label class="form-label" for="formEmail">Email</label>
            </div>

            <button type="submit" name="forgot_password" class="btn btn-primary btn-block mb-4">Gửi mật khẩu mới</button>

            <div class="text-center">
                <p>Quay lại <a href="?controller=auth&action=login">Đăng nhập</a></p>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script><!-- Thêm CDN của SweetAlert2 -->
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</body>

</html>