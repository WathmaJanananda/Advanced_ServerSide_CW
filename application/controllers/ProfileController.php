<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ProfileModel');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');

        // Retrieve user details, questions, and answers
        $data['user'] = $this->ProfileModel->getUserById($user_id);
        $data['questions'] = $this->ProfileModel->getQuestionsByUser($user_id);
        $data['answers'] = $this->ProfileModel->getAnswersByUser($user_id);

        // Load the view with user data
        $this->load->view('profile_view', $data);
    }

    public function deleteQuestion($question_id) {
        // Added a logic to check if the user can delete the question
        $this->ProfileModel->deleteQuestion($question_id);
        redirect('profileController/index'); // Redirect to the profile page
    }

    public function deleteAnswer($answer_id) {
        // Added a logic to check if the user can delete the answer
        $this->ProfileModel->deleteAnswer($answer_id);
        redirect('profileController/index'); // Redirect to the profile page
    }
    // Add these methods to ProfileController.php

public function updatePassword() {
    $user_id = $this->session->userdata('user_id');
    $new_password = $this->input->post('new_password');

    // Call the model method to update password
    $this->ProfileModel->updatePassword($user_id, $new_password);

    redirect('profileController/index'); // Redirect to the profile page
}

public function updateUsername() {
    $user_id = $this->session->userdata('user_id');
    $new_username = $this->input->post('new_username');

    // Call the model method to update username
    $this->ProfileModel->updateUsername($user_id, $new_username);

    redirect('profileController/index'); // Redirect to the profile page
}

}
?>