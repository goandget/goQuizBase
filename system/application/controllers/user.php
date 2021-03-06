<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index
	 *
	 * @access	public
	 * @return	void
	 */
	public function index()
	{
		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}
		$data['type'] = $this->account->get('type');
		$data['school'] = $this->account->get('school');
		$data['forename'] = $this->account->get('forename');
		$data['surname'] = $this->account->get('surname');

		$this->load->view('user/index',$data);
	}

	// --------------------------------------------------------------------

	/**
	 * Register
	 *
	 * @access	public
	 * @return	void
	 */
	public function register()
	{
		if($this->account->logged_in())
		{
			redirect('user');
		}

		$data = array();

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form->set_rules('school', 'school', 'trim|required');
		$this->form->set_rules('forename', 'forename', 'trim|required');
		$this->form->set_rules('surname', 'surname', 'trim|required');
		$this->form->set_rules('username', 'username', 'trim|required');
		$this->form->set_rules('password', 'Password', 'trim|required|matches[confirm]');

		if($this->form->run())
		{
			$this->load->database();
			$this->load->model('account_model');
			
			$data['email']    = $this->input->post('email');
			$data['school'] = $this->input->post('school');
			$data['forename'] = $this->input->post('forename');
			$data['surname'] = $this->input->post('surname');
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['type'] = $this->input->post('type');
			$data['title'] = $this->input->post('title');
			$schooladmin = $this->input->post('schooladmin');

			if($this->account_model->exists(array('email' => $data['email'])))
			{
				$data['error'] = 'That email is already taken.';
			}
			if($this->account_model->exists(array('school' => $data['school']))&&($schooladmin !== ''))
			{
				$data['error'] = 'The school has already been registered.';
			}
			if($this->account_model->exists(array('school' => $data['school'],'username' => $data['username'])))
			{
				$data['error'] = 'That username has already been taken';
			}
			if (!isset($data['error']))
			{
				$this->account_model->create($data);

				$this->account->login($data['username'],$data['school']);

				redirect('user');
			}
		}

		else
		{
			$data['error'] = validation_errors(' ', ' ');
		}

		$this->load->view('user/register', $data);
	}
	// --------------------------------------------------------------------

	/**
	 * Manage
	 *
	 * @access	public
	 * @return	void
	 */

	public function manage()
	{
		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}

		$data = array();
		$this->load->database();
		$this->load->model('account_model');

		$this->load->library('form_validation', NULL, 'form');

        $config['upload_path'] = './uploads/'; // happens to be my test upload path
        $config['allowed_types'] = 'csv';    
        $config['max_size']    = '500'; 

		$this->load->library('upload', $config);

        if ( (! $this->upload->do_upload('file')) && (!$this->input->post('email')))
        {
            $data['error'] = $this->upload->display_errors();
        }
        else if (!$this->input->post('email'))
        {
            // Store the details of the file uploaded.
            $upload = $this->upload->data();
            
            // Load CSV Reader library
            $this->load->library('CSVReader');
            
            // Parse the csv file into the variable users
            $users = $this->csvreader->parse_file($upload['full_path'],True);
            
            //  Load the database and the model for saving users data
		    $this->load->database();
		    $this->load->model('account_model');
		    
		    foreach ($users as $user)
		    {
		    	$data = array();
			    $data['email']    = $user['email'];
			    $school   = $this->account->get('school');
				if (strtolower($school) == 'admin')
			    {
			    	$data['school'] =$user['school'];
			    }
			    else 
			    {
			    	$data['school'] = $school;
			    }
			    $data['forename'] =$user['forename'];
			    $data['surname'] = $user['surname'];
			    $data['username'] = $user['username'];
			    $data['password'] = $user['password'];
			    $data['class'] = $user['class'];
			    $data['year'] = $user['year'];
			    $data['form'] = $user['form'];
			    $data['type'] = $user['type'];
			    $data['title'] = $user['title'];

			    $this->account_model->create($data);
		    }
        }
        else if (empty($_FILES['file']['name']))
        {
        	$data['error'] = 'The filetype you are attempting to upload is not allowed.';
        }
        else {
		
			$this->form->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form->set_rules('school', 'school', 'trim|required');
			$this->form->set_rules('username', 'username', 'trim|required');
			$this->form->set_rules('password', 'Password', 'trim|required|matches[confirm]');
        }
		

		if($this->form->run())
		{
	        $config['upload_path'] = './file/uploads/'; // happens to be my test upload path
	        $config['allowed_types'] = 'csv';    
	        $config['max_size']    = '500'; 
	        
	        $this->load->library('upload', $config);
	    
	        if ( ! $this->upload->do_upload())
	        {
	        	print_r($this->upload->data());
	            echo $this->upload->display_errors();
	            echo 'hell';
	            die;
	        }
	        else
	        {
	            echo $this->upload->display_errors();
	            echo "worked";
	            die;
	        }
			
			$data['email']    = $this->input->post('email');
			$data['school'] = $this->input->post('school');
			if ($this->input->post('schoolnew'))
			{
				$data['school'] = $this->input->post('schoolnew');
			}
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$schooladmin = $this->input->post('schooladmin');

			if($this->account_model->exists(array('email' => $data['email'])))
			{
				$data['error'] = 'That email is already taken.';
			}
			if($this->account_model->exists(array('school' => $data['school'],'username' => $data['username'])))
			{
				$data['error'] = 'That username has already been taken';
			}
			if (!isset($data['error']))
			{
				$this->account_model->create($data);

				$this->account->login($data['username'],$data['school']);

				redirect('user/manage');
			}
		}

		else
		{
			$data['error'] = validation_errors(' ', ' ');
		}
		$school   = $this->account->get('school');
		if (strtolower($school) == 'admin')
		{
			$data['users'] = $this->account_model->get_users('');
			$data['admin'] = 1;
			if ($tmp = $this->account_model->get_schools())
			{
				$k = array(''=>'--Select a School--');
				foreach ($tmp as $tmp_school)	{
					$k[$tmp_school->school] = $tmp_school->school;
				}
				$data['school'] = $k;
			}
		}
		else
		{
			$data['users'] = $this->account_model->get_users($school);
			$data['school'] = $school;
		}

		if ($this->uri->segment(3) !== FALSE)
		{
			// Report back if the action was successful or failed.
			$data['error'] = 'The '.ucfirst($this->uri->segment(3)).' was '.ucfirst($this->uri->segment(4));
		}

		$this->load->view('user/manage', $data);

	}
	// --------------------------------------------------------------------

	/**
	 * Manage
	 *
	 * @access	public
	 * @return	void
	 */

	public function bulk_upload()
	{
		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}

		$data = array();
		$this->load->database();
		$this->load->model('account_model');

		$this->load->library('form_validation', NULL, 'form');

        $config['upload_path'] = './uploads/'; // happens to be my test upload path
        $config['allowed_types'] = 'csv';    
        $config['max_size']    = '500'; 

		$this->load->library('upload', $config);

        if ( (! $this->upload->do_upload('file')) && (!$this->input->post('email')))
        {
            $data['error'] = $this->upload->display_errors();
        }
        else if (empty($_FILES['file']['name']))
        {
        	$data['error'] = 'The filetype you are attempting to upload is not allowed.';
        }
        else
        {
            // Store the details of the file uploaded.
            $upload = $this->upload->data();
            
            // Load CSV Reader library
            $this->load->library('CSVReader');
            
            // Parse the csv file into the variable users
            $users = $this->csvreader->parse_file($upload['full_path'],True);
            
            //  Load the database and the model for saving users data
		    $this->load->database();
		    $this->load->model('account_model');
			
			$error = array();
		    
		    foreach ($users as $user)
		    {
		    	$data = array();
			    $data['email']    = $user['email'];
			    $school   = $this->account->get('school');
				if (strtolower($school) == 'admin')
			    {
			    	$data['school'] =$user['school'];
			    }
			    else 
			    {
			    	$data['school'] = $school;
			    }
			    $data['forename'] =$user['forename'];
			    $data['surname'] = $user['surname'];
			    $data['username'] = $user['username'];
			    $data['password'] = $user['password'];
			    $data['class'] = $user['class'];
			    $data['year'] = $user['year'];
			    $data['form'] = $user['form'];
			    $data['type'] = $user['type'];
			    $data['title'] = $user['title'];

			    // Check to see if any of required fields are empty
			    $tmpArray = array();
			    foreach (key($data) as $k)
			    {
			    	if  (in_array($k,$validate) && isset($data[$k]))
			    	{
			    		$tmpArray[] = 'There was no '.ucfirst($k).' included.';

			    	}
			    }

			    if (count($tmpArray) > 0)
			    {
			    	$error[] = array('pupil'=>$data['forename'].' '.$data['surname'],'errors'=>$tmpArray);
			    }

			    $this->account_model->create($data);
		    }
        }
		
		if (isset($error) && count($error) > 0)
		{
			$data['error'] = $error;
		}

		if($this->form->run())
		{
	        $config['upload_path'] = './file/uploads/'; // happens to be my test upload path
	        $config['allowed_types'] = 'csv';    
	        $config['max_size']    = '500'; 
	        
	        $this->load->library('upload', $config);
	    
	        if ( ! $this->upload->do_upload())
	        {
	        	print_r($this->upload->data());
	            echo $this->upload->display_errors();
	            echo 'hell';
	            die;
	        }
	        else
	        {
	            echo $this->upload->display_errors();
	            echo "worked";
	            die;
	        }
			
			$data['email']    = $this->input->post('email');
			$data['school'] = $this->input->post('school');
			if ($this->input->post('schoolnew'))
			{
				$data['school'] = $this->input->post('schoolnew');
			}
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$schooladmin = $this->input->post('schooladmin');

			if($this->account_model->exists(array('email' => $data['email'])))
			{
				$data['error'] = 'That email is already taken.';
			}
			if($this->account_model->exists(array('school' => $data['school'],'username' => $data['username'])))
			{
				$data['error'] = 'That username has already been taken';
			}
			if (!isset($data['error']))
			{
				$this->account_model->create($data);

				$this->account->login($data['username'],$data['school']);

				redirect('user/manage');
			}
		}

		else
		{
			$data['error'] = validation_errors(' ', ' ');
		}
		$school   = $this->account->get('school');
		if (strtolower($school) == 'admin')
		{
			if ($tmp = $this->account_model->get_schools())
			{
				$k = array(''=>'--Select a School--');
				foreach ($tmp as $tmp_school)	{
					$k[$tmp_school->school] = $tmp_school->school;
				}
				$data['school'] = $k;
			}
		}
		else
		{
			$data['users'] = $this->account_model->get_users($school);
			$data['school'] = $school;
		}
        
        $this->load->view('user/bulk_upload', $data);


	}
	// --------------------------------------------------------------------

	/**
	 * Delete User
	 *
	 * @access	public
	 * @return	void
	 */
	public function delete()
	{
		 if ($this->uri->segment(3) !== FALSE)
		 {
			$id = $this->uri->segment(3);

			$this->load->database();
			$this->load->model('account_model');

			if ($this->account_model->delete_user($id))
			{
				redirect('user/manage/delete/success');
			}
			else
			{
				redirect('user/manage/delete/unsuccessful');
			}

		 }

	}
	// --------------------------------------------------------------------

	/**
	 * Login
	 *
	 * @access	public
	 * @return	void
	 */
	public function login()
	{
		if($this->account->logged_in())
		{
			redirect('user');
		}

		$error = '';
		$data = array();

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('school', 'school', 'trim|required');
		$this->form->set_rules('username', 'username', 'trim|required');
		$this->form->set_rules('password', 'Password', 'trim|required');

		if($this->form->run())
		{
			$this->load->database();
			$this->load->model('account_model');

			$data['school']    = $this->input->post('school');
			$data['username']    = $this->input->post('username');
			$data['password'] = $this->input->post('password');

			if($this->account_model->exists(array('username' => $data['username'], 'password' => $data['password'], 'school' => $data['school'])))
			{
				$this->account->login($data['username'],$data['school']);

				redirect('user');
			}
			else
			{
				$data['error'] = 'Invalid username/password.';
			}
		}
		else
		{
			if ($this->input->post('school'))
			{
				$data['error'] = validation_errors(' ', ' ');
				$data['school'] = $this->input->post('school');
			}
			else
			{
				$this->load->database();
				$this->load->model('account_model');
				if ($tmp = $this->account_model->get_schools())
				{
					$k = array();
					foreach ($tmp as $tmp_school)	{
						$k[$tmp_school->school] = $tmp_school->school;
					}
					$data['school'] = $k;
				}
				else
				{
					$data['school'] = 'No Schools Available';
				}
				$data['error'] = validation_errors(' ', ' ');
			}
		}

		$this->load->view('user/login', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Logout
	 *
	 * @access	public
	 * @return	void
	 */
	public function logout()
	{
		$this->session->sess_destroy();

		redirect('user/login');
	}

}
