<?php

class tests_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	public function emailrepeat($error = NULL){
		# displays this test 

		# setup view
			$this->template->content = View::instance('v_tests_emailrepeat');
			$this->template->title = "test";

		# Pass data to the view
		$this->template->content->error = $error;

		# render
			echo $this->template;
	}

	public function p_emailrepeat(){

		#get the next user(assumes user already exists, for now)
		
			$q = "SELECT *
				FROM users 
				WHERE email = '".$_POST['email']."'";

			$next_author = DB::instance(DB_NAME)->select_rows($q);

			echo "<pre>";
			print_r($next_author);
			echo "</pre>";

			# get all authors for the story so far, to deny repeats
			$q = "SELECT *
				FROM users_tales
				WHERE tale_id = '".$this->user->current_tale."'";

			$previous_authors = DB::instance(DB_NAME)->select_rows($q);

			echo "<pre>";
			print_r($previous_authors);
			echo "</pre>";

			
			foreach($previous_authors as $key => $value){
				if($value['user_id'] == $next_author[0]['user_id']){
					echo "that user has already written on this story";
				}
				
			}
		
	}

	public function sendemail($error = NULL){

		# displays this test 

		# setup view
			$this->template->content = View::instance('v_tests_sendemail');
			$this->template->title = "test";

		# Pass data to the view
		$this->template->content->error = $error;

		# render
			echo $this->template;

	}

	public function p_sendemail($error = NULL){


		$to[] = Array(
			"name" => "Recipient",
			"email" => $_POST['email']);

		$from = Array(
			"name" => APP_NAME,
			"email" => APP_EMAIL);

		$subject = "Hi from HumbleTales";

		$body = "Hi B)";
		$cc  = "";
		$bcc = "";

		$email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

	}
		
	
		
} # End of class
