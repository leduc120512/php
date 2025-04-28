<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        /* Đặt background cho toàn trang */
        /* Container đăng ký */
        .register-container {
            background-color: #fff;
            max-width: 420px;
            margin: 80px auto;
            padding: 40px 45px;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
            border: 2px solid #e0f7e9;
            text-align: center;
        }

        /* Tiêu đề đăng ký */
        .register-title {
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

        /* Khi focus hoặc có nội dung thì label nhỏ lại */
        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            background: #fff;
            padding: 0 4px;
            color: #43a047;
        }

        /* Nút đăng ký */
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

        /* Link đăng nhập */
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
    <div class="register-container">
        <p class="register-title">Đăng ký</p>
        <form method="POST">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-outline">
                <input type="text" id="form2Example1" class="form-control" name="username" placeholder=" " required />
                <label class="form-label" for="form2Example1">Username</label>
            </div>

            <div class="form-outline">
                <input type="email" id="form2Example3" class="form-control" name="email" placeholder=" " required />
                <label class="form-label" for="form2Example3">Email</label>
            </div>

            <div class="form-outline">
                <input type="password" id="form2Example2" class="form-control" name="password" placeholder=" " required />
                <label class="form-label" for="form2Example2">Password</label>
            </div>

            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>

            <div class="text-center">
                <p>Already a member? <a href="?controller=auth&action=login">Login</a></p>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</body>

</html>