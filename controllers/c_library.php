<?php

class library_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	public function index(){
		
		#display all tale titles as links to the full tales

		$all_tales_q = "SELECT *
			FROM tales";

		$all_tales = DB::instance(DB_NAME)->select_rows($all_tales_q);

		foreach($all_tales as $tale => $value){
			echo "<pre>";
			print_r($value['title']);
			echo "</pre>";
		}	
		
	}

	public function tale($tale_id){

		#displays the passed tale_id's content and users

		$tale_q = "SELECT *
			FROM users_tales
			WHERE tale_id = ".$tale_id;

		$tale = DB::instance(DB_NAME)->select_rows($tale_q);

		echo "<pre>";
		print_r($tale);
		echo "</pre>";

		

	}

	public function user($user_id){

		#displays all the tales the passed user_id was involved with, same display scheme as index

		$user_q = "SELECT *
			FROM users_tales
			WHERE user_id = ".$user_id;

		$user = DB::instance(DB_NAME)->select_rows($user_q);

		foreach($user as $key => $value){

			$tale_q = "SELECT *
			FROM tales
			WHERE tale_id = ".$value['tale_id'];

			$tale_link = DB::instance(DB_NAME)->select_rows($tale_q);

			echo "<pre>";
			print_r($tale_link);
			echo "</pre>";

			$link = "/library/tale/".$tale_link[0]['tale_id'];

			echo "<a href=".$link.">".$tale_link[0]['title']."</a>";


		}		

		
	}
	
} # End of class
