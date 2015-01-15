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
		$this->load->database();
		
		$data = array(
				'name' => 'My name' ,
				'email' => 'My email' ,
				'subject' => 'My subject',
				'content' => 'My content'
		);
		
		$this->db->insert('contact', $data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
