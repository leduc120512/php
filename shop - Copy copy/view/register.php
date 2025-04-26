<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-title {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-outline {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 25px;
            padding: 20px;
            font-size: 16px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            outline: none;
        }

        .form-label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 14px;
            color: #555;
            background-color: #fff;
            padding: 0 5px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: 0;
            font-size: 12px;
            color: #667eea;
            transform: translateY(-100%);
        }

        .btn-primary {
            background: #667eea;
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: 500;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }

        .alert-danger {
            font-size: 14px;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .text-center {
            font-size: 14px;
            color: #555;
        }

        .text-center a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .text-center a:hover {
            color: #764ba2;
            text-decoration: underline;
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