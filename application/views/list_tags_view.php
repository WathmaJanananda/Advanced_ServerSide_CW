<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tags</title>
    <!-- Include font awesome styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            display: inline-block; /* Display tags horizontally */
            margin-right: 10px; /* Add some space between tags */
        }

        li:last-child {
            margin-right: 0; /* Remove margin for the last tag */
        }

        li:hover {
            transform: translateY(-5px);
        }

        /* Link Styles */
        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Paragraph Styles */
        p {
            color: #333;
            margin-top: 10px;
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
    <h1>All Tags</h1>
    <ul>
        <?php foreach ($tags as $tag): ?>
            <li>
                <a href="<?php echo site_url('tag/view_questions_by_tag/' . $tag['tag_id']); ?>">
                    <?php echo $tag['tag_name']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
