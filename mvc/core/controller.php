<?php 
	
	class controller {

		public function model($model){
			require_once "./mvc/model/".$model.".php";
			return new $model;
		}
		public function view($view,$data=[]){
			require_once "./mvc/view/layout/".$view.".php";
		}
		public function viewAdmin($view,$data=[]){
			require_once "./mvc/view/layout/".$view.".php";
		}
	}
 ?>