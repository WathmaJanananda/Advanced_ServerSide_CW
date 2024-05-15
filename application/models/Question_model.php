<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {

    public function get_top_questions($limit) {
        // Retrieve the top questions from the database, along with the number of answers, upvotes, and downvotes
        $this->db->select('questions.*, 
            (SELECT COUNT(*) FROM votes WHERE vote_type = "upvote" AND question_id = questions.question_id) as upvote_count,
            (SELECT COUNT(*) FROM votes WHERE vote_type = "downvote" AND question_id = questions.question_id) as downvote_count,
            (SELECT COUNT(*) FROM answers WHERE question_id = questions.question_id) as answer_count');
        $this->db->from('questions');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function search_questions($keyword) {
        // Use keywords to search questions and get user name, tags, upvotes, and downvotes
        $this->db->select('questions.*, 
            (SELECT COUNT(*) FROM votes WHERE vote_type = "upvote" AND question_id = questions.question_id) as upvote_count,
            (SELECT COUNT(*) FROM votes WHERE vote_type = "downvote" AND question_id = questions.question_id) as downvote_count,
            (SELECT COUNT(*) FROM answers WHERE question_id = questions.question_id) as answer_count, 
            users.username as user_name');
        $this->db->from('questions');
        $this->db->join('users', 'users.user_id = questions.user_id', 'left');
        $this->db->join('question_tags', 'question_tags.question_id = questions.question_id', 'left');
        $this->db->join('tags', 'tags.tag_id = question_tags.tag_id', 'left');
        $this->db->group_start();
        $this->db->like('title', $keyword);
        $this->db->or_like('tags.tag_name', $keyword); // Search within tag names
        $this->db->group_end();
        $this->db->group_by('questions.question_id'); 
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Check if result is empty or not an array
        if (empty($result) || !is_array($result)) {
            return array();
        }
    
        // For every question, retrieve and explode tags separately
        foreach ($result as &$question) {
            $tags = array_column($result, 'tag_name');
            $question['tags'] = $tags;
        }
    
        return $result;
    }
    
    
    
    public function add_question($data) {
        // Extract tags from the data array
        $tags = explode(',', $data['tags']);
        unset($data['tags']); // Remove tags from the main data array
        
        // Insert question into the database
        $this->db->insert('questions', $data);
        $question_id = $this->db->insert_id(); // Get the ID of the inserted question
        
        // Associate tags with the question
        foreach ($tags as $tag_name) {
            // Check if the tag already exists
            $tag = $this->db->get_where('tags', array('tag_name' => trim($tag_name)))->row_array();
            if (!$tag) {
                // If the tag doesn't exist, insert it into the tags table
                $this->db->insert('tags', array('tag_name' => trim($tag_name)));
                $tag_id = $this->db->insert_id(); // Get the ID of the newly inserted tag
            } else {
                $tag_id = $tag['tag_id'];
            }
            
            // In the question_tags table, link the tag and the question
            $this->db->insert('question_tags', array('question_id' => $question_id, 'tag_id' => $tag_id));
        }
        
        return $question_id;
    }
    
    public function get_question($question_id) {
        // Fetch question details from the database
        $query = $this->db->get_where('questions', array('question_id' => $question_id));
        
        // Check if the query has a result
        if ($query->num_rows() > 0) {
            // Return the first row as an associative array
            return $query->row_array();
        } else {
            // Return false if no question found
            return false;
        }
    }
    public function upvote_answer($answer_id, $question_id) {
        $user_id = $this->session->userdata('user_id');
    
        // Check if the user has already voted on this answer
        $existing_vote = $this->db->get_where('votes', [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
            'question_id' => $question_id,
        ])->row();
    
        if ($existing_vote) {
            // User has voted, check the vote type
            if ($existing_vote->vote_type == 'upvote') {
                // User already upvoted, ignore the action
            } else {
                // User has downvoted, update the vote to upvote
                $this->db->where([
                    'user_id' => $user_id,
                    'answer_id' => $answer_id,
                    'question_id' => $question_id,
                ])->update('votes', ['vote_type' => 'upvote']);
            }
        } else {
            // User hasn't voted, add an upvote
            $this->db->insert('votes', [
                'user_id' => $user_id,
                'answer_id' => $answer_id,
                'question_id' => $question_id,
                'vote_type' => 'upvote',
            ]);
        }
    }
    
    public function downvote_answer($answer_id, $question_id) {
        $user_id = $this->session->userdata('user_id');
    
        // Check if the user has already voted on this answer
        $existing_vote = $this->db->get_where('votes', [
            'user_id' => $user_id,
            'answer_id' => $answer_id,
            'question_id' => $question_id,
        ])->row();
    
        if ($existing_vote) {
            // User has voted, check the vote type
            if ($existing_vote->vote_type == 'downvote') {
                // User already downvoted, ignore the downvote
            } else {
                // User has upvoted, update the vote to downvote
                $this->db->where([
                    'user_id' => $user_id,
                    'answer_id' => $answer_id,
                    'question_id' => $question_id,
                ])->update('votes', ['vote_type' => 'downvote']);
            }
        } else {
            // User hasn't voted, add a downvote
            $this->db->insert('votes', [
                'user_id' => $user_id,
                'answer_id' => $answer_id,
                'question_id' => $question_id,
                'vote_type' => 'downvote',
            ]);
        }
    }
    
}