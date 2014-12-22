<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}
 
// Autoload the required files
require_once('vendor/autoload.php' );
 
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\GraphUser;
 
class Facebook {
  var $ci;
  var $helper;
  var $session;
  var $permissions;
 
  public function __construct() {
    $this->ci =& get_instance();
    $this->permissions = $this->ci->config->item('permissions', 'facebook');
    $this->ci->load->helper('url');
 	
    // Initialize the SDK
    FacebookSession::setDefaultApplication( $this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook') );

    // Create the login helper and replace REDIRECT_URI with your URL
    // Use the same domain you set for the apps 'App Domains'
    // e.g. $helper = new FacebookRedirectLoginHelper( 'http://mydomain.com/redirect' );
    $this->helper = new FacebookRedirectLoginHelper(site_url('matcher/friends'));

    if ( $this->ci->session->userdata('fb_token') ) {
      $this->session = new FacebookSession( $this->ci->session->userdata('fb_token') );

      // Validate the access_token to make sure it's still valid
      try {
        if ( ! $this->session->validate() ) {
          $this->session = null;
        }
      } catch ( Exception $e ) {
        // Catch any exceptions
        $this->session = null;
      }
    } else {
      // No session exists
      try {
        $this->session = $this->helper->getSessionFromRedirect();
      } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
      } catch( Exception $ex ) {
        // When validation fails or other local issues
      }
    }
 
    if ( $this->session ) {
      $this->ci->session->set_userdata( 'fb_token', $this->session->getToken() );
 
      $this->session = new FacebookSession( $this->session->getToken() );
    }
  }
 
  /**
   * Returns the login URL.
   */
  public function get_login_url() {
    return $this->helper->getLoginUrl( $this->permissions );
  }

  /**
   * Returns the current user's info as an array.
   */
  public function get_user() {
    if ( $this->session ) {
      /**
       * Retrieve User’s Profile Information
       */
      // Graph API to request user data
      $request = ( new FacebookRequest( $this->session, 'GET', '/me' ) )->execute();
 
      // Get response as an array
      $user = $request->getGraphObject()->asArray();
 
      return $user;
    }
    return false;
  }
  
	public function get_friends_data($lang) {
		$user = new stdClass();
		$request = ( new FacebookRequest( $this->session, 'GET', '/me?fields=id,name,books{name,likes},movies{name,likes},friends{name,books{name,likes},movies{name,likes}}&locale='.$lang ) )->execute();
  	$results = $request->getGraphObject()->asArray();
  	$friends = $results["friends"]->data;
  	$user->name = $results["name"];
  	$user->id = $results["id"];
  	$user->books = $results["books"];
  	$user->movies = $results["movies"];
  	array_push($friends, $user);
  	return $friends;
 	}
 	
 	public function get_friends_likes() {
 		$request = ( new FacebookRequest( $this->session, 'GET', '/me?fields=id,name,books{name,likes},friends{name,books{name,likes}}&locale=es_LA' ) )->execute();
 		$results = $request->getGraphObject()->asArray();
 		return $results	;
 	}
}