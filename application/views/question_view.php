<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question View</title>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C5DAFF;
            color: #000000;
            padding: 20px;
            margin-left: 120px; /* Adjusted margin to accommodate the sidebar */
            position: relative; /* Added position relative */
        }

        h1 {
            color:#000000; /* Changed text color */
            text-align: left;
            font-size: 24px; /* Increased font size */
            margin-bottom: 20px;
            width: 100%; /* Ensure the heading takes full width */
            font-weight: normal;
        }

        h2 {
            color: #000000;
            font-size: 19px;
        }

        h3 {
            color: #000000;
            font-size: 20px;
        }

        p {
            color: #000000;
            font-size: 16px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        .answer {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .answer p {
            margin-bottom: 5px;
        }

        .answer .fa-thumbs-up,
        .answer .fa-thumbs-down {
            color: #007bff;
            margin-right: 10px;
            text-decoration: none;
        }

        .answer .fa-thumbs-up:hover,
        .answer .fa-thumbs-down:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000000;
            background-color: rgba(255, 255, 255, 0.1);
            color: #000000;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top:10px
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

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
        
        .save-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #007bff;
            cursor: pointer;
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
    <i class="fas fa-save"></i>
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
<h1>View Question</h1>
    <!-- Display Question Details -->
    <h2><?php echo $question['title']; ?></h2>
    <p><?php echo $question['content']; ?></p>

    <!-- Display Answers -->
    <!-- Display Answers -->
<h3>Answers:</h3>
<ul>
    <?php foreach ($answers as $answer): ?>
        <div class="answer">
            <p><?php echo $answer['content']; ?></p>
            <!-- Display user who submitted the answer -->
            <?php 
                // Fetch user information based on user_id
                $user = $this->db->get_where('users', ['user_id' => $answer['user_id']])->row_array();
                if ($user) {
                    echo "<p>Answered by: ".$user['username']."</p>";
                }
            ?>

            <!-- Thumbs up icon -->
            <a href="<?php echo site_url('question/upvote/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>"><i class="fas fa-thumbs-up"></i></a>

            <!-- Thumbs down icon -->
            <a href="<?php echo site_url('question/downvote/' . $answer['answer_id'] . '/' . $answer['question_id']); ?>"><i class="fas fa-thumbs-down"></i></a>
        </div>
    <?php endforeach; ?>
</ul>


    <!-- Form for Submitting Answers -->
    <form method="post" action="<?php echo site_url('question/submit_answer/' . $question['question_id']); ?>">
        <label for="answer_content">Your Answer:</label>
        <textarea name="answer_content" required></textarea>
        <button type="submit">Submit Answer</button>
    </form>
    
    <!-- Save Icon -->
    <a href="<?php echo site_url('savedQuestions/save/' . $question['question_id']) ?>" title="Save question">
    <i class="far fa-save save-icon"></i>
    </a>
</body>
</html>
