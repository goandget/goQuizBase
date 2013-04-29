<?php

class Question_model extends CI_Model {

	public function delete($id)
	{
		// Delete the Question
		$this->db->where('id', $id);
		$this->db->limit(1);
		if ($this->db->delete('questions'))
		{
			$return = True;
		}

		// Delete the Answers Connected to this question.
		$this->db->where('question_id',$id);
		if($this->db->delete('answers') && $return)
		{
		
			return True;
		}
		else
		{
			return False;
		}

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

	// --------------------------------------------------------------------

	/**
	 * Get Answers
	 *
	 * @access	public
	 * @param	int
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function get_answers($id = 1)
	{

		$this->db->where('question_id', $id);

		$query = $this->db->get('answers');
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Update Question
	 *
	 * @access	public
	 * @param	int
	 * @param 	string
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function update_question($id,$value = False)
	{

		if ($value)
		{
			$data = array('question'=>$value,'updated'=>date('Y-m-d H:i:s'));

			$this->db->where('id', $id);
			
			if($this->db->update('questions',$data))
			{
				return True;
			}
			else
			{
				return False;
			}

		}
	}

	// --------------------------------------------------------------------

	/**
	 * Update Answer
	 *
	 * @access	public
	 * @param	int
	 * @param 	string
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function update_answer($id,$value = False)
	{

		if ($value)
		{
			$data = array('answer'=>$value);

			$this->db->where('id', $id);
			
			if($this->db->update('answers',$data))
			{
				return True;
			}
			else
			{
				return False;
			}

		}
	}

	// --------------------------------------------------------------------

	/**
	 * Update Answer
	 *
	 * @access	public
	 * @param	int
	 * @param 	string
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function update_correct_answer($id,$value = False)
	{

		if ($id)
		{
			$data = array('correct'=>$value);

			$this->db->where('id', $id);
			
			if($this->db->update('answers',$data))
			{
				return True;
			}
			else
			{
				return False;
			}

		}
	}

	// --------------------------------------------------------------------

	/**
	 * Update Level of Question
	 *
	 * @access	public
	 * @param	int
	 * @param 	string
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function update_level($id,$value = False)
	{

		if ($value)
		{
			$data = array('level'=>$value,'updated'=>'now()');

			$this->db->where('id', $id);
			
			if($this->db->update('questions',$data))
			{
				return True;
			}
			else
			{
				return False;
			}

		}
	}


}