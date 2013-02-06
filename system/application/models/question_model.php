<?php

class Question_model extends CI_Model {

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('questions');
	}

	// Return the questions for managing.
	public function get_questions()
	{
		$this->db->select('id,type,question,level');
		$this->db->join('question-types', 'typeid = type', 'LEFT');
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