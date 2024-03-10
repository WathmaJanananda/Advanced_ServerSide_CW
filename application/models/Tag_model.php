<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
        $this->load->helper('url');

    }

    public function get_all_tags() {
        $this->db->select('*');
        $this->db->from('tags');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_questions_by_tag($tag_id) {
        $this->db->select('questions.*, 
                           (SELECT COUNT(*) FROM votes WHERE vote_type = "upvote" AND question_id = questions.question_id) as upvote_count,
                           (SELECT COUNT(*) FROM votes WHERE vote_type = "downvote" AND question_id = questions.question_id) as downvote_count,
                           (SELECT COUNT(*) FROM answers WHERE question_id = questions.question_id) as answer_count');
        $this->db->from('questions');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id');
        $this->db->where('question_tags.tag_id', $tag_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
?>