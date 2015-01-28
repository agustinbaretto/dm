<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function index()
	{
		$data = array("login_url" => $this->facebook->get_login_url());
		//$this->load->view('templates/headerLanding');
		//$this->load->view('pages/landing', $data);
		//$this->load->view('templates/footerLanding');
		$this->load->view('pages/coming');
	}
	
	public function logout()
	{
		$this->load->helper('url');
		
		$this->session->sess_destroy();
  	session_destroy();
  	redirect('/main');
	}
	
	public function how()
	{
		$this->load->view('templates/headerLanding');
		$this->load->view('pages/about');
		$this->load->view('templates/footer');
	}
	
	public function download()
	{
		$this->load->helper('download');
		$data = file_get_contents(base_url()."assets/img/gustame.pdf");
		$name = 'gustame.pdf';
		
		force_download($name, $data);
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
	
	public function contactme()
	{
		if(($this->input->post('email'))){				
			$this->load->database();
			$data = array(
					'email' => $this->input->post('email', TRUE),
			);
				
			$this->db->insert('launch_form', $data);
			$this->load->view('pages/coming');
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
