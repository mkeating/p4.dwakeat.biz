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

		
	}
	
	
} # End of class
