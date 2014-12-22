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
	
	public function contact()
	{
		$this->load->view('templates/header');
		$this->load->view('pages/contact');
		$this->load->view('templates/footer');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */