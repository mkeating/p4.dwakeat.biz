<?php

class users_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	public function signup($error = NULL){
		# displays signup 

		# setup view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title = "Sign Up";

		# Pass data to the view
		$this->template->content->error = $error;

		# render
			echo $this->template;
	}
		
	
	public function p_signup(){

		#check for empty fields
		foreach($_POST as $field => $value){
			if(empty($value)){
				Router::redirect('/users/signup/empty-fields');
			}
		}

		#check for duplicate email
		if ($this->userObj->confirm_unique_email($_POST['email']) == false){
			#send back to signup page
			Router::redirect("/users/signup/duplicate");
		}

		#adding data to the user
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();

		#encrypt password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		#create encrypted token via email and a random string
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

		#Insert into the db
		$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

		# log in the new user

		setcookie("token", $_POST['token'], strtotime('+2 weeks'), '/');

		# redirect to home
		Router::redirect('/users/home');
		
	}

	public function login($error = NULL){
		# Setup view 
			$this->template->content = View::instance('v_users_login');
			$this->template->title = "Login";

		# Pass data to the view
			$this->template->content->error = $error;

		# render template
			echo $this->template;
	}

	public function p_login(){

		#sanitize
		$_POST = DB::instance('p2_dwakeat_biz')->sanitize($_POST);

		#hash submitted password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		#search DB for this email and hash, returns token if available
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			AND password = '".$_POST['password']."'";

		$token = DB::instance(DB_NAME)->select_field($q);

		#if no match:
		if(!$token){

			#send back to login page
			Router::redirect("/users/login/error");
		}
		#found match
		 else {

			#store token in a cookie
			setcookie("token", $token, strtotime('+2 weeks'), '/');
		

			#send to main page
			Router::redirect("/users/home");
		}

	}

	public function logout(){
		
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# Create the data array we'll use with the update method
		$data = Array("token" => $new_token);

		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		# Delete their token cookie by setting it to a date in the past - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');

		#send back to main index
		Router::redirect("/");
	}

	#processing sign up from email referral
	public function referal($tale_id, $error = NULL){

		# displays signup 

		# setup view
			$this->template->content = View::instance('v_users_referal');
			$this->template->title = "Sign up";
			$this->template->content->tale_id = $tale_id;

		# Pass data to the view
		$this->template->content->error = $error;

		# render
			echo $this->template;
	}

	public function p_referal($tale_id){

		#i should add a check to see if the tale exists

		#check for empty fields
		foreach($_POST as $field => $value){
			if(empty($value)){
				Router::redirect('/users/signup/empty-fields');
			}
		}

		#check for duplicate email
		if ($this->userObj->confirm_unique_email($_POST['email']) == false){
			#send back to signup page
			Router::redirect("/users/signup/duplicate");
		}

		#adding data to the user
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();

		#encrypt password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		#create encrypted token via email and a random string
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

		#assign the user to the referred story
		$_POST['current_tale'] = $tale_id;

		#Insert into the db
		$user_id = DB::instance(DB_NAME)->insert('users', $_POST);

		#get this user's ID, set as current author for this tale

		$q = "SELECT user_id
		FROM users
		WHERE email = '".$_POST['email']."'";
		$id = DB::instance(DB_NAME)->select_field($q);

		$t = "SELECT *
		FROM tales
		WHERE tale_id = ".$tale_id;

		$tale = DB::instance(DB_NAME)->select_rows($t);

		$data = Array(
			"current_author" => $id);

		$update_tale = DB::instance(DB_NAME)->update("tales", $data, "WHERE tale_id = '".$tale_id."'");


		# log in the new user

		setcookie("token", $_POST['token'], strtotime('+2 weeks'), '/');

		# redirect to home
		Router::redirect('/users/home');
	}
	

	# home page of logged in user
	public function home($error = NULL){

		#if user is blank, they're not logged in; redirect to login page
		if(!$this->user){
			Router::redirect('/users/login');
		}

		#if not redirected, continue:

		# setup view
		$this->template->content = View::instance('v_users_home');

		#check if they have a current story
		if($this->user->current_tale){
			$q = "SELECT content
			FROM users_tales
			WHERE tale_id = ".$this->user->current_tale;

			$story_results = DB::instance(DB_NAME)->select_rows($q);
			$story = '';

			$q = "SELECT title
				FROM tales
				WHERE tale_id = ".$this->user->current_tale;

			$title = DB::instance(DB_NAME)->select_field($q);

			if (sizeof($story_results) == 3){
				$label = "<label for='content'>Finish the story:</label>";
				$email_form = "";
			}
			else{
				$label = "<label for='content'>Continue the story:</label>";
				$email_form = "<div class='form_group'>
									<label for='email_next'>Pass it along</label>
									<input type='text' name='email_next' class='form-control' placeholder='Email of who to pass along to'>
								</div>";
			}
			
			foreach ($story_results as $key => $value) {
				$story = $story.$value['content'];
			}

			//$this->template->content->greeting = $greeting;
			$this->template->content->story_title = $title;
			$this->template->content->story = $story;
			$this->template->content->label= $label;
			$this->template->content->email_form = $email_form;

		}

		# Pass data to the view
		$this->template->content->error = $error;

		# render view
		echo $this->template;
	}
	
	
} # End of class
