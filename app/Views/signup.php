<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Sign Up</title>
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
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-wrapper {
            width: 100%;
            max-width: 520px;
        }

        .signup-container {
            background: white;
            padding: 45px 40px;
            border-radius: 20px;
            box-shadow: 0 25px 65px rgba(0,0,0,0.3);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .signup-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .signup-header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .signup-header p {
            margin: 8px 0 0;
            color: #666;
            font-size: 14px;
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
        }

        .form-group {
            margin-bottom: 18px;
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
            font-size: 16px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 12px 12px 42px;
            border-radius: 10px;
            border: 2px solid #eee;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .form-group textarea {
            padding: 12px 14px;
            resize: none;
            height: 80px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #f5576c;
            background: white;
            box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #bbb;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .row .form-group {
            margin-bottom: 0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .password-error {
            color: #ff6b6b;
            font-size: 12px;
            margin-top: 6px;
            display: none;
            align-items: center;
            gap: 6px;
        }

        .password-error::before {
            content: "\f26e";
            font-family: "bootstrap-icons";
        }

        .password-error.show {
            display: flex;
        }

        .password-match.show {
            display: flex;
            color: #10b981;
            font-size: 12px;
        }

        .password-match::before {
            content: "\f26e";
            font-family: "bootstrap-icons";
        }

        .signup-btn {
            width: 100%;
            margin-top: 16px;
            padding: 14px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(245, 87, 108, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .signup-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(245, 87, 108, 0.4);
        }

        .signup-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .login-link {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #f5576c;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #f093fb;
            text-decoration: underline;
        }

        @media (max-width: 520px) {
            .row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="signup-wrapper">
        <div class="signup-container">
            <div class="signup-header">
                <h1>Join Halwaaz</h1>
                <p>Create your sweet account today</p>
            </div>

            <?php if (!empty($_SESSION['signup_error'])):?>
                <div class="alert-error"><?= $_SESSION['signup_error'];?></div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['signup_success'])):?>
                <div class="alert-success"><?= $_SESSION['signup_success'];?></div>
            <?php endif; ?>

            <form action="<?=base_url('save_signup')?>" method="post">
                <div class="form-group full-width">
                    <label><i class="bi bi-person"></i> Full Name</label>
                    <div class="input-wrapper">
                        <i class="bi bi-person-circle input-icon"></i>
                        <input type="text" name="name" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label><i class="bi bi-at"></i> Username</label>
                        <div class="input-wrapper">
                            <i class="bi bi-at input-icon"></i>
                            <input type="text" name="username" placeholder="Choose username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="bi bi-envelope"></i> Email</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email" name="email" placeholder="Enter email" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label><i class="bi bi-lock"></i> Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" name="password" id="password" placeholder="Create password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="bi bi-shield-lock"></i> Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-shield-lock input-icon"></i>
                            <input type="password" name="repassword" id="repassword" placeholder="Confirm password" required>
                        </div>
                        <div id="passwordError" class="password-error">Passwords do not match!</div>
                        <div id="passwordMatch" class="password-match">Passwords match!</div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label><i class="bi bi-geo-alt"></i> Address</label>
                    <div class="input-wrapper">
                        <textarea placeholder="Enter your full address" name="address" required></textarea>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label><i class="bi bi-telephone"></i> Phone</label>
                    <div class="input-wrapper">
                        <i class="bi bi-telephone-fill input-icon"></i>
                        <input type="tel" placeholder="Enter phone number" name="phone" required>
                    </div>
                </div>

                <button type="submit" class="signup-btn" id="submitButton" disabled>
                    <i class="bi bi-check-circle"></i> Create Account
                </button>
            </form>

            <div class="login-link">
                Already have an account? <a href="<?=base_url('login')?>">Login here</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#password, #repassword').on('input', function(){
                let p = $('#password').val();
                let r = $('#repassword').val();
                
                if(p && r) {
                    if(p === r){
                        $('#passwordError').removeClass('show');
                        $('#passwordMatch').addClass('show');
                        $('#submitButton').prop('disabled', false);
                    } else {
                        $('#passwordError').addClass('show');
                        $('#passwordMatch').removeClass('show');
                        $('#submitButton').prop('disabled', true);
                    }
                } else {
                    $('#passwordError').removeClass('show');
                    $('#passwordMatch').removeClass('show');
                    $('#submitButton').prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>
