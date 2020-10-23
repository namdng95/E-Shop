<?php 
	
	class Home extends controller {

		public function index(){

			$Users = $this->model("User");

			$this->view("allUsers",[

			"type"=>$Users->getAllUser(),
			]);
		}

	}

 ?>