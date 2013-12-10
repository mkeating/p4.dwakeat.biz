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

		$q = "SELECT user_id 
			FROM users 
			WHERE email = '".$_POST['email_next']."'";
		$next_user_result = DB::instance(DB_NAME)->select_rows($q);
		$next_user = intval($next_user_result[0]['user_id']);
		echo '<pre>';
        print_r(gettype($next_user));
        echo '</pre>'; 
		#prepare Tale to be inserted
		$tale = Array(
			"title" => $_POST["title"],
			"current_user" => $next_user,
			"place" => 2);
		echo '<pre>';
        print_r($tale);
        echo '</pre>'; 

		#insert new Tale, get its ID for next step
		DB::instance(DB_NAME)->insert('tales', $tale);
		/*$q = "SELECT tale_id
			FROM tales
			WHERE tales.current_user = ".intval($next_user[0]['user_id']);
		$id = DB::instance(DB_NAME)->select_rows($q);
		echo '<pre>';
        print_r($id);
        echo '</pre>'; 
		#prepare user_tale to be inserted 
		$user_tale = Array(
			"content" => $_POST['content'],
			"tale_id" => $id,
			"user_id" => $this->user->user_id,
			"order" => 1);

		//DB::instance(DB_NAME)->insert('user_tales', $user_tale);
		//Router::redirect('/users/home');
		*/
	}
	
	
} # End of class
