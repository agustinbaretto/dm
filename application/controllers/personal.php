<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {
	
	public function index()
	{
		$this->load->view('templates/headerPersonal');
		$this->load->view('pages/me');
		$this->load->view('templates/footer');
	}
	
	public function blog()
	{
		$this->load->view('templates/headerPersonal');
		$this->load->view('pages/blog');
		$this->load->view('templates/footer');
	}
	
	public function contact()
	{
		$this->load->view('templates/headerPersonal');
		$this->load->view('pages/contact_me');
		$this->load->view('templates/footer');
	}
	
	public function submit_contact()
	{
		if(!($this->input->post('name')&&$this->input->post('email')&&$this->input->post('content'))){
			$this->load->view('templates/header');
			$this->load->view('pages/contact');
			$this->load->view('templates/footer');
		}else{
				
			$this->load->database();
				
			$data = array(
					'name' => $this->input->post('name', TRUE),
					'email' => $this->input->post('email', TRUE),
					'content' => $this->input->post('content', TRUE)
			);
				
			$this->db->insert('contact_form', $data);
			$this->load->view('templates/headerPersonal');
			$this->load->view('pages/contactSuccess');
			$this->load->view('templates/footer');
		}
	}
	
	public function research()
	{
		$this->load->view('templates/headerPersonal');
		$this->load->view('pages/research');
		$this->load->view('templates/footer');
	}
	
	public function gustame()
	{
		$this->load->view('templates/headerPersonal');
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
	}
	
	public function test()
	{
		//$this->load->driver('cache');
		//session_start();
		//$_SESSION["hola"] = "chau";
		echo $_SESSION["hola"];
	}
}

/* End of file personal.php */
/* Location: ./application/controllers/personal.php */