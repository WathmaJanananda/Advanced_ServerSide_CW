<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other meta tags and styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
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

<h1>Welcome to Question Hub</h1>

<!-- Search Section -->
<div class="search-container">
    <form action="<?php echo site_url('dashboard/search'); ?>" method="post">
        <input type="text" name="keyword" placeholder="Search...">
        <button type="submit" class="search-button">Search</button>
    </form>
</div>


<!-- Add question Button -->
<div class="add-question-container">
    <a href="<?php echo site_url('dashboard/add_question'); ?>"><button class="add-question-button">Add Question</button></a>
</div>


<h2>Questions:</h2>
<div class="content">
    <ul>
        <?php foreach ($questions as $question): ?>
            <li>
                <a href="<?php echo site_url('question/view/' . $question['question_id']); ?>">
                    <h3><?php echo $question['title']; ?></h3>
                </a>
                <p><?php echo $question['content']; ?></p>
                <!-- Display upvote count, downvote count, and answer count -->
                <div>
                    <i class="fas fa-arrow-up"></i> Upvotes: <?php echo $question['upvote_count']; ?>
                    <i class="fas fa-arrow-down"></i> Downvotes: <?php echo $question['downvote_count']; ?>
                    <i class="fas fa-comments"></i> Answers: <?php echo $question['answer_count']; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


</body>
</html>




