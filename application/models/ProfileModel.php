<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model {
    public function getUserById($user_id) {
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        return $query->row_array();
    }

    public function getQuestionsByUser($user_id) {
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAnswersByUser($user_id) {
        $this->db->select('*');
        $this->db->from('answers');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteQuestion($question_id) {
        // Delete associated question tags
        $this->db->where('question_id', $question_id);
        $this->db->delete('question_tags');

        // Delete associated answers and votes
        $this->deleteAnswersAndVotes($question_id);

        // Delete saved questions (if any)
        $this->db->where('question_id', $question_id);
        $this->db->delete('saved_questions');

        // Delete the question itself
        $this->db->where('question_id', $question_id);
        $this->db->delete('questions');
    }

    private function deleteAnswersAndVotes($question_id) {
        // Fetch associated answer IDs
        $this->db->select('answer_id');
        $this->db->where('question_id', $question_id);
        $query = $this->db->get('answers');
        $answer_ids = $query->result_array();

        // Delete associated votes
        foreach ($answer_ids as $answer) {
            $this->db->where('answer_id', $answer['answer_id']);
            $this->db->delete('votes');
        }

        // Delete associated answers
        $this->db->where('question_id', $question_id);
        $this->db->delete('answers');
    }

    public function deleteAnswer($answer_id) {

        // Delete the votes records for the answer
        $this->db->where('answer_id', $answer_id);
        $this->db->delete('votes');

        // Delete the answer record
        $this->db->where('answer_id', $answer_id);
        $this->db->delete('answers');

        // You may also want to check if the question associated with the answer has no answers left and delete it if needed.
        // Add your logic here if required.
    }
}
?>