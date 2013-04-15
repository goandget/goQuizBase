<?php

class Quiz_model extends CI_Model {

	/**
	 * Create
	 *
	 * Creates a new Quiz and returns the quiz's  ID
	 *
	 * @access	public
	 * @param	int
	 * @param	string
	 * @return	int
	 */
	public function create($author_id, $name)
	{
		$data = compact('author_id', 'name');

		$this->db->insert('quizzes', $data);

		return $this->db->insert_id();
	}

	// --------------------------------------------------------------------

	/**
	 * Get
	 *
	 * Returns a single quiz by its ID 
	 *
	 * @access	public
	 * @access	string
	 * @return	array
	 */
	public function get()
	{
		$this->db->select('quizzes.*, COUNT(questions.id) AS questions');
		$this->db->join('questions', 'questions.id = quizzes.id', 'LEFT');
		$this->db->where('quizzes.id', '1');

		$query = $this->db->get('quizzes', 1);
		
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}

		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get By Email
	 *
	 * Returns an array of all the quizzes created by the user
	 *
	 * @access	public
	 * @access	string
	 * @return	array
	 */
	public function get_by_id($id)
	{
		$this->db->select('quizzes.id, quizzes.name');
		$this->db->where('author_id', $id);
		$query = $this->db->get('quizzes');

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
	 * Get Questions
	 *
	 * @access	public
	 * @param	int
	 * @param	int
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function get_questions($start = 0,$id = 1)
	{

		$this->db->limit(1,$start);

		$this->db->where('quiz_id', $id);

		$query = $this->db->get('questions');
		
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get Question Information
	 *
	 * @access	public
	 * @param	int
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function get_question($id = 1)
	{

		$this->db->where('id', $id);

		$query = $this->db->get('questions');
		
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get Question Information
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function check_freetext_answer($qid,$answer)
	{
		$this->db->where('answer', $answer);
		$this->db->where('question_id', $qid);
		$query = $this->db->get('answers');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get Question Information
	 *
	 * @access	public
	 * @param	array
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function check_multiplechoice_answer($qid,$answer)
	{
		$this->db->where('id', $answer);
		$this->db->where('question_id', $qid);
		$this->db->where('correct', TRUE);
		$query = $this->db->get('answers');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
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
	 * Get Display Results
	 *
	 * @access	public
	 * @param	int
	 * @param	int
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function get_results($instance = FALSE,$start = FALSE)
	{
		$this->db->select('start_time,question,image,type,correct,recorded,answer');
		$this->db->join('questions','results.question_id=questions.id','right');
		$this->db->join('instances','instances.instance_id=results.instance_id');
		$this->db->where('instances.instance_id', $instance);
		if ($start)	
		{
			$this->db->limit(1,$start-10);
		}
		$query = $this->db->get('results');
		
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
	 * Get Display Results
	 *
	 * @access	public
	 * @param	int
	 * @param	int
	 * @return	array
	 */
	//public function get_questions($id, $override_limit = FALSE)
	public function get_users_answers($answer = FALSE,$correct = False)
	{
		if ($correct)
		{
			$this->db->select('answer,image,correct');
		}
		else
		{
			$this->db->select('answer,image');
		}
		$this->db->where('id', $answer);
		
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
	 * Update
	 *
	 * Updates the quiz with the given ID
	 *
	 * @access	public
	 * @param	int
	 * @param	array
	 * @return	void
	 */
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->update('quizzes', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * Deletes the quiz with the given ID
	 *
	 * @access	public
	 * @access	int
	 * @return	void
	 */
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('quizzes');
	}

	// --------------------------------------------------------------------

	/**
	 * Record Answer
	 *
	 * DRecord the answer
	 *
	 * @access	public
	 * @access	int
	 * @return	void
	 */
	public function record_answer($answer)
	{
		if ($this->db->insert('results',$answer))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Create an instance
	 *
	 * DRecord the answer
	 *
	 * @access	public
	 * @access	int
	 * @return	void
	 */
	public function set_instance($data)
	{
		if ($this->db->insert('instances',$data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return FALSE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Create an instance
	 *
	 * DRecord the answer
	 *
	 * @access	public
	 * @access	int
	 * @return	void
	 */
	public function instance_finish($data)
	{
		$this->db->where('instance_id',$data);
		if ($this->db->update('instances',array('finished' => 1)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}