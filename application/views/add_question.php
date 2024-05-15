<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/add_question.css'); ?>">
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
<div class="main-content">
    <h1>Add Question</h1>
    <div class="note-card">
        <h2>Writing a good question</h2>
        <p>
            You’re ready to ask a programming-related question and this form will help guide you through the process.

            Looking to ask a non-programming question? See the topics here to find a relevant site.

            Steps:
            <ol>
                <li>Summarize your problem in a one-line title.</li>
                <li>Describe your problem in more detail.</li>
                <li>Describe what you tried and what you expected to happen.</li>
                <li>Add “tags” which help surface your question to members of the community.</li>
                <li>Review your question and post it to the site.</li>
            </ol>
        </p>
    </div>
    <div class="container">
        <form action="<?php echo site_url('dashboard/save_question'); ?>" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">
            <label for="content">Content:</label>
            <textarea id="content" name="content"></textarea>
            <label for="tags">Tags:</label>
            <input type="text" name="tags" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
