<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Halwaaz | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

       body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .login-container {
            background: white;
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-header p {
            margin: 8px 0 0;
            font-size: 14px;
            color: #666;
            font-weight: 300;
        }

        .alert-error {
            background: #ffe5e5;
            border: 1px solid #ff6b6b;
            color: #d63031;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error::before {
            content: "\e90d";
            font-family: "bootstrap-icons";
            font-weight: 700;
        }

        .alert-success {
            background: #e8f5e9;
            border: 1px solid #34d399;
            color: #10b981;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success::before {
            content: "\f26e";
            font-family: "bootstrap-icons";
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #999;
            font-size: 18px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 12px 12px 42px;
            border-radius: 10px;
            border: 2px solid #eee;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            border-color: #ff8c42;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.1);
        }

        .form-group input::placeholder {
            color: #bbb;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff6b6b, #ff8c42);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(255, 107, 107, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .signup-link {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .signup-link a {
            color: #ff8c42;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #ff6b6b;
            text-decoration: underline;
        }

        .footer-text {
            margin-top: 24px;
            font-size: 12px;
            color: #999;
            font-weight: 300;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #ccc;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #ddd;
        }

        .divider span {
            padding: 0 12px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-header">
                <h1>Halwaaz</h1>
                <p>Sweet & Delicious Halwa World</p>
            </div>

<?php if (!empty($_SESSION['error_login'])):?>
    <div class="alert-error"><?=$_SESSION['error_login'];?></div>
<?php endif; ?>

<?php if (!empty($_SESSION['login_success'])):?>
    <div class="alert-success"><?=$_SESSION['login_success'];?></div>
<?php endif; ?>

<?php if (!empty($_SESSION['error_password'])):?>
    <div class="alert-error"><?=$_SESSION['error_password'];?></div>
<?php endif; ?>

            <form action="<?=base_url('save_login')?>" method="post">
                <div class="form-group">
                    <label><i class="bi bi-person"></i> Username</label>
                    <div class="input-wrapper">
                        <i class="bi bi-person-circle input-icon"></i>
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="bi bi-lock"></i> Password</label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>

                <button type="submit" class="login-btn"><i class="bi bi-box-arrow-in-right"></i> Login</button>

            </form>

            <div class="signup-link">
                Don't have an account? <a href="<?= base_url('signup') ?>">Sign up here</a>
            </div>

            <div class="footer-text">🍯 Welcome to Halwaaz</div>
        </div>
    </div>

</body>
</html>