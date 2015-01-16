<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index()
	{
		$data = array("login_url" => $this->facebook->get_login_url());
		$this->load->view('templates/headerLanding');
		$this->load->view('pages/landing', $data);
		$this->load->view('templates/footerLanding');
	}
	
	public function logout()
	{
		$this->load->helper('url');
		
		$this->session->sess_destroy();
  	session_destroy();
  	redirect('/main');
	}
	
	public function test()
	{
		//$this->load->driver('cache');
		//session_start();
		$_SESSION["hola"] = "chau";
		echo $_SESSION["hola"];
	}
	
	public function about()
	{
		$this->load->view('templates/header');
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
	}
	
	public function contact()
	{
		$this->load->view('templates/header');
		$this->load->view('pages/contact');
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
			$this->load->view('templates/header');
			$this->load->view('pages/contactSuccess');
			$this->load->view('templates/footer');
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
