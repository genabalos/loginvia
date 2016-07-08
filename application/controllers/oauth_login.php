<?php

		require_once APPPATH . 'vendor\autoload.php';
		require_once APPPATH . 'libraries\oauth2-facebook-master\src\Provider\Facebook.php';

class Oauth_Login extends CI_Controller{

	public $user = "";

	public function __construct(){
		parent::__construct();
	}

// Store user information and send to profile page
	public function index() {
		//session_start();

		$provider = new \League\OAuth2\Client\Provider\Facebook([
			'clientId'          => '630330267121773',
			'clientSecret'      => 'd0ff8c43144f0fd9cf9b0e49a545ec5b',
			'redirectUri'       => 'http://localhost/fb',
			'graphApiVersion'   => 'v2.6',
		]);

		if (!isset($_GET['code'])) {

			// If we don't have an authorization code then get one
			$authUrl = $provider->getAuthorizationUrl([
				'scope' => ['email'],
			]);
			$_SESSION['oauth2state'] = $provider->getState();

			echo '<a href="'.$authUrl.'">Log in with Facebook!</a>';
			exit;

		// Check given state against previously stored one to mitigate CSRF attack
		}elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

			unset($_SESSION['oauth2state']);
			echo 'Invalid state.';
			exit;

		}

		// Try to get an access token (using the authorization code grant)
		$token = $provider->getAccessToken('authorization_code', [
			'code' => $_GET['code']
		]);

		// Optional: Now you have a token you can look up a users profile data
		try {

			// We got an access token, let's now get the user's details
			$user = $provider->getResourceOwner($token);

			// Use these details to create a new profile
			//printf('Hello %s!', $user->getFirstName());
			//echo "<br>";
			
			$id = $user->getId();
			//printf('ID: %s!', $id);
			//echo "<br>";
			//var_dump($id);
			# string(1) "4"

			$name = $user->getName();
			//printf('Name: %s!', $name);
			//echo "<br>";
			//var_dump($name);
			# string(15) "Mark Zuckerberg"

			$firstName = $user->getFirstName();
			//printf('First Name: %s', $firstName);
			//echo "<br>";
			//var_dump($firstName);
			# string(4) "Mark"

			$lastName = $user->getLastName();
			//printf('Last Name: %s', $firstName);
			//echo "<br>";
			//var_dump($lastName);
			# string(10) "Zuckerberg"

			# Requires the "email" permission
			$email = $user->getEmail();
			//printf('Email: %s', $email);
			//echo "<br>";
			//var_dump($email);
			# string(15) "thezuck@foo.com"

			# Requires the "user_hometown" permission
			$hometown = $user->getHometown();
			//echo "<br>";
			//var_dump($hometown);
			# array(10) { ["id"]=> string(10) "12345567890" ...

			# Requires the "user_about_me" permission
			$bio = $user->getBio();
			//echo "<br>";
			//var_dump($bio);
			# string(426) "All about me...

			$pictureUrl = $user->getPictureUrl();
			//echo "<br>";
			//var_dump($pictureUrl);
			# string(224) "https://fbcdn-profile-a.akamaihd.net/hprofile- ...

			$isDefaultPicture = $user->isDefaultPicture();
			//echo "<br>";
			//var_dump($isDefaultPicture);
			# boolean false

			$coverPhotoUrl = $user->getCoverPhotoUrl();
			//echo "<br>";
			//var_dump($coverPhotoUrl);
			# string(111) "https://fbcdn-profile-a.akamaihd.net/hphotos- ...

			$gender = $user->getGender();
			//echo "<br>";
			//var_dump($gender);
			# string(4) "male"

			$locale = $user->getLocale();
			//echo "<br>";
			//var_dump($locale);
			# string(5) "en_US"

			$timezone = $user->getTimezone();
			//echo "<br>";
			//var_dump($timezone);
			# int -5

			//$logoutUrl = $provider->getLogoutUrl();
			//var_dump($logoutUrl);
			
			$link = $user->getLink();
			//echo "<br>";
			//var_dump($link);
			# string(62) "https://www.facebook.com/app_scoped_user_id/1234567890/"

				echo '<pre>';
				//echo "<br>";
				//var_dump($user);
				# object(League\OAuth2\Client\Provider\FacebookUser)#10 (1) { ...
				echo '</pre>';
				
			
			} catch (\Exception $e) {

				// Failed to get user details
				exit('Oh dear...');
			}

			echo '<pre>';
			// Use this to interact with an API on the users behalf
			//var_dump($token->getToken());
			# string(217) "CAADAppfn3msBAI7tZBLWg...

			// The time (in epoch time) when an access token will expire
			//var_dump($token->getExpires());
			# int(1436825866)
			echo '</pre>';
			
			
			$user_profile = $user->toArray();
			
			//$this->load->view('login', $user_profile);
			$this->load->view('profile', $user_profile);
				
		
	}

	// Logout from facebook
		public function logout() {
			
			session_destroy();
			redirect(base_url());
		}

}
?>