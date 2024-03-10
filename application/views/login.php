<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #C5DAFF; /* Dark blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* .container {
            width: 20%;
            height: 50%;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease; 
        } */
        
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
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #04193d; /* Dark blue text color */
        }
        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f9f9f9; /* Light gray background */
            transition: all 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus,
        button:focus {
            outline: none;
            border-color: #007bff; /* Blue border color on focus */
        }
        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            margin-top: 50px;
            transition: transform 0.3s ease;
            background-image: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .login-link {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
            background-color: transparent;
            border-radius: 10px;
            /* box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2); */
        }
        .form {
            position: relative;
            z-index: 1;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
        }

        .form input[type="text"],
        .form input[type="password"] {
            font-family: 'Roboto', sans-serif;
            outline: none;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .form button {
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
            outline: none;
            background-color: #2196F3;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 20px;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background-color: #1976D2;
        }

        .form h2 {
            color: #333333;
            font-size: 28px;
            margin: 0 0 30px;
        }

        .form p.message {
            color: #666666;
            font-size: 14px;
            margin-top: 15px;
        }

        .form p.message a {
            color: #2196F3;
            text-decoration: none;
        }

        .form p.message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="form">
        <h2>Login</h2>
        <?php echo validation_errors(); ?>
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="error"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php echo form_open('auth/login'); ?>
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit">Login</button>
        <?php echo form_close(); ?>
        <div class="login-link">
            Don't have an account?  <a href="<?php echo base_url('/'); ?>">Sign Up</a>
        </div>
    </div>
</body>
</html>
