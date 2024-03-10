<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #C5DAFF;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            min-height: 100vh;
            overflow: hidden; /* Prevent scroll bar */
        }

        .main-content {
            display: flex;
            flex-direction: row; /* Change to row layout */
            align-items: flex-start;
            justify-content: flex-start; /* Changed to start from the left */
            margin-left: 100px; /* Adjusted margin to move it more to the left */
            margin-top: 50px; /* Kept the margin-top */
            flex: 1; /* Take remaining vertical space */
            flex-wrap: wrap; /* Allow wrapping */
            position: relative; /* Added relative positioning */
        }

        .container {
            max-width: 600px;
            width: calc(60% - 70px); /* Adjusted width to fit half the available space */
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 20px;
            box-sizing: border-box;
            text-align: left; /* Align content to the left */
            margin-bottom: 20px; /* Added margin at the bottom */
            position: relative; /* Set position to relative */
            left: -70px; /* Adjusted position to move it more to the left */
            margin-top: 20px; /* Adjusted margin to move it closer to the note-card */
            height: 355px;
        }


        .note-card {
            width: 600px;
            height: 350px;
            background-color: rgba(255, 255, 255, 0.7); /* Adjusted background color with transparency */
            border-radius: 20px; /* Increased border radius */
            padding: 20px; /* Increased padding */
            box-sizing: border-box; /* Added box-sizing to include padding in width/height */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            margin-right: auto; /* Adjusted margin to move it to the left */
            margin-left: 70px; /* Adjusted margin to move it more to the left */
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .note-card h2 {
            color: #000000; /* Adjusted heading color */
            font-size: 20px; /* Reduced heading font size */
            margin-bottom: 15px; /* Increased margin-bottom */
        }

        .note-card p {
            color: #000000; /* Adjusted paragraph color */
            font-size: 14px; /* Reduced paragraph font size */
            line-height: 1.6; /* Increased line height for better readability */
        }

        .note-card ol {
            margin-top: 10px; /* Added margin-top for spacing */
            padding-left: 20px; /* Adjusted padding for list items */
        }

        .note-card li {
            margin-bottom: 10px; /* Added margin-bottom for spacing between list items */
            font-size: 14px; /* Adjusted font size for list items */
        }

        h1 {
            color:#000000; /* Changed text color */
            text-align: left;
            font-size: 24px; /* Increased font size */
            margin-bottom: 20px;
            width: 100%; /* Ensure the heading takes full width */
            margin-left: 80px;
            font-weight: normal;
        }

        input[type="text"],
        textarea {
            font-family: 'Roboto', sans-serif;
            outline: none;
            width: calc(100% - 30px);
            border: 0;
            margin: 0;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px; /* Increased font size */
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            color: #000000; /* Changed text color */
            display: block;
            margin-bottom: 15px;
            text-align: left;
            margin-left: auto;
            margin-right: auto;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: 0;
            border-radius: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top:20px
        }

        button:hover {
            background-color: #0056b3;
        }

        label {
            color: #000000; /* Changed text color */
            display: block;
            text-align: left;
            font-size: 15px;
            margin-left:15px;
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
