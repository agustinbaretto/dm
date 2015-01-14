<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Matcher extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('recommend');
		$client = new Google_Client();
		$client->setDeveloperKey("AIzaSyBDxbGHi_I78CnY7rjoec5LfqMTNwueiKM");
		$this->freebase = new Google_Service_Freebase($client);
	}
	
	private function reconcile($entityName, $freebaseType, $lang)
	{
		$candidate = null;
		$response = null;
		$optParams = array('name' => $entityName, 'kind' => $this->config->item('freebase_type', $freebaseType), 'lang' => $lang);
		 
		$response = $this->cache->memcached->get(md5(serialize($optParams)));
		if ($response == FALSE){
			$response = $this->freebase->reconcile($optParams);
			$this->cache->memcached->save(md5(serialize($optParams)), $response, 0);
		}
		 
		if($response->getMatch()){
			$candidate = $response->getMatch()[0];
		}elseif ($response->getCandidate()){
			$candidate = $response->getCandidate()[0];
		}
		return $candidate;
	}
	
	public function books()
  {	echo 1;
  	$this->config->load('entity');
   	$this->load->driver('cache');
   	$entityType = "book";
   	echo 1;
   	if ( $this->session ) {
   		$preferences = array();
   		$entityList = array();
   		$nodes = array();
   		$fan_ent = array();
   		$fan_fan = array();
   		$i = 0;
   		$metrics = array(	"es"=>0,
   											"en"=>0,
   											"author"=>0,
   											"stripEs"=>0,
   											"stripEn"=>0,
   											"unknown"=>0
   		);
   		$friends = $this->facebook->get_friends_data($this->config->item('facebook_field', $entityType));
   		$measure = array();
			echo 1;
   		foreach ($friends as $friend){
   			if(isset($friend->$this->config->item('facebook_field', $entityType))){
    			array_push($nodes, array("id"=>$friend->id, "label"=>$friend->name, "group"=>"user"));
    			$preferences[$friend->name] = array();
    			
    			foreach($friend->$this->config->item('facebook_field', $entityType)->data as $entityInstance){
    				$name = $entityInstance->name;
    				$freebaseName = null;
    				$freebaseMid = null;
    				$candidate = $this->reconcile($name, $this->config->item('freebase_type', $entityType), "es");
    				if($candidate){
	   					$freebaseName = $candidate->name;
  	 					$freebaseMid = $candidate->mid;
   						$metrics["es"]++;
   					}else{
    					$candidate = $this->reconcile($name, $this->config->item('freebase_type', $entityType), "en");
    					if($candidate){
    						$freebaseName = $candidate->name;
    						$freebaseMid = $candidate->mid;
    						$metrics["en"]++;
    					}else{
    						$words = array('aaaaaa');
    						foreach ($words as $needle){
	    						$pos = strpos($name, $needle);
	   							if($pos){
		   							$name = substr($name, 0, $pos);
		    						$candidate = $this->reconcile($name, $this->config->item('freebase_type', $entityType), "es");
		    						if($candidate){
		    							$freebaseName = $candidate->name;
		    							$freebaseMid = $candidate->mid;
		    							$metrics["stripEs"]++;
		    						}else{
					    				$candidate = $this->reconcile($name, $this->config->item('freebase_type', $entityType), "en");
				    					if($candidate){
				    						$freebaseName = $candidate->name;
				    						$freebaseMid = $candidate->mid;
				    						$metrics["stripEn"]++;
				   						}
		    						}
		    						break;
	   							}
	    					}
				 				$freebaseName = $name;
			    			$i++;
				   			$freebaseMid = strval($i);
				   			$metrics["unknown"]++;
    					}
    				}
    					
    				//add to list of entities
    				if(isset($entityList[$freebaseName])){
    					//check to see the person has not liked same entity twice
    					if ($friend->id != end($entityList[$freebaseName]["fans"])){
    						array_push($entityList[$freebaseName]["fans"], $friend->id);
    						foreach ($entityList[$freebaseName]["fans"] as $otherFan){
    							array_push($fan_fan, array("from"=>$friend->id, "to"=>$otherFan));
    						}
    						//store relationship
   							array_push($fan_ent, array("from"=>$friend->id, "to"=>$entityList[$freebaseName]["mid"]));
   							$preferences[$friend->name][$freebaseName] = (strpos($entityList[$freebaseName]["mid"], "m"))?5.0:4.0;
    					}
    				}else{
    					//create entity
    					$entityList[$freebaseName]["fans"] = array($friend->id);
    					$entityList[$freebaseName]["mid"] = $freebaseMid;
    					//store relationship
    					array_push($nodes, array("id"=>$freebaseMid, "label"=>$freebaseName, "group"=>$entityType));
    					array_push($fan_ent, array("from"=>$friend->id, "to"=>$freebaseMid));
    					$preferences[$friend->name][$freebaseName] = (strpos($entityList[$freebaseName]["mid"], "m"))?5.0:4.0;
    				}
    			}
    		}
    	}
    	vd::dump($entityList);
    	$re = new Recommend();
    	vd::dump($re->getRecommendations($preferences, "Diego Greco"));die;
    	
    	$this->load->view('templates/header');
    	$data = array("data"=> json_encode(array("nodes"=>$nodes, "edges"=>$fan_ent)));
    	$this->load->view('pages/home', $data);
    	$this->load->view('templates/footer');
		}else{
			//TODO: no session
		}	
	}
    
  public function destroy()
  {
   	$this->session->sess_destroy();
  	session_destroy();
  }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */