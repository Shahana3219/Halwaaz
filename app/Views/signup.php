<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halwaaz | Sign Up</title>
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
        url("<?= base_url('public/images/halwa2.jpg') ?>")
        center / cover
        no-repeat
        fixed;

    display: flex;
    align-items: center;
    justify-content: center;
}


        .signup-container {
            background: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 35px 40px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.35);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .signup-container h1 {
            text-align: center;
            margin-bottom: 5px;
            color: #6a11cb;
            font-size: 30px;
        }

        .signup-container p {
            text-align: center;
            margin-bottom: 25px;
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: #444;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 11px 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group textarea {
            resize: none;
            height: 70px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #ff0844;
            box-shadow: 0 0 0 3px rgba(255,8,68,0.15);
        }

        .row {
            display: flex;
            gap: 12px;
        }

        .row .form-group {
            flex: 1;
        }

        .signup-btn {
            width: 100%;
            margin-top: 10px;
            padding: 13px;
            background: linear-gradient(135deg, #6a11cb, #ff0844);
            border: none;
            border-radius: 14px;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
        }

        .signup-btn:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 10px 25px rgba(0,0,0,0.35);
            opacity: 0.95;
        }

        .login-link {
            margin-top: 18px;
            text-align: center;
            font-size: 13px;
        }

        .login-link a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: #ff0844;
        }
        .alert-error {
    color: red;
    background: #ffe6e6;
}

        @media (max-width: 520px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <div class="signup-container">
        <h1>Join Halwaaz</h1>
        <p>Create your sweet account</p>
        <!-- errors/success flash messages -->
<!-- If the controller stored a signup error /success message in the session, display it here -->
            <?php if (!empty($_SESSION['signup_error'])):?>
                <div class="alert-error" ><?= $_SESSION['signup_error'];?>
            </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['signup_success'])):?>
                <div class="alert-success" ><?= $_SESSION['signup_success'];?>
            </div>
            <?php endif; ?>

        <form action="<?=base_url('save_signup')?>" method="post">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter full name">
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Choose username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" placeholder="Create password">
                </div>
                <div class="form-group">
                    <label>Re-enter Password</label>
                    <input type="password" name="repassword" id="repassword" placeholder="Confirm password">
                     <small id="passwordError" style="color: red; display: none;">Passwords do not match!</small>
            </div>
                </div>
            

            <div class="form-group">
                <label>Address</label>
                <textarea placeholder="Enter address" name="address"></textarea>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" placeholder="Enter phone number" name="phone">
            </div>

            <button type="submit" class="signup-btn" id="submitButton">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="<?=base_url('login')?>"> Login </a>
        </div>
    </div>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 
 <script>
    $(document).ready (function(){
        $('#password,#repassword').on('input',function(){
            let p=$('#password').val();
            let r=$('#repassword').val();
            
            if(p==r){
                    $('#passwordError').hide();
                    $('#submitButton').prop('disabled',false);
            }else{
               $('#passwordError').show();
                    $('#submitButton').prop('disabled',true); 
            }

        });
    });
    </script>
</body>
</html>
