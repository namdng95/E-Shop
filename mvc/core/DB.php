<?php 

	class DB {

		public $con;
		protected $server = "ec2-54-225-214-37.compute-1.amazonaws.com";
		protected $username = "nwqthriwiwqogg";
		protected $password = "3d583663bf2a961693294d3a2b000823dd302a0a748324263f567fa3518ba313";
		protected $dbName = "daqgrt26tj7dvo";

		function __construct(){

			$this->con = mysqli_connect($this->server,$this->username,$this->password);
			mysqli_select_db($this->con,$this->dbName);
			mysqli_query($this->con,"SET NAMES 'utf8");
		}
	}

 ?>