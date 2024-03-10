<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions by Tag</title>
    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #C5DAFF;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Heading Styles */
        h1 {
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: normal; /* Remove bold */
        }

        /* List Styles */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            max-width: 600px;
            width: 100%;
        }

        li {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        li:hover {
            transform: translateY(-5px);
        }
        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 100px; /* Adjusted width */
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #007bff; /* Blue sidebar background */
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 0 20px 0 20px; /* Rounded only top-right and bottom-right corners */
        }

        .sidebar a {
            padding: 20px;
            text-decoration: none;
            font-size: 14px; /* Adjusted font size */
            color: #ffffff; /* White icon color */
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: 0.3s;
        }

        .sidebar a span {
            margin-top: 5px; /* Add space between icon and label */
        }

        /* Adjusted close button position */
        .sidebar .close-btn {
            align-self: flex-end;
            margin-right: 10px;
            font-size: 30px;
        }

        .sidebar a:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .sidebar a:hover i {
            transform: scale(1.2); /* Scale up icon on hover */
        }
        .content {
            max-width: 1000px; /* Adjusted max-width */
            width: 100%;
            padding: 0 20px;
            text-align: left; /* Left align content */
        }
    </style>
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
    <h1>Questions by Tag</h1>
    
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
