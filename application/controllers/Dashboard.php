<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models
        $this->load->model('Question_model');
        $this->load->database();
        $this->load->helper('url'); // Load URL helper
        $this->load->library('session');
    }

    public function index() {
        // Get top 15 questions from the database
        $data['questions'] = $this->Question_model->get_top_questions(15);
        // Load the dashboard view
        $this->load->view('dashboard', $data);
    }

    public function search() {
        $keyword = $this->input->post('keyword'); 
        if (!empty($keyword)) {
            $data['questions'] = $this->Question_model->search_questions($keyword);
        } else {
            // If keyword is empty, show all questions (or handle it as you prefer)
            $data['questions'] = $this->Question_model->get_top_questions(15);
        }
        $this->load->view('dashboard', $data);
    }

    public function add_question() {
        $this->load->view('add_question');
    }

    public function save_question() {
        $user_id = $this->session->userdata('user_id');

        $data = array(
                    'user_id' => $user_id,
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'tags' => $this->input->post('tags'),
                    'created_at' => date('Y-m-d H:i:s')
                );

        // Add question to the database
        $this->Question_model->add_question($data);
        
        // Send the user to the dashboard or another preferred page
        redirect('dashboard');
    }
    
}
?>