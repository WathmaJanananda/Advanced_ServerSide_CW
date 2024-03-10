<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_model extends CI_Model {

    public function add_answer($data) {
        // Assuming you have an 'answers' table in your database
        $this->db->insert('answers', $data);
    }

    public function get_answers($question_id) {
        // Retrieve answers for a specific question
        return $this->db->get_where('answers', ['question_id' => $question_id])->result_array();
    }

}
