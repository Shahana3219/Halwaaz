<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Halwaaz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

       body {
    margin: 0;
    height: 100vh;
    background:
        linear-gradient(
            rgba(0,0,0,0.55),
            rgba(0,0,0,0.55)
        ),
        url("<?= base_url('public/images/hero.jpg') ?>")
        center / cover
        no-repeat
        fixed;

    display: flex;
    align-items: center;
    justify-content: center;
}


        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 35px 30px;
            width: 100%;
            max-width: 380px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
        }

        .login-container h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            color: #7a2e00;
        }

        .login-container p {
            margin: 8px 0 25px;
            font-size: 14px;
            color: #555;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #d2691e;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #d2691e, #a94b00);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.25);
        }

        .footer-text {
            margin-top: 18px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Halwaaz</h1>
        <p>Sweet & Delicious Halwa World</p>


<?php if (!empty($_SESSION['error_login'])):?>
    <div class="alert-error" ><?=$_SESSION['error_login'];?>
</div>
<?php endif; ?>

<?php if (!empty($_SESSION['login_success'])):?>
    <div class="alert-success" ><?=$_SESSION['login_success'];?>
</div>
<?php endif; ?>

<?php if (!empty($_SESSION['error_password'])):?>
    <div class="alert-error" ><?=$_SESSION['error_password'];?>
</div>
<?php endif; ?>


        <form action="<?=base_url('save_login')?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password">
            </div>

            <button type="submit" class="login-btn">Login</button>

        </form>
  <a href="<?= base_url('signup') ?>">signup</a>
        <div class="footer-text">Welcome to Halwaaz</div>
    </div>

</body>
</html>