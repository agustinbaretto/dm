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
		$this->load->view('pages/contact');
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