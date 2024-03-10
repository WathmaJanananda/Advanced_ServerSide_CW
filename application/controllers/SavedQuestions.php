<?php
class SavedQuestions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SavedQuestions_model');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('user_agent');
    }

	//This function is to save a question (This should be called from a save link)
	// The link should be in the page where a specific question is displayed
	 
    public function save($question_id) {
        // Retrieve user ID from the session
        $user_id = $this->session->userdata('user_id');

        $this->load->model('SavedQuestions_model');
        $this->SavedQuestions_model->save_question($user_id, $question_id);

        // Redirect to the previous page
        redirect($this->agent->referrer());
    }

	//This function is to view all questions
    public function index() {
        // Retrieve user ID from the session
        $user_id = $this->session->userdata('user_id');

        $this->load->model('SavedQuestions_model');
        $data['saved_questions'] = $this->SavedQuestions_model->get_saved_questions($user_id);

        $this->load->view('saved_questions', $data);
    }
}