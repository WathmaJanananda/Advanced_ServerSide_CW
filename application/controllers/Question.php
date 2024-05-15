<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');

        // Load the models
        $this->load->model('Question_model');
        $this->load->model('answer_model');
    }
    
    public function view($question_id) {
        // Load the necessary models
        $this->load->model('question_model');
        $this->load->model('answer_model');
        
        // Getting the question details
        $data['question'] = $this->question_model->get_question($question_id);
        
        // Getting the answers for the question
        $data['answers'] = $this->answer_model->get_answers($question_id);
        
        // Loading the view
        $this->load->view('question_view', $data);
    }

    public function submit_answer($question_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user_id = $this->session->userdata('user_id');

            $data = array(
                'user_id' => $user_id,
                'content' => $this->input->post('answer_content'),
                'question_id' => $question_id,
            );

            // Calling the model to add the answer
            $this->answer_model->add_answer($data);

            // Redirect back to the question view
            redirect('question/view/' . $question_id);
        }

    }

    public function upvote($answer_id, $question_id) {
        $this->load->model('question_model');

        // Perform upvote logic
        $this->question_model->upvote_answer($answer_id, $question_id);

        // Redirect back to the question view or other appropriate page
        redirect('question/view/' . $question_id);
    }

    public function downvote($answer_id, $question_id) {
        $this->load->model('question_model');

        // Perform downvote logic
        $this->question_model->downvote_answer($answer_id, $question_id);

        // Redirect back to the question view or other appropriate page
        redirect('question/view/' . $question_id);
    }
}