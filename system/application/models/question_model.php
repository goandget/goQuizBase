<?php

class Question_model extends CI_Model {

	public function delete($id)
	{
		// Delete the Question
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('questions');

		// Delete the Answers Connected to this question.
		$this->db->where('question_id',$id);
		$this->db->delete('answers');
	}

	// Return the questions for managing.
	public function get_questions()
	{
		$this->db->select('id,questions.type,question,level,updated');
		$this->db->join('question-types', 'typeid = questions.type', 'LEFT');
		$query = $this->db->get('questions');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return array();
		}
		
	}


}