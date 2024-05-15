<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question View</title>
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/question_view.css'); ?>">
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
    <!-- Show Question Details -->
    <h2><?php echo $question['title']; ?></h2>
    <p><?php echo $question['content']; ?></p>

    <!-- Show the Answers -->
    <!-- Show the Answers -->
<h3>Answers:</h3>
<ul>
    <?php foreach ($answers as $answer): ?>
        <div class="answer">
            <p><?php echo $answer['content']; ?></p>
            <!-- Show the person who submitted the response -->
            <?php 
                // Use user_id to retrieve user data
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


    <!-- Submitting Answers Form -->
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
