<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    public function register_user() {
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );
        $this->db->insert('users', $data);
    }

    public function login_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $this->session->set_userdata('user_id', $user->user_id);
                return true;
            }
        }
        return false;
    }
}
?>
