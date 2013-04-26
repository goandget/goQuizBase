<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends CI_Controller {

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();

		if( ! $this->account->logged_in())
		{
			redirect('user/login');
		}

		$this->load->database();
		$this->load->model('question_model'); // Load the Question Models
	}

	// --------------------------------------------------------------------

	/**
	 * Manage all the Questions
	 *
	 * @access public
	 * @return void
	 *
	 */
	public function manage()
	{
		// Load the libraries and Models
		$this->load->library('form_validation', NULL, 'form'); // Load Form Validation

		$questions = $this->question_model->get_questions();

		$this->load->view('questions/manage-header');

		foreach ($questions as $q)
		{
			$ans['q'] = $q;
			$ans['qid'] = $q->id;
			$ans['answers'] = $this->question_model->get_answers($q->id);
			$this->load->view('questions/manage/q'.$q->type,$ans);
		}

		$this->load->view('questions/manage-footer');

	}

	// --------------------------------------------------------------------

	/**
	 * Add Question
	 *
	 * @access	public
	 * @return	void
	 */
	public function add_questions()
	{

		$error = '';
		$types = array();

		// Generate the possible types
		$types[] = '-- SELECT TYPE --';

		foreach($this->types as $type)
		{
			$types[] = ucwords($type);
		}

		$this->load->library('form_validation', NULL, 'form');
		$this->load->helper('add_question');

		$this->form->set_rules('question', 'Question', 'required|xss_clean');
		$this->form->set_rules('type', 'Type', 'required|numeric');

		if($this->form->run())
		{
			$error = $this->_add_question();

			if(empty($error))
			{
				redirect('quiz/edit/' . $id);
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('questions/add_question', compact('id', 'error', 'types'));
	}

	// --------------------------------------------------------------------

	/**
	 * Add Question
	 *
	 * @access	public
	 * @return	void
	 */
	public function add_question()
	{
		if( ! ($id = $this->uri->segment(3)) || ! is_numeric($id))
		{
			redirect('quiz');
		}

		$error = '';
		$types = array();

		// Generate the possible types
		$types[] = '-- SELECT TYPE --';

		foreach($this->types as $type)
		{
			$types[] = ucwords($type);
		}

		$this->load->library('form_validation', NULL, 'form');
		$this->load->helper('add_question');

		$this->form->set_rules('question', 'Question', 'required|xss_clean');
		$this->form->set_rules('type', 'Type', 'required|numeric');

		if($this->form->run())
		{
			$error = $this->_add_question();

			if(empty($error))
			{
				redirect('quiz/edit/' . $id);
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('quiz/add_question', compact('id', 'error', 'types'));
	}

	// --------------------------------------------------------------------

	/**
	 * Add Question
	 *
	 * Handles the form validation and actual adding of questions
	 * to the database.
	 *
	 * @access	public
	 * @return	string
	 */
	public function _add_question()
	{
		// Get the global question information
		$data['quiz_id']  = $this->uri->segment(3);
		$data['question'] = $this->input->post('question');
		$data['type']     = $this->input->post('type');

		// Check that a valid type was given
		if( ! in_array($data['type'], array(1, 2)))
		{
			return 'You must select a valid question type.';
		}

		// Free response
		if($data['type'] == 1)
		{
			$data['answer'] = $this->input->post('free_response_answer');
		}

		// Multiple choice
		if($data['type'] == 2)
		{
			$answers = $this->input->post('multiple_choice_answers');
			$answers = explode("\n", $answers);

			// Get all the non-blank answers
			foreach($answers as $answer)
			{
				$answer = trim($answer);

				if( ! empty($answer))
				{
					$data['answers'][] = $answer;
				}
			}

			// The answer to the question is the first answer
			$answer = $data['answers'][0];

			// Shuffle the array so that it is no longer in order
			shuffle($data['answers']);

			// Now get the answer's new location
			$data['answer'] = array_search($answer, $data['answers']);

			// Serialize the answers to get them database ready
			$data['answers'] = serialize($data['answers']);
		}

		// Now insert the data to the database
		$this->db->insert('questions', $data);
	}


	/**
	 * Update Questions Details
	 *
	 * @access	public
	 * @return	void
	 */
	public function update($type = False,$data = false,$ajax = false)
	{
		if ($this->input->post('type'))
		{
			$type = $this->input->post('type');
		}
		else {
			$type = False;
		}

		if ($this->input->post('data'))
		{
			$array = explode('#',$this->input->post('data'));
			$data['id'] = $array[1];
			$data['value'] = $array[0];
			unset($array);

		}
		else
		{
			$data = False;
		}

		if ($this->input->post('ajax'))
		{
			$ajax = $this->input->post('ajax');
		}
		else
		{
			$ajax = False;
		}

		
		if ($type && $data)
		{
			$this->load->model('question_model');
			switch ($type):
				case "level":
					$result = $this->question_model->update_level($data['id'],$data['value']);
					break;
				case "qpicture":
					$result = $this->question_model->update_question_picture($data['id'],$data['value']);
					break;
				case "question":
					$result = $this->question_model->update_question($data['id'],$data['value']);
					break;
				case "full":
					$result = $this->question_model->update_question($data);
					break;
				default:
					$result = $this->question_model->update_question($data);
			endswitch;
			
			if ($ajax)
			{
				if ($result)
				{	
					$result = array();
					$result['title'] = 'Success';
					$result['message'] = 'The question was updated succesfully';
					$result['type'] = 'success';
				}
				else
				{
					$result = array();
					$result['title'] = 'Error';
					$result['message'] = 'There was an error updating the question';
					$result['type'] = 'error';
				}
				$this->load->view('questions/ajax', array('result' => $result));
			}
			else
			{
				redirect('questions/manage/'.$result);
			}
		}


	}

	/**
	 * Delete Questions Details
	 *
	 * @access	public
	 * @return	void
	 */
	public function delete($type=False,$id=False,$ajax = False)
	{
		if ($this->input->post('type'))
		{
			$type = $this->input->post('type');
		}

		if ($this->input->post('id'))
		{
			$id = $this->input->post('id');
		}

		if ($this->input->post('ajax'))
		{
			$ajax = $this->input->post('ajax');
		}

		if ($type && $id)
		{

			$this->load->model('question_model');

			$result = $this->question_model->delete($id);

		}

		if ($ajax)
		{
				if ($result)
				{	
					$result = array();
					$result['title'] = 'Success';
					$result['message'] = 'The question was updated succesfully';
					$result['type'] = 'success';
				}
				else
				{
					$result = array();
					$result['title'] = 'Error';
					$result['message'] = 'There was an error updating the question';
					$result['type'] = 'error';
				}
				$this->load->view('questions/ajax', array('result' => $result));
		}
		else
		{
			redirect('questions/manage/'.$result);
		}
	}
}
