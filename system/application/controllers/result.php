<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends CI_Controller {

	/**
	 * Index
	 *
	 * @access	public
	 * @return	void
	 */
	public function index()
	{
		// Check that the user is logged in
		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}
		// Set any variables needed later.
		$data['error'] = ''; // Create the variable for errors
		$data['school'] = $this->account->get('school'); // Get the current users school

		// Create Connection to the Database
		$this->load->database();
		// Load any Models Needed
		$this->load->model('result_model');

		// Get the Current Users school 
		$qry_data['school'] = $this->account->get('school');

		// Apply any Filters or Sort sent
		if( ! $this->uri->segment(2)) {
			$qry_data[$this->uri->segment(2)] = $this->uri->segment(3,'%');
		}
		if( ! $this->uri->segment(4)) {
			$qry_data[$this->uri->segment(4)] = $this->uri->segment(5,'%');
		}
		$data['assign_id']	= $this->result_model->get_last_assigned($qry_data);
		$qry_data['assign_id'] = $data['assign_id'];
		$data['users'] 			= $this->result_model->get_assigned_users($qry_data);
		$data_sort['bests'] 	= $this->result_model->get_best_results($qry_data);
		$data_sort['lasts'] 	= $this->result_model->get_last_results($qry_data);
		$data_sort['averages'] 	= $this->result_model->get_avarages_results($qry_data);
		

		// Sort the data to enable easy formatting in view 
		foreach ($data_sort as $k => $v)
		{
			if (is_array($v)) {
				foreach ($v as $i)
				{
					$data[$k][$i->user_id] = $i;
				}
			}
			else
			{
				$data[$k] = TRUE;
			}
		}
		// Display the Results
		$this->load->view('result/index',$data);
	}

	/**
	 * Index
	 *
	 * @access	public
	 * @return	void
	 */
	public function overview()
	{
		// Check that the user is logged in
		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}
		// Set any variables needed later.
		$data['error'] = ''; // Create the variable for errors
		$data['school'] = $this->account->get('school'); // Get the current users school

		// Create Connection to the Database
		$this->load->database();
		// Load any Models Needed
		$this->load->model('result_model');

		// Get the Current Users school 
		$qry_data['school'] = $this->account->get('school');

		// Apply any Filters or Sort sent
		if( ! $this->uri->segment(2)) {
			$qry_data[$this->uri->segment(2)] = $this->uri->segment(3,'%');
		}
		if( ! $this->uri->segment(4)) {
			$qry_data[$this->uri->segment(4)] = $this->uri->segment(5,'%');
		}
		
		$data['users'] 			= $this->result_model->get_users($qry_data);
		$data_sort['bests'] 	= $this->result_model->get_best_results($qry_data);
		$data_sort['lasts'] 	= $this->result_model->get_last_results($qry_data);
		$data_sort['averages'] 	= $this->result_model->get_avarages_results($qry_data);
		
		
		// Sort the data to enable easy formatting in view 
		foreach ($data_sort as $k => $v)
		{
			if (is_array($v)) {
				foreach ($v as $i)
				{
					$data[$k][$i->user_id] = $i;
				}
			}
			else
			{
				$data[$k] = TRUE;
			}
		}
		// Display the Results
		$this->load->view('result/overall',$data);
	}
}