<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/register.css'); ?>">

</head>
<body>
    <div class="signup-page">
    <div class="form">
        <h2>Sign up</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open('auth/register'); ?>
            <input type="text" name="username" placeholder="Username"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit">Register</button>
        <?php echo form_close(); ?>
        <div class="login-link">
            Already have an account? 
            <?php echo anchor ('http://localhost/w1809833_CW/Advanced_ServerSide_CW/index.php/auth/login', 'Login Here'); ?>
        </div>
    </div>
</body>
</html>