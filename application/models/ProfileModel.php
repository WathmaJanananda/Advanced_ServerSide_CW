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
        //Remove related question tags
        $this->db->where('question_id', $question_id);
        $this->db->delete('question_tags');

        // Remove related answers and votes
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

        // Remove related votes
        foreach ($answer_ids as $answer) {
            $this->db->where('answer_id', $answer['answer_id']);
            $this->db->delete('votes');
        }

        // Remove related answers
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

    }
    // Add these methods to ProfileModel.php

public function updatePassword($user_id, $new_password) {
    $data = array(
        'password' => password_hash($new_password, PASSWORD_DEFAULT)
    );
    $this->db->where('user_id', $user_id);
    $this->db->update('users', $data);
}

public function updateUsername($user_id, $new_username) {
    $data = array(
        'username' => $new_username
    );
    $this->db->where('user_id', $user_id);
    $this->db->update('users', $data);
}

}
?>