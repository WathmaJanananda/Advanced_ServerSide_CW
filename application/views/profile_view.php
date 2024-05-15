<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other meta tags and styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/profile_view.css'); ?>">
</head>
<body>
<div class="sidebar" id="sidebar">
    <a href="<?php echo site_url('dashboard'); ?>">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="<?php echo site_url('dashboard/add_question'); ?>">
        <i class="fas fa-plus"></i>
        <span style=margin-left: 5px;>Add Quiz</span>
    </a>
    <a href="<?php echo site_url('savedQuestions/index'); ?>">
    <i class="far fa-save save-icon"></i>
        <span style=margin-left: 5px;>Saved </span>
    </a>
    <a href="<?php echo site_url('tag/list_tags'); ?>">
    <i class="fas fa-tag"></i>
        <span style=margin-left: 5px;>Tags</span>
    </a>
    <a href="<?php echo site_url('auth/login'); ?>">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>
    <a href="<?php echo site_url('profileController/index'); ?>">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
</div>
<h1>User Profile</h1>

<div class="user-details">
    <div class="user-profile">
        <i class="fas fa-user-circle fa-3x"></i> 
    </div>
    <div class="user-info">
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    </div>
</div>

<div class="update-section">
    <div class="update-item">
        <h2>Update Username</h2>
        <form action="<?php echo site_url('profileController/updateUsername'); ?>" method="post">
            <div class="input-container">
                <input type="text" id="new_username" name="new_username" required>
                <button type="submit">Update Username</button>
            </div>
        </form>
    </div>

    <div class="update-item">
        <h2>Update Password</h2>
        <form action="<?php echo site_url('profileController/updatePassword'); ?>" method="post">
            <div class="input-container">
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">Update Password</button>
            </div>
        </form>
    </div>
</div>

<h2>Questions Posted</h2>
<div class="content">
    <ul>
        <?php foreach ($questions as $question): ?>
            <li>
                <h3><?php echo $question['title']; ?></h3>
                <p><?php echo $question['content']; ?></p>
                <a href="<?php echo site_url('profileController/deleteQuestion/'.$question['question_id']); ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<h2>Answers Posted</h2>
<div class="content">
    <ul>
        <?php foreach ($answers as $answer): ?>
            <li>
                <p><?php echo $answer['content']; ?></p>
                <a href="<?php echo site_url('profileController/deleteAnswer/'.$answer['answer_id']); ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
