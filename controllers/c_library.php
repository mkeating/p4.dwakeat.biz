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

		$library = "";

		foreach($all_tales as $tale => $value){
			
			$link = "/library/tale/".$value['tale_id'];

			echo $link."<br>";

			$library = $library."<a href=".$link.">".$value['title']."</a><br>";

		}
		# setup view
		$this->template->content = View::instance('v_library_index');
		$this->template->content->library = $library;
		
		# render template
		echo $this->template;

		
	}

	public function tale($tale_id){

		#displays the passed tale_id's content and users

		$tale_q = "SELECT *
			FROM users_tales
			WHERE tale_id = ".$tale_id." 
			ORDER BY section";

		$tale = DB::instance(DB_NAME)->select_rows($tale_q);

		$title_q = "SELECT title
			FROM tales
			WHERE tale_id = ".$tale_id;

		$title = DB::instance(DB_NAME)->select_field($title_q);
		//echo "<h1>".$title."</h1>";

		$story = "";
		$writers = "";

		foreach($tale as $key => $value){
			
			$story = $story."<div class='_".$value['section']."'>".$value['content']."</div>";

			$user_q = "SELECT *
				FROM users
				WHERE user_id = ".$value['user_id'];

			$user = DB::instance(DB_NAME)->select_rows($user_q);
			$writers = $writers."<div class='_".$value['section']."'><a href='/library/user/".$value['user_id']."'>".$user[0]['name']."</a></div><br>";

			
		}
		# setup view
		$this->template->content = View::instance('v_library_tale');
		$this->template->content->story_title = $title;
		$this->template->content->story = $story;
		$this->template->content->writers = $writers;
	

		# render template
		echo $this->template;


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

			$link = "/library/tale/".$tale_link[0]['tale_id'];

			echo "<a href=".$link.">".$tale_link[0]['title']."</a>";


		}		

		
	}
	
} # End of class
