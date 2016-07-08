<?php

		require_once APPPATH . 'vendor\autoload.php';
		require_once APPPATH . 'libraries\oauth2-facebook-master\src\Provider\Facebook.php';
		require_once APPPATH . 'libraries\oauth2-facebook-master\src\Grant\FbExchangeToken.php';
		require_once APPPATH . 'libraries\oauth2-google-master\src\Provider\Google.php';
		

class Login extends CI_Controller{

	public $user = "";

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model', '', TRUE);
	}
	
	public function index() {
		
		$toConnect = $this->input->post('connectWith');
		
		if ($toConnect == 'facebook'){
			$this->facebook();
		}
		else if($toConnect == 'google'){
			$this->google();
		}
		else{
			$this->load->view('connect_view');
		}
	
	}

// Store user information and send to profile page
	public function facebook(){
		
		$provider = new \League\OAuth2\Client\Provider\Facebook([
			'clientId'          => '630330267121773',
			'clientSecret'      => 'd0ff8c43144f0fd9cf9b0e49a545ec5b',
			'redirectUri'       => 'http://localhost/loginvia/index.php/login/facebook',
			'graphApiVersion'   => 'v2.6',
			'enableBetaTier'   => true,
		]);

		if (!isset($_GET['code'])){

			// If we don't have an authorization code then get one
			$authUrl = $provider->getAuthorizationUrl([
				'scope' => ['email', 'public_profile', 'user_friends'],
			]);
			$_SESSION['oauth2state'] = $provider->getState();
			
					header('Location: ' . $authUrl);

			//echo '<a href="'.$authUrl.'">Log in with Facebook!</a>';
			exit;

		// Check given state against previously stored one to mitigate CSRF attack
		} /* elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

			unset($_SESSION['oauth2state']);
			echo 'Invalid state.';
			exit;

		} */

		// Try to get an access token (using the authorization code grant)
		$token = $provider->getAccessToken('authorization_code', [
			'code' => $_GET['code']
		]);

		// Optional: Now you have a token you can look up a users profile data
		try {

			// We got an access token, let's now get the user's details
			$user = $provider->getResourceOwner($token);

			$user_profile['id'] = $user->getId();
			$user_profile['name'] = $user->getName();
			$user_profile['firstName'] = $user->getFirstName();
			$user_profile['lastName'] = $user->getLastName();
			$user_profile['email'] = $user->getEmail();
			$user_profile['hometown'] = $user->getHometown();
			$user_profile['bio'] = $user->getBio();
			$user_profile['pictureUrl'] = $user->getPictureUrl();
			$user_profile['isDefaultPicture'] = $user->isDefaultPicture();
			$user_profile['coverPhotoUrl'] = $user->getCoverPhotoUrl();
			$user_profile['gender'] = $user->getGender();
			$user_profile['locale'] = $user->getLocale();
			$user_profile['timezone'] = $user->getTimezone();
			$user_profile['link'] = $user->getLink();
			
			} catch (\Exception $e) {

				// Failed to get user details
				exit('Oh dear...');
			}		
			
			$this->load->view('templates/header');
			$this->load->view('facebook_view', $user_profile);
			$this->load->view('templates/footer');
		
		}
		
		public function google(){
			
				$provider = new League\OAuth2\Client\Provider\Google([
					'clientId'     => '395212895451-qblmbg13fa7o1lgqn84hm4ecl4kf5mt8.apps.googleusercontent.com',
					'clientSecret' => 'ocWwPzKfRxlPRE9aiPcb4AgW',
					'redirectUri'  => 'http://localhost/loginvia/index.php/login/google',
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

				} /*elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

					// State is invalid, possible CSRF attack in progress
					unset($_SESSION['oauth2state']);
					exit('Invalid state');

				}*/ else {

					// Try to get an access token (using the authorization code grant)
					$token = $provider->getAccessToken('authorization_code', [
						'code' => $_GET['code']
					]);
					
					

					// Optional: Now you have a token you can look up a users profile data
					try {

						// We got an access token, let's now get the owner details
						$ownerDetails = $provider->getResourceOwner($token);

						$user_profile['id'] = $ownerDetails->getId();
						$user_profile['name'] = $ownerDetails->getName();
						$user_profile['firstName'] = $ownerDetails->getFirstName();
						$user_profile['lastName'] = $ownerDetails->getLastName();
						$user_profile['email'] = $ownerDetails->getEmail();
						$user_profile['avatar'] = $ownerDetails->getAvatar();
						
					} catch (Exception $e) {

						// Failed to get user details
						exit('Something went wrong: ' . $e->getMessage());

					}
					
					$this->load->view('templates/header');
					$this->load->view('google_view', $user_profile);
					$this->load->view('templates/footer');
				}
			
		}

		public function logout() {
			session_destroy();
			redirect(base_url());
		}

}
?>