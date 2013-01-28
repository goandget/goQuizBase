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
		$this->db->select('instances.user_id as user_id,SUM(correct) as correct,count(distinct instances.instance_id) as taken');
		$this->db->join('results','instances.instance_id=results.instance_id');
		$this->db->where('finished',1);
		$this->db->group_by('instances.user_id');
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
}