<?php
class SavedQuestions_model extends CI_Model {

	//This function is to save a question
    public function save_question($user_id, $question_id) {
        $data = array(
            'user_id' => $user_id,
            'question_id' => $question_id
        );
        $this->db->insert('saved_questions', $data);
    }

	//This function is to view all questions
    public function get_saved_questions($user_id) {
        $this->db->select('questions.*, 
                           IFNULL(votes.upvote_count, 0) AS upvote_count,
                           IFNULL(votes.downvote_count, 0) AS downvote_count,
                           IFNULL(answers.answer_count, 0) AS answer_count');
        $this->db->from('questions');
        $this->db->join('saved_questions', 'questions.question_id = saved_questions.question_id');
        $this->db->join('(SELECT question_id, 
                                 SUM(CASE WHEN vote_type = "upvote" THEN 1 ELSE 0 END) AS upvote_count,
                                 SUM(CASE WHEN vote_type = "downvote" THEN 1 ELSE 0 END) AS downvote_count
                          FROM votes
                          GROUP BY question_id) AS votes', 'questions.question_id = votes.question_id', 'left');
        $this->db->join('(SELECT question_id, COUNT(answer_id) AS answer_count
                          FROM answers
                          GROUP BY question_id) AS answers', 'questions.question_id = answers.question_id', 'left');
        $this->db->where('saved_questions.user_id', $user_id);
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
}