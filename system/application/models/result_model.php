<?php

class Result_model extends CI_Model {

	/**
	 * Exists
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_users($data = FALSE)
	{
		$this->db->select('accounts.id as id,username,forename,surname,class,year,COUNT(instances.instance_id) as instances');

		$this->db->join('instances','instances.user_id=accounts.id','LEFT');
		
		if(isset($data['school'])&&(strtolower($data['school'])!= 'admin'))
		{
			$this->db->where('school', $data['school']);
		}
		$this->db->group_by('accounts.id');

		$query = $this->db->get('accounts');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return FALSE;
		}
	}

	/**
	 * Get Best Results
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_best_results($data = FALSE)
	{
		$this->db->select('instances.instance_id,instances.user_id as user_id,SUM(correct) as correct,start_time');
		$this->db->join('results','instances.instance_id=results.instance_id');
		$this->db->where('finished',1);
		$this->db->group_by('instances.user_id,instances.instance_id');
		$this->db->order_by('instances.user_id,correct ASC');

		$query = $this->db->get('instances');
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return FALSE;
		}
	}

	/**
	 * Get the last assigned quiz
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_last_assigned($data = FALSE)
	{

		$this->db->select('assign.id as id');
		$this->db->join('accounts','assign.assigned_by=accounts.id');
		$this->db->where('start_date <=',date("Y-m-d"));

		if (strtolower($data['school']) != 'admin')
		{
			$this->db->where('accounts.school',$data['school']);
		}

		$this->db->order_by('end_date DESC');
		$this->db->limit(1);

		$query = $this->db->get('assign');
		
		if($query->num_rows() > 0)
		{
			return $query->row()->id;
		}

		else
		{
			return FALSE;
		}
	}

	/**
	 * Exists
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_last_results($data = FALSE)
	{
		$this->db->select('instances.instance_id,instances.user_id as user_id,SUM(correct) as correct,start_time');
		$this->db->join('results','instances.instance_id=results.instance_id');
		$this->db->where('finished',1);
		$this->db->group_by('instances.user_id,instances.instance_id');
		$this->db->order_by('instances.user_id,instances.start_time ASC');

		$query = $this->db->get('instances');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return FALSE;
		}

	}

	/**
	 * Exists
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_avarages_results($data = FALSE)
	{
		$this->db->select('instances.instance_id,');
		$this->db->join('results','instances.instance_id=results.instance_id');
		$this->db->where('finished',1);
		$this->db->group_by('instances.user_id,instances.instance_id');
		$this->db->order_by('instances.user_id,instances.start_time ASC');

		$query = $this->db->get('instances');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return FALSE;
		}

	}

	/**
	 * Exists
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_assigned_users($data = FALSE)
	{
		//$this->db->select('instances.user_id as user_id,forename,surname,SUM(correct) as correct,count(distinct instances.instance_id) as taken');
		
		$this->db->select('instances.user_id as user_id,forename,surname,question_id,correct,level');
		$this->db->join('results','instances.instance_id=results.instance_id');
		$this->db->join('accounts','instances.user_id=accounts.id');
		$this->db->join('assign','instances.assign_id=assign.id');
		$this->db->join('questions','questions.quiz_id=assign.qid','RIGHT');
		$this->db->where('finished',1);
		$this->db->where('assign_id',$data['assign_id']);
		$this->db->group_by('instances.user_id,forename,surname,question_id,correct');
		$query = $this->db->get('instances');

		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return FALSE;
		}
	}


	/**
	 * Exists
	 *
	 * Finds if the email is already taken. If the password is given,
	 * this will also check if the account's password
	 *
	 * @access	public
	 * @param	string
	 * @param	string	(optional)
	 * @return	boolean
	 */
	public function get_assign_quizzes($data = FALSE)
	{
		//$this->db->select('instances.user_id as user_id,forename,surname,SUM(correct) as correct,count(distinct instances.instance_id) as taken');
		
		$this->db->select('assign.id as assign_id,assign_type,assign,start_date,end_date,count(user_id) as users,count(finished) as finished');
		$this->db->join('instances','assign.id=instances.assign_id');
		if (strtolower($data['school']) != 'admin')
		{
			$this->db->where('school',$data['school']);
		}
		$this->db->group_by('assign.id,assign_type');
		$query = $this->db->get('assign');
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}

		else
		{
			return FALSE;
		}
	}


	/**
	 *
	 *
	 */
	public function get_number_attempts($data = FALSE)
	{
		if (!$data)
		{
			return FALSE;
		}

		$this->db->select('instances.user_id as user_id,SUM(correct) as total,COUNT(DISTINCT instances.instance_id) as attempts');
		$this->db->join('results','results.instance_id=instances.instance_id');
		$this->db->where('finished',1);
		$this->db->where('assign_id',$data['assign_id']);
		$this->db->group_by('instances.user_id');
		$query = $this->db->get('instances');

		if ($query->num_rows() >  0)
		{
			foreach ($query->result() as $row)
			{
				$tmp[$row->user_id]['attempts'] = $row->attempts;
				$tmp[$row->user_id]['total'] = $row->total;
			}

			return $tmp;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 *
	 *
	 */
	public function get_user($data = FALSE)
	{
		if (!$data)
		{
			return FALSE;
		}

		$this->db->select('forename,surname');

		$this->db->where('id',$data);

		$query = $this->db->get('accounts');

		if ($query->num_rows() >  0)
		{
			$row = $query->row(); 

			return $row->forename.' '.$row->surname;
		}
		else
		{
			return FALSE;
		}
	}
}