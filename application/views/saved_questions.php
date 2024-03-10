<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        /* Input Styles */
        input[type="text"] {
            font-family: 'Roboto', sans-serif;
            outline: none;
            width: calc(100% - 250px); /* Adjusted width */
            border: 0;
            margin: 0;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 20px 0 0 20px;
            background-color: rgba(255, 255, 255, 0.7);
            color: #000000;
            display: inline-block;
            vertical-align: middle;
        }

        input[type="text"]::placeholder {
            color: rgba(0, 0, 0, 0.7);
        }

        /* Button Styles */
        button {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: 0;
            border-radius: 20px;
            display: inline-block;
            vertical-align: middle;
        }

        button:hover {
            background-color: #0056b3;
        }

        .search-button {
            border-radius: 0 20px 20px 0;
        }

        .add-question-button {
            margin-left: 10px;
            border-radius: 20px;
        }

        /* Heading Styles */
        h1, h2 {
            color: #000000;
            margin-bottom: 30px;
            font-weight: normal; /* Remove bold */
        }

        /* h2 {
            margin-bottom: 20px;
            text-align: left;
        } */

        /* h1 {
            text-align: center;
        } */

        /* List Styles */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap; /* Allow wrapping */
            justify-content: space-between; /* Evenly distribute items */
            max-width: 1000px; /* Adjusted max-width */
            width: 100%;
        }

        li {
            width: calc(33.33% - 20px); /* Adjusted width for three columns with margins */
            margin-bottom: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            transition: transform 0.3s ease;
            box-sizing: border-box; /* Include padding in width calculation */
        }

        li:hover {
            transform: translateY(-5px);
        }

        /* Link Styles */
        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            text-align: left;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Paragraph Styles */
        p {
            color: #333333;
            margin-top: 10px;
            text-align: left;
        }

        .search-container {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .add-question-container {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
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

        /* Content Styles */
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

<h2>Saved Questions</h2>
<div class="content">
    <ul>
    <?php foreach ($saved_questions as $question): ?>
    <li>
        <a href="<?php echo site_url('question/view/' . $question['question_id']); ?>">
            <h3><?php echo $question['title']; ?></h3>
        </a>
        <p><?php echo $question['content']; ?></p>
        <!-- Display upvote count and downvote count -->
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
