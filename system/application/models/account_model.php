<?php

class Account_model extends CI_Model {

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
	public function exists($data = FALSE)
	{
		if(isset($data['username']))
		{
			$this->db->where('username', $data['username']);
		}
		if(isset($data['password']))
		{
			$password = $this->encrypt_password($data['username'], $data['password']);

			$this->db->where('password', $password);
		}
		if(isset($data['school']))
		{
			$this->db->where('school', $data['school']);
		}
		if(isset($data['email']))
		{
			$this->db->where('email', $data['email']);
		}

		return ($this->db->count_all_results('accounts') > 0);
	}

	// --------------------------------------------------------------------

	/**
	 * Create
	 *
	 * Creates an account
	 *
	 * @access	public
	 * @access	array
	 * @return	void
	 */
	public function create($data)
	{
		$account = array(
			'email'      => $data['email'],
			'school'     => $data['school'],
			'forename'   => $data['forename'],
			'surname'   => $data['surname'],
			'username'   => $data['username'],
			'class'   => $data['class'],
			'form'   => $data['form'],
			'year'   => $data['year'],
			'title'   => $data['title'],
			'type'   => $data['type'],
			'password'   => $this->encrypt_password($data['username'], $data['password']),
			'ip_address' => $this->input->ip_address()
		);

		$this->db->insert('accounts', $account);
	}

	// --------------------------------------------------------------------

	/**
	 * Get by Email
	 *
	 * Gets an account's info by using the email
	 *
	 * @access	public
	 * @access	string
	 * @return	array
	 */
	public function get_by_username($username)
	{
		$this->db->where('username', $username);

		$query = $this->db->get('accounts');

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
	 * Get Schools
	 *
	 * Gets the schools available
	 *
	 * @access	public
	 * @return	array
	 */
	public function get_schools()
	{
		$this->db->select('school');
		$this->db->group_by("school"); 
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

	// --------------------------------------------------------------------

	/**
	 * Delete User
	 *
	 * Gets the schools available
	 *
	 * @access	public
	 * @return	array
	 */
	public function delete_user($id)
	{
		if($this->db->delete('accounts', array('id' => $id)))
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
	 * Edit User
	 *
	 * Gets the schools available
	 *
	 * @access	public
	 * @return	array
	 */
	public function edit_user($id)
	{
		if($this->db->delete('accounts', array('id' => $id)))
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
	 * Get Users
	 *
	 * Gets the users for the school
	 *
	 * @access	public
	 * @return	array
	 */
	public function get_users($school)
	{
		$this->db->select('forename,surname,class,id,username');
		if ($school != '')
		{
			$this->db->where("school",$school); 
		}
		//$this->db->join ('classes','classes.uid=accounts.id', 'left');
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

	// --------------------------------------------------------------------

	/**
	 * Encrypt Password
	 *
	 * Encrypts the password using both the username and the password. Super
	 * secret stuffz, ya?
	 *
	 * @access	private
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	private function encrypt_password($username, $password)
	{
		return sha1($username . ':' . $password);
	}
}