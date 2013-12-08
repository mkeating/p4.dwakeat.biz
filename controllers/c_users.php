<?php

class user_controller extends base_controller {
	
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
		
	}
	
	
	
} # End of class
