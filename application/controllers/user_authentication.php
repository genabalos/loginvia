<?php
		require_once APPPATH . 'vendor\autoload.php';
		require_once APPPATH . 'libraries\oauth2-google-master\src\Provider\Google.php';

//session_start();

class User_Authentication extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		// Include two files from google-php-client library in controller
		
		$provider = new League\OAuth2\Client\Provider\Google([
			'clientId'     => '395212895451-qblmbg13fa7o1lgqn84hm4ecl4kf5mt8.apps.googleusercontent.com',
			'clientSecret' => 'ocWwPzKfRxlPRE9aiPcb4AgW',
			'redirectUri'  => 'http://localhost/google',
			'hostedDomain' => 'https://localhost',
		]);

		if (!empty($_GET['error'])) {

			// Got an error, probably user denied access
			exit('Got error: ' . $_GET['error']);

		} elseif (empty($_GET['code'])) {

			// If we don't have an authorization code then get one
			$authUrl = $provider->getAuthorizationUrl();
			$_SESSION['oauth2state'] = $provider->getState();
			header('Location: ' . $authUrl);
			exit;

		} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

			// State is invalid, possible CSRF attack in progress
			unset($_SESSION['oauth2state']);
			exit('Invalid state');

		} else {

			// Try to get an access token (using the authorization code grant)
			$token = $provider->getAccessToken('authorization_code', [
				'code' => $_GET['code']
			]);
			
			

			// Optional: Now you have a token you can look up a users profile data
			try {

				// We got an access token, let's now get the owner details
				$ownerDetails = $provider->getResourceOwner($token);

				// Use these details to create a new profile
				//printf('Hello %s!', $ownerDetails->getFirstName());
				//printf('Name %s!', $ownerDetails->getName());
				
				$id = $ownerDetails->getId();

				$name = $ownerDetails->getName();
				
				$firstName = $ownerDetails->getFirstName();
				
				$lastName = $ownerDetails->getLastName();
				
				$email = $ownerDetails->getEmail();
				
				//var_dump($ownerDetails);

			} catch (Exception $e) {

				// Failed to get user details
				exit('Something went wrong: ' . $e->getMessage());

			}

			// Use this to interact with an API on the users behalf
			//echo $token->getToken();
			//echo "<br>";
			// Use this to get a new access token if the old one expires
			//echo $token->getRefreshToken();
			//echo "<br>";
			// Number of seconds until the access token will expire, and need refreshing
			//echo $token->getExpires();
			//echo "<br>";
			
			$user_profile = $ownerDetails->toArray();
			$this->load->view('google_authentication', $user_profile);
		}
	}

	// Unset session and logout
	public function logout() {
		unset($_SESSION['access_token']);
		redirect(base_url());
	}
}
?>