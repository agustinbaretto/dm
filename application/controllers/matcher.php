<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Matcher extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('recommend');
		$this->config->load('entity');
		$this->load->driver('cache');
		
		if(!$this->facebook->session){
			redirect('/main');
		}else{
			$this->owner = $this->facebook->get_user();
		}
		
		$client = new Google_Client();
		$client->setDeveloperKey($this->config->item("credentials", "google"));
		$this->freebase = new Google_Service_Freebase($client);
		$this->gBooks = new Google_Service_Books($client);
	}
	
	public function friends()
	{
		//$entityTypeFacebook = $this->config->item('facebook_field', $entityType);
		$friends = $this->facebook->get_friends_data('es_LA');
		foreach ($friends as $key => $friend){
			//if((!isset($friend->books))&&(!isset($friend->movies))){
   		if(!isset($friend->books)){
   			unset($friends[$key]);
   		}
		}
		array_pop($friends);
		$data = array("friends"=>$friends, "owner"=>$this->owner);
		$this->load->view('templates/header');
    $this->load->view('pages/friends', $data);
    $this->load->view('templates/footer');
	}
	
	public function friend($userId)
	{
		$books0 = array();
		$books1 = array();
		$movies = array();
		$bookGraph = $this->colaborative("books");
		//$movieGraph = $this->colaborative("movies");
		$re = new Recommend();
		if(array_key_exists($userId, $bookGraph)){
			$books0 = $re->getRecommendations($bookGraph, $userId);

			foreach ($books0 as $title=>$ranking){
				if($ranking > 0.95){
					$res = $this->gBooks->volumes->listVolumes($title,array("maxResults"=>1));
					$books1[$title] = $res->current()->getVolumeInfo();
				}else{
					break;
				}
			}vd::dump($books1);die;
		}
		//if(array_key_exists($userId, $movieGraph)){
		//	$movies = $re->getRecommendations($movieGraph, $userId);
		//}
		$data = array("books"=>$books, "movies"=>$movies, "ownerId"=>$userId);
		$this->load->view('templates/header');
		$this->load->view('pages/recs', $data);
		$this->load->view('templates/footer');
	}
	
	private function books($book)
	{
		$preferences = $this->colaborative("books");
		$re = new Recommend();
		$recs = $re->matchItems($re->transformPreferences($preferences), $book);
		$data = array("recs"=>$recs, "ownerId"=>$userId);
		$this->load->view('templates/header');
		$this->load->view('pages/recs', $data);
		$this->load->view('templates/footer');
	}
	
	private function colaborative($entityType)
  {	
  	$this->load->helper('file');
   	$entityTypeFacebook = $this->config->item('facebook_field', $entityType);
   	$entityTypeFreebase = $this->config->item('freebase_type', $entityType);
   	$lang = $this->config->item('lang', $entityType);
   	$words = $this->config->item('strip_dictionary', $entityType);

   	if ( $_SESSION ) {
   		$titles = array();
   		$preferences = array();
   		$entityList = array();
   		$nodes = array();
   		$fan_ent = array();
   		$fan_fan = array();
   		$i = 0;
   		$not = 0;
   		
   		$friends = $this->facebook->get_friends_data($entityTypeFacebook, $lang);

   		/*
   		$facebookList = array();
   		foreach ($friends as $friend){
   			if(isset($friend->$entityTypeFacebook)){
   				foreach($friend->$entityTypeFacebook->data as $entityInstance){
   					if(isset($facebookList[$entityInstance->name])){
   						//check to see the person has not liked same entity twice
   							$facebookList[$entityInstance->name]++;
   					}else{
   						//create entity
   						$facebookList[$entityInstance->name] = 1;
   					}
   				}
   			}
   		}
   		arsort($facebookList);
   		vd::dump($facebookList);
   		die;*/

   		foreach ($friends as $friend){
   			if(isset($friend->$entityTypeFacebook)){
    			array_push($nodes, array("id"=>$friend->id, "label"=>$friend->name, "group"=>"user"));
    			$preferences[$friend->id] = array();
    			
    			foreach($friend->$entityTypeFacebook->data as $entityInstance){
    				$name = $entityInstance->name;
    				$freebaseName = null;
    				$freebaseMid = null;
    				$candidate = $this->reconcile($name, $entityTypeFreebase, "es");
    				if($candidate && $candidate->confidence > 0.000007){
    					$freebaseMid = $candidate->mid;
    					if (array_key_exists($candidate->mid, $titles)) {
								$freebaseName = $titles[$candidate->mid];
							}else{
								$freebaseName = $candidate->name;
								$titles[$candidate->mid] = $freebaseName;
							}
   					}else{
    					$candidate = $this->reconcile($name, $entityTypeFreebase, "en");
    					if($candidate && $candidate->confidence > 0.000000007){
    						$freebaseMid = $candidate->mid;
    						if (array_key_exists($candidate->mid, $titles)) {
									$freebaseName = $titles[$candidate->mid];
								}else{
									$freebaseName = $candidate->name;
									$titles[$candidate->mid] = $freebaseName;
								}
    					}else{
    						foreach ($words as $needle){
	    						$pos = stripos($name, $needle);
	   							if($pos){
		   							$name = substr($name, 0, $pos);
		    						$candidate = $this->reconcile($name, $entityTypeFreebase, "es");
		    						if($candidate && $candidate->confidence > 0.000000007){
		    							$freebaseMid = $candidate->mid;
		    							if (array_key_exists($candidate->mid, $titles)) {
												$freebaseName = $titles[$candidate->mid];
											}else{
												$freebaseName = $candidate->name;
												$titles[$candidate->mid] = $freebaseName;
											}
		    						}else{
					    				$candidate = $this->reconcile($name, $entityTypeFreebase, "en");
				    					if($candidate && $candidate->confidence > 0.000000007){
				    						$freebaseMid = $candidate->mid;
				    						if (array_key_exists($candidate->mid, $titles)) {
													$freebaseName = $titles[$candidate->mid];
												}else{
													$freebaseName = $candidate->name;
													$titles[$candidate->mid] = $freebaseName;
												}
				   						}
		    						}
		    						break;
	   							}
	    					}
    					}
    				}
    				if(!$freebaseMid){
    					$freebaseName = $name;
    					$i++;
    					$freebaseMid = strval($i);
    				}
    				//add to list of entities
    				if(isset($entityList[$freebaseName])){
    					//check to see the person has not liked same entity twice
    					if ($friend->id != end($entityList[$freebaseName]["fans"])){
    						array_push($entityList[$freebaseName]["fans"], $friend->id);

    						//store relationship
   							//array_push($fan_ent, array("from"=>$friend->id, "to"=>$entityList[$freebaseName]["mid"]));
   							$preferences[$friend->id][$freebaseName] = (strpos($entityList[$freebaseName]["mid"], "m"))?5.0:1.0;
    					}
    				}else{
    					//create entity
    					$entityList[$freebaseName]["fans"] = array($friend->id);
    					$entityList[$freebaseName]["mid"] = $freebaseMid;

    					//store relationship
    					//array_push($nodes, array("id"=>$freebaseMid, "label"=>$freebaseName, "group"=>$entityType));
    					//array_push($fan_ent, array("from"=>$friend->id, "to"=>$freebaseMid));
    					$preferences[$friend->id][$freebaseName] = (strpos($entityList[$freebaseName]["mid"], "m"))?5.0:1.0;
    				}
    			}
    		}
    	}
   		if(!file_exists('./data/'.$this->owner["id"].'.txt')){
   			write_file('./data/'.$this->owner["id"].'.txt', json_encode($entityList));
   		}
    	return $preferences;
		}else{
			//TODO: no session
		}	
	}
	
	public function graph($entityType)
	{
		$entityTypeFacebook = $this->config->item('facebook_field', $entityType);
		$entityTypeFreebase = $this->config->item('freebase_type', $entityType);
		$words = $this->config->item('strip_dictionary', $entityType);
		$lang = $this->config->item('lang', $entityType);
	
		if ( $_SESSION ) {
			$titles = array();
			$entityList = array();
			$nodes = array();
			$fan_ent = array();
			$fan_fan = array();
			$i = 0;

			$friends = $this->facebook->get_friends_data($entityTypeFacebook, $lang);
			foreach ($friends as $friend){
				if(isset($friend->$entityTypeFacebook)){
					$friend->id = "user".$friend->id;
					array_push($nodes, array("id"=>$friend->id, "label"=>$friend->name, "group"=>"user"));
					$preferences[$friend->id] = array();
					 
					foreach($friend->$entityTypeFacebook->data as $entityInstance){
						$name = $entityInstance->name;
						$freebaseName = null;
						$freebaseMid = null;
						$candidate = $this->reconcile($name, $entityTypeFreebase, "en");
						if($candidate){
							if (array_key_exists($candidate->mid, $titles)) {
								$freebaseName = $titles[$candidate->mid];
							}else{
								$freebaseName = $candidate->name;
								$titles[$candidate->mid] = $freebaseName;
							}
						}else{
							$candidate = $this->reconcile($name, $entityTypeFreebase, "es");
							if($candidate){
								$freebaseMid = $candidate->mid;
								if (array_key_exists($candidate->mid, $titles)) {
									$freebaseName = $titles[$candidate->mid];
								}else{
									$freebaseName = $candidate->name;
									$titles[$candidate->mid] = $freebaseName;
								}
							}else{
								foreach ($words as $needle){
									$pos = stripos($name, $needle);
									if($pos){
										$name = substr($name, 0, $pos);
										$candidate = $this->reconcile($name, $entityTypeFreebase, "en");
										if($candidate){
											$freebaseMid = $candidate->mid;
											if (array_key_exists($candidate->mid, $titles)) {
												$freebaseName = $titles[$candidate->mid];
											}else{
												$freebaseName = $candidate->name;
												$titles[$candidate->mid] = $freebaseName;
											}
										}else{
											$candidate = $this->reconcile($name, $entityTypeFreebase, "es");
											if($candidate){
												$freebaseMid = $candidate->mid;
												if (array_key_exists($candidate->mid, $titles)) {
													$freebaseName = $titles[$candidate->mid];
												}else{
													$freebaseName = $candidate->name;
													$titles[$candidate->mid] = $freebaseName;
												}
											}
										}
										break;
									}
								}
							}
						}
						if(!$freebaseMid){
							$freebaseName = $name;
							$i++;
							$freebaseMid = strval($i);
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
							}
						}else{
							//create entity
							$entityList[$freebaseName]["fans"] = array($friend->id);
							$entityList[$freebaseName]["mid"] = $freebaseMid;
	
							//store relationship
							array_push($nodes, array("id"=>$freebaseMid, "label"=>$freebaseName, "group"=>$entityType));
							array_push($fan_ent, array("from"=>$friend->id, "to"=>$freebaseMid));
						}
					}
				}
			}
			$data = array("data"=> json_encode(array("nodes"=>$nodes, "edges"=>$fan_ent)));
			//vd::dump($nodes);
			//vd::dump($fan_ent);
			//die;
			$this->load->view('templates/header');
			$this->load->view('pages/graph', $data);
			$this->load->view('templates/footer');
		}else{
			//TODO: no session
		}
	}
	
	private function reconcile($entityName, $freebaseType, $lang)
	{
		$candidate = null;
		$response = null;
		$optParams = array('name' => $entityName, 'kind' => $freebaseType, 'lang' => $lang);
	
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
    
  public function destroy()
  {
   	$this->session->sess_destroy();
  	session_destroy();
  }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
