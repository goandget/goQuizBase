<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {

	/**
	 * Types
	 *
	 * @var	array
	*/
	public $types = array(
		'free response',
		'multiple choice'
	);

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
		$this->load->model('quiz_model');
	}

	// --------------------------------------------------------------------

	/**
	 * Index
	 *
	 * @access	public
	 * @return	void
	 */
	public function index()
	{
		$id   = $this->account->get('id');
		$quizzes = $this->quiz_model->get_by_id($id);

		$this->load->view('quiz/index', compact('quizzes'));
	}

	// --------------------------------------------------------------------

	/**
	 * Create
	 *
	 * @access	public
	 * @return	void
	 */
	public function create()
	{
		$error = '';

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('name', 'Name', 'trim|required|xss_clean');

		if($this->form->run())
		{
			$id   = $this->account->get('id');
			$name = $this->input->post('name');

			$quiz_id = $this->quiz_model->create($id, $name);

			redirect('quiz/edit/' . $quiz_id);
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('quiz/create', compact('error'));
	}

	// --------------------------------------------------------------------

	/**
	 * Edit
	 *
	 * @access	public
	 * @return	void
	 */
	public function edit()
	{
		if( ! ($id = $this->uri->segment(3)) || ! is_numeric($id))
		{
			redirect('quiz');
		}

		// Start building the Quiz's data
		$data = $this->quiz_model->get($id);

		$data['error']     = '';
		$data['questions'] = $this->quiz_model->get_questions($id, $data['max_questions']);

		// Build the choices for the Max Displayed Questions field
		$questions = count($data['questions']);

		$data['options'][-1] = 'Show all Questions';

		$i = 1;

		while($questions >= $i)
		{
			$data['options'][$i] = 'Only show ' . $i . ' question(s)';

			$i++;
		}

		// Form validation
		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form->set_rules('password', 'Password', 'trim|xss_clean');
		$this->form->set_rules('max_questions', 'Max Displayed Questions', 'trim|required|numeric');
		$this->form->set_rules('order', 'Max Displayed Questions', 'trim|required');
		$this->form->set_rules('max_questions', 'Max Displayed Questions', 'trim|required');

		if($this->form->run())
		{
			// Update the quiz
			$this->quiz_model->update($id, array(
				'name'			=> $this->input->post('name'),
				'password'		=> $this->input->post('password'),
				'max_questions' => $this->input->post('max_questions'),
			));
		}

		else
		{
			$data['error'] = validation_errors(' ', ' ');
		}

		// Since we're messing a lot with the data here, we manually
		// repopulate the form
		if($this->input->post('edit'))
		{
			$data['name']          = $this->input->post('name');
			$data['password']      = $this->input->post('password');
			$data['max_questions'] = $this->input->post('max_questions');
		}

		$this->load->helper('edit_quiz');
		$this->load->view('quiz/edit', $data);
	}

	// --------------------------------------------------------------------

	/* *
	 * Enter
	 *
	 * @access	public
	 * @return	void
	 * 
	public function enter()
	{
		$error = '';

		$this->load->library('form_validation', NULL, 'form');

		$this->form->set_rules('id', 'Quiz ID', 'required|numeric');

		if($this->form->run())
		{
			$id       = $this->input->post('id');
			$password = $this->input->post('password');

			$this->db->where('id', $id);

			if( ! empty($password))
			{
				$this->db->where('password', $password);
				$this->db->or_where('password', NULL);
			}

			else
			{
				$this->db->where('password', NULL);
			}

			if($this->db->count_all_results('quizzes') > 0)
			{
				$this->account->give_access($id);

				redirect('quiz/take/' . $id);
			}
		}

		else
		{
			$error = validation_errors(' ', ' ');
		}

		$this->load->view('quiz/enter', compact('error'));
	}
	*/
	// --------------------------------------------------------------------

	/**
	 * Enter
	 *
	 * @access	public
	 * @return	void
	 */
	public function enter()
	{
		$id   = $this->account->get('id');
		$quizzes = $this->quiz_model->get_by_id($id);

		$this->load->view('quiz/enter', $quizzes);
	}



	// --------------------------------------------------------------------

	/**
	 * Take
	 *
	 * @access	public
	 * @return	void
	 */
	public function take()
	{
		/*
		if( ! ($id = $this->uri->segment(3)) || ! is_numeric($id))
		{
			redirect('quiz');
		}
		*/
		// Load relevant helpers
		$this->load->helper('form');
		$this->load->helper('my_general');
		$error = '';

		// We a valid quiz ID

		if( ! $this->account->can_access())
		{
			redirect('user');
		}
		if (! $this->account->get_instance())
		{
			$data['user_id'] = $this->account->get('id');

			$id = $this->quiz_model->set_instance($data);
			$this->account->set_instance($id);
		}
		
		
		// Get the global question information
		$data['answer'] = $this->input->post('answer');
		$data['finish'] = $this->input->post('finish');
		$data['next'] = $this->input->post('next');
		$data['result'] = $this->input->post('result');
		$data['question_id'] = $this->input->post('question_id');

		if  (!$start = $this->input->post('start'))	{
			$start = 0;
		}

		if(($data['finish']!='')||($data['next']!=''))
		{
			if (isset($data['answer']))
			{
				$answer['instance_id'] = $this->account->get_instance();
				$answer['user_id'] = $this->account->get('id');
				$answer['answer'] = $data['answer'];
				$answer['question_id'] = $data['question_id'];
				$answer['correct'] = $this->check_answer($data['question_id'],$data['answer']);
				if (is_array($answer['answer']))
				{
					$answer['answer']= implode('|#|',$data['answer']);
				}
				if (!$this->quiz_model->record_answer($answer))
				{
					$start = $start - 1;
					$error = 'There was an error recording your answer please try again.';
				}
			}
			else
			{
				$start = $start - 1;
				$error = 'You must answer the question before you can continue.';
			}

		}



		// Start building the Quiz's data
		$question = $this->quiz_model->get();
		$question['error']    = $error;
		//$data['questions'] = $this->quiz_model->get_questions($id, $data['max_questions']);
		$question['questions'] = $this->quiz_model->get_questions($start);
		
		$question['answers'] = $this->quiz_model->get_answers($question['questions']['id']);
		// Shuffle the array so that it is no longer in order
		if (is_array($question['answers'])&&(strlen($question['answers'][0]->answer) > 1)) {
			shuffle($question['answers']);
		}

		// Current Question Number
		$question['current'] = $start+1;
		// Next Question Number if it isn't that last question
		if ($this->quiz_model->get_questions($start+1)) {
			$question['next'] = $start + 1;
		}

		if ($data['finish']!='')	{
			$question['results'] = $this->quiz_model->get_results($this->account->get_instance());
			$this->quiz_model->instance_finish($this->account->get_instance());
			$this->account->set_instance(FALSE);
			$question['finish'] = TRUE;
			$question['start'] = 1;
			$this->load->view('quiz/result', $question);
		}
		else if (($start > 0)&&($start %10 == 0)&&(!isset($data['result'])))
		{
			$question['start'] = $start;
			$question['results'] = $this->quiz_model->get_results($this->account->get_instance(),$start);
			$this->load->view('quiz/result', $question);
		}
		else {
			$this->load->view('quiz/take', $question);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * @access	public
	 * @return	void
	 */
	public function delete()
	{
		$id = $this->uri->segment(3);

		$this->quiz_model->delete($id);

		redirect('quiz');
	}

	// --------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * @access	public
	 * @return	void
	 */
	public function answer()
	{
		// Answer ID
		$id = $this->uri->segment(3);
		
		// Users Quiz Instance 
		$instance = $this->account->get('instance');

		//$this->quiz_model->delete($id);

		//redirect('quiz');
	}

	// --------------------------------------------------------------------

	/**
	 * Check Answer is Correct
	 *
	 * @access	public
	 * @param 	array
	 * @return	void
	 */
	private function check_answer($qid,$answer)
	{

		$question =	$this->quiz_model->get_question($qid);
		if ($question['type'] == 1)
		{
			return $this->quiz_model->check_freetext_answer($qid,$answer);
		}
		else if ($question['type'] == 2)
		{
			return $this->quiz_model->check_multiplechoice_answer($qid,$answer);
		}
		else if ($question['type'] == 3)
		{
			foreach ($answer as $a)
			{
				if (!$this->quiz_model->check_multiplechoice_answer($qid,$a))
				{
					return FALSE;
				}
			}
			return TRUE;
			//return $this->quiz_model->check_multiplechoice_answer($qid,$answer);
		}

	}

	// --------------------------------------------------------------------

	/**
	 * Display the Results either so far or complete results
	 *
	 * @access	public
	 * @param 	int
	 * @return	void
	 */
	private function get_results($instance)
	{

		$question =	$this->quiz_model->get_results($instance);

	}
}
