<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function freebase()
	{
		$client = new Google_Client();
		//$client->setApplicationName("Tweetbase");
		$client->setDeveloperKey("AIzaSyBDxbGHi_I78CnY7rjoec5LfqMTNwueiKM");
		
		$service = new Google_Service_Freebase($client);
		$optParams = array('name' => 'Mafalda', 'kind' => '/comic_strips/comic_strip', 'lang' => 'es');
		$response = $service->reconcile($optParams);
		vd::dump($response->getMatch());
		vd::dump($response->getCandidate());
		foreach ($response['result'] as $item) {
			print_r($item);
			echo "<br /> \n";
		}
		//$service = new Google_Service_Freebase($client);
		//$optParams = array('query' => 'color', 'type' => '/type/type', 'lang' => 'es', 'filter'=> "(not with:commons)");
		//$response = $service->search($optParams);
		
		//foreach ($response['result'] as $item) {
		//	print_r($item);
		//	echo "<br /> \n";
		//}
	}
	
	public function facebook()
	{
		
		
	}
	
	public function login()
	{
		echo 1;
	
	}
	
	public function nlp()
	{
		function getWikipediaPage($page) {
			ini_set('user_agent', 'NlpToolsTest/1.0 (tests@php-nlp-tools.com)');
			$page = json_decode(file_get_contents("http://en.wikipedia.org/w/api.php?format=json&action=parse&page=".urlencode($page)),true);
			return preg_replace('/\s+/',' ',strip_tags($page['parse']['text']['*']));
		}
		
		$tokenizer = new NlpTools\Tokenizers\WhitespaceTokenizer();
		$sim = new NlpTools\Similarity\CosineSimilarity();
		
		$aris = $tokenizer->tokenize(getWikipediaPage('Diego Maradona'));
		$archi = $tokenizer->tokenize(getWikipediaPage('Lionel Messi'));
		$einstein = $tokenizer->tokenize(getWikipediaPage('Paris'));
		
		$aris_to_archi = $sim->similarity(
				$aris,
				$archi
		);
		
		$aris_to_albert = $sim->similarity(
				$aris,
				$einstein
		);
		
		var_dump($aris_to_archi,$aris_to_albert);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */