<?php

class Account {

	private $session;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		$this->session = get_instance()->session;
	}

	// --------------------------------------------------------------------

	/**
	 * Logged in
	 *
	 * Verifies if the current user is logged in
	 *
	 * @access	public
	 * @return	void
	 */
	public function logged_in()
	{
		return $this->session->userdata('logged_in');
	}

	// --------------------------------------------------------------------

	/**
	 * Login
	 *
	 * Logs the user in with the given email
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function login($username,$school)
	{
		$data = get_instance()->account_model->get_by_username($username,$school);

		$data['logged_in'] = TRUE;
		$data['username']     = $username;
		$data['school']     = $school;

		foreach($data as $key => $value)
		{
			if ($key == 'class' && $type == 1)
			{
				$value = '#class_teacher#';
			}
			$this->session->set_userdata($key, $value);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Get
	 *
	 * Gets information specific to the logged in user
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	 public function get($key)
	 {
	 	if( ! ($value = $this->session->userdata($key)))
		{
			show_error('Cannot find user data: ' . $key);
		}

		return $value;
	 }

	// --------------------------------------------------------------------

	/**
	 * Give Access
	 *
	 * Grants the account access to a quiz
	 *
	 * @access	public
	 * @param	int
	 * @return 	void
	 */
	public function give_access($quiz_id)
	{
		$this->session->set_userdata('can_access_quiz_' . $quiz_id, TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Can Access
	 *
	 * Verifies if the account has access to a quiz
	 *
	 * @access	public
	 * @return 	void
	 */
	public function can_access()
	{
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Quiz Instance
	 *
	 * Get the instance of the current users quiz.
	 *
	 * @access	public
	 * @param	int
	 * @return 	void
	 */
	public function get_instance()
	{
		if( ! ($value = $this->session->userdata('instance')))
		{
			return FALSE;
		}
		else
		{
			return $value;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set Quiz Instance
	 *
	 * Get the instance of the current users quiz.
	 *
	 * @access	public
	 * @param	int
	 * @return 	void
	 */
	public function set_instance($id)
	{
		$this->session->set_userdata('instance',$id);
	}
}