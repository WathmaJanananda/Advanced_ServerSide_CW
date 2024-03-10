<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Other meta tags and styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
            color: #000000;
            margin-bottom: 30px;
            font-weight: normal; /* Remove bold */
        }

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
            width: calc(50% - 10px); /* Adjusted width for two columns */
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
        .user-details {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    display: flex;
}

.user-profile {
    margin-right: 20px;
}

.user-info {
    flex-grow: 1; /* Allow the user info to take up remaining space */
}

.user-info p {
    margin: 10px 0;
}

.user-info strong {
    color: #007bff;
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
<h1>User Profile</h1>

<div class="user-details">
    <div class="user-profile">
        <i class="fas fa-user-circle fa-3x"></i> <!-- Adjust the size of the icon as needed -->
    </div>
    <div class="user-info">
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    </div>
</div>




<h2>Questions Posted</h2>
<div class="content">
    <ul>
        <?php foreach ($questions as $question): ?>
            <li>
                <h3><?php echo $question['title']; ?></h3>
                <p><?php echo $question['content']; ?></p>
                <!-- Adjusted delete link -->
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
                <!-- Adjusted delete link -->
                <a href="<?php echo site_url('profileController/deleteAnswer/'.$answer['answer_id']); ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
