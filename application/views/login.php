<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
</head>
<body>
<div class="login-page">
    <div class="form">
        <h2>Login</h2>
        <div id="message"></div>
        <form id="loginForm">
            <input type="text" name="username" id="username" placeholder="Username"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <button type="submit">Login</button>
        </form>
        <div class="login-link">
            Don't have an account? <?php echo anchor('auth/register', 'Sign Up'); ?>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
<script type="text/javascript" src="https://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
<script>
var LoginModel = Backbone.Model.extend({
    
    defaults: {
        username: '',
        password: ''
    }
});

var LoginView = Backbone.View.extend({
    el: "#loginForm",
    events: {
        'submit': 'saveUser'
    },

    initialize: function(){
        this.model = new LoginModel();
    },

    saveUser: function(event){
            event.preventDefault();

            this.model.set(
                {username: this.$('#username').val(), 
                    password: this.$('#password').val()}
            );

            // Transfer data to the server
            $.ajax({
                url: 'http://localhost/w1809833_CW/Advanced_ServerSide_CW/index.php/AuthRequest/login',
                type: 'POST',
                data: this.model.toJSON(),

                xhrFields: {
                    withCredentials: true
                 },

                success: function(response) {
                    console.log('Request successful');
                    window.location.href = 'http://localhost/w1809833_CW/Advanced_ServerSide_CW/index.php/dashboard/index';
                },
                error: function(xhr, status, error) {
                    console.error('Error saving data:', error);
                    var message = 'Invalid Email or Password';
                    $('#message').text(message).css('color', 'red').show();
                }
            });
        },
});

var LoginView = new LoginView();
</script>
</html>
