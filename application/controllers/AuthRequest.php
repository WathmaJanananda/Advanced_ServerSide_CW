<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
 
use chriskacerguis\RestServer\RestController;

class AuthRequest extends RestController {
    function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database(); // Load the database library

    }

    public function login_post() {
        $username = $this->post('username');
        $password = $this->post('password');

        $this->form_validation->set_data(['username' => $username, 'password' => $password]);
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->response([
                'status' => FALSE,
                'message' => 'Login failed. Validation errors.',
                'errors' => $this->form_validation->error_array()
            ], RestController::HTTP_BAD_REQUEST);
         } else {
                $user_id = $this->Auth_model->login_user();
                if($user_id) {
                    // Set session with user_id
                    $this->session->set_userdata('user_id', $user_id);
                                    
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Login successful',
                        'userData' => $user_id
                    ], RestController::HTTP_OK);
                }
           
                else {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Login failed. Email or password incorrect.'
                    ], RestController::HTTP_NOT_FOUND);
                }
        }
    }
}