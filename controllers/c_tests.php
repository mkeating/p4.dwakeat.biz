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

	public function finalemail($error = NULL){

		# displays this test 

		# setup view
			$this->template->content = View::instance('v_tests_finalemail');
			$this->template->title = "test";

		# Pass data to the view
		$this->template->content->error = $error;

		# render
			echo $this->template;

	}

	public function p_finalemail($error = NULL){


		$tale_id = $_POST['tale_id'];

		#get tale properties
		$q = "SELECT *
			FROM tales 
			WHERE tale_id = '".$tale_id."'";

		$tale = DB::instance(DB_NAME)->select_rows($q);

		echo "<pre>";
		print_r($tale);
		echo "</pre>";

		#get all authors on the story
			$q = "SELECT *
				FROM users_tales
				WHERE tale_id = '".$tale_id."'";

			$all_authors = DB::instance(DB_NAME)->select_rows($q);
			$all_authors_ids = [];

			foreach ($all_authors as $key => $value) {
				array_push($all_authors_ids, $value['user_id']);
			}
			

			foreach($all_authors_ids as $key => $value){
				#build and send an email to each author

				$this_author_q = "SELECT *
					FROM users
					WHERE user_id = ".$value;

				$this_author = DB::instance(DB_NAME)->select_rows($this_author_q);	
				/*echo "<pre>";
				print_r($this_author);
				echo "</pre>";*/

				$name = $this_author[0]['name'];
				$email = $this_author[0]['email'];

				$to[] = Array(
					"name" => $name,
					"email" => $email);

				$from = Array(
					"name" => APP_NAME,
					"email" => APP_EMAIL);

				$subject = $tale[0]['title']." is finished!";

				$body = $tale[0]['title']." is finished! Read it here: [library URL]";
				$cc  = "";
				$bcc = "";

				echo "<pre>";
				//echo (implode("",$this_author[0]['email']));
				print_r($to);
				echo "</pre>";
				echo "<pre>";
				print_r(gettype($email));
				echo "</pre>";
				echo "<pre>";
				print_r($body);
				echo "</pre>";
				

				$email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);
				unset($to);
				
			}

		

	}
		
	
		
} # End of class
