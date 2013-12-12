<?php

class tales_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	public function p_new(){
		
		#check for empty fields
		foreach($_POST as $field => $value){
			if(empty($value)){
				Router::redirect('/users/home/empty-fields');
			}
		}

		#get the next user(assumes user already exists, for now)

		$q = "SELECT *
			FROM users 
			WHERE email = '".$_POST['email_next']."'";

		$next_author = DB::instance(DB_NAME)->select_rows($q);

		#check to see if next_user is already working on a story
		if($next_author[0]['current_tale']){
			#preserves their content
			$content = $_POST['content'];
			Router::redirect("/users/home/duplicate");
		}
		
		
		#prepare Tale to be inserted
		$tale = Array(
			"title" => $_POST["title"],
			"current_author" => $next_author[0]['user_id'],
			"place" => 2);
		

		#insert new Tale, get its ID for next step
		DB::instance(DB_NAME)->insert('tales', $tale);
		$q2 = "SELECT tale_id
			FROM tales
			WHERE tales.current_author = ".intval($next_author[0]['user_id']);
		$id = DB::instance(DB_NAME)->select_rows($q2);

		#prepare user_tale to be inserted 
		$user_tale = Array(
			"content" => $_POST['content'],
			"tale_id" => $id[0]['tale_id'],
			"user_id" => $this->user->user_id,
			"section" => 1);
		
		DB::instance(DB_NAME)->insert('users_tales', $user_tale);

		# set current tale for next author
		$update = Array("current_tale" => $id[0]['tale_id']);
		DB::instance(DB_NAME)->update("users", $update, "WHERE user_id = '".$next_author[0]['user_id']."'");

		#send email to next author (no opt out functionality currently)
		$to[] = Array(
			"name" => $next_author[0]['name'],
			"email" => $next_author[0]['email']);

		$from = Array(
			"name" => APP_NAME,
			"email" => APP_EMAIL);

		$subject = $this->user->name." wants to write with you!";

		$body = "Hi ".$next_author[0]['name'].",\n".$this->user->name." would like you to continue their story ".$_POST["title"]."!\n 
		Log in at http://localhost/ to start writing.";
		$cc  = "";
		$bcc = "";

		$email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

		#redirect
		Router::redirect('/users/home');
		
	}
	

	public function p_continue(){
		

		#check for empty fields
		foreach($_POST as $field => $value){
			if(empty($value)){
				Router::redirect('/users/home/empty-fields');
			}
		}


		#get tale properties
		$q = "SELECT *
			FROM tales 
			WHERE tale_id = '".$this->user->current_tale."'";

		$tale = DB::instance(DB_NAME)->select_rows($q);


		#check to see if this is the 4th and final part of the story
		if($tale[0]['place'] == 4){

			#prepare user_tale to be inserted 
			$user_tale = Array(
				"content" => $_POST['content'],
				"tale_id" => $this->user->current_tale,
				"user_id" => $this->user->user_id,
				"section" => $tale[0]['place']);

			DB::instance(DB_NAME)->insert('users_tales', $user_tale);

			#set previous author's current_tale to NULL
			$last_author = $tale[0]['current_author'];
			$update_last_author = Array("current_tale" => NULL);
			DB::instance(DB_NAME)->update("users", $update_last_author, "WHERE user_id = '".$last_author."'");

			# update tale
			$update_tale = Array("complete" => 1);
			DB::instance(DB_NAME)->update("tales", $update_tale, "WHERE tale_id = '".$tale[0]['tale_id']."'");

			# send an email to all authors


		}
		else{
			
			#get the next user(assumes user already exists, for now)
			$q = "SELECT *
				FROM users 
				WHERE email = '".$_POST['email_next']."'";

			$next_author = DB::instance(DB_NAME)->select_rows($q);

			# get all authors for the story so far, to deny repeats
			$q = "SELECT *
				FROM users_tales
				WHERE tale_id = '".$this->user->current_tale."'";

			$previous_authors = DB::instance(DB_NAME)->select_rows($q);

			#checks for repeat authors
			foreach($previous_authors as $key => $value){
				if($value['user_id'] == $next_author[0]['user_id']){
					#preserves their content
					$content = $_POST['content'];
					Router::redirect("/users/home/duplicate");
				}
			}

			#prepare user_tale to be inserted 
			$user_tale = Array(
				"content" => $content,
				"tale_id" => $this->user->current_tale,
				"user_id" => $this->user->user_id,
				"section" => $tale[0]['place']);
			

			DB::instance(DB_NAME)->insert('users_tales', $user_tale);

			

			#set previous author's current_tale to NULL
			$last_author = $tale[0]['current_author'];
			$update_last_author = Array("current_tale" => NULL);
			DB::instance(DB_NAME)->update("users", $update_last_author, "WHERE user_id = '".$last_author."'");

			# update tale
			$update_tale = Array(
				"current_author" => $next_author[0]['user_id'],
				"place" => $tale[0]['place'] + 1);

			DB::instance(DB_NAME)->update("tales", $update_tale, "WHERE tale_id = '".$tale[0]['tale_id']."'");

			#update current_tale for next_author in users

			$update_next_author = Array("current_tale" => $tale[0]['tale_id']);
			DB::instance(DB_NAME)->update("users", $update_next_author, "WHERE user_id = '".$next_author[0]['user_id']."'");
			}
			
			#send email to next author (no opt out functionality currently)
			$to[] = Array(
				"name" => $next_author[0]['name'],
				"email" => $next_author[0]['email']);

			$from = Array(
				"name" => APP_NAME,
				"email" => APP_EMAIL);

			$subject = $this->user->name." wants to write with you!";

			$body = "Hi ".$next_author[0]['name'].",\n".$this->user->name." would like you to continue their story ".$_POST["title"]."!\n 
			Log in at http://localhost/ to start writing.";
			$cc  = "";
			$bcc = "";

			$email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);
			

			#redirect
			Router::redirect('/users/home');

	}
	
} # End of class
