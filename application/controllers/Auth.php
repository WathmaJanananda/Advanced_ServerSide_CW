<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Auth_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('register');
        } else {
            $this->Auth_model->register_user();
            redirect('auth/login');
        }
    }

    public function login() {
        $this->load->view('login');
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}
?>
