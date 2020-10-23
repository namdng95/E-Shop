<?php 

	class DB {

		public $con;
		protected $server = "localhost";
		protected $username = "root";
		protected $password = "";
		protected $dbName = "demosql";

		function __construct(){

			$this->con = mysqli_connect($this->server,$this->username,$this->password);
			mysqli_select_db($this->con,$this->dbName);
			mysqli_query($this->con,"SET NAMES 'utf8");
		}
	}

 ?>