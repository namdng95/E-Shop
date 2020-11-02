<?php 

	class User extends DB {

		public function getAllUsers(){

			$sql = "SELECT * FROM Users";
			return mysqli_query($this->con,$sql);
		}
		public function getJson(){
			$Data = [];
			$sql = "SELECT * FROM Users";
			$result = mysqli_query($this->con,$sql);
			//return mysqli_query($this->con,$sql);
			While ($row = mysqli_fetch_assoc($result)){
				$Data[] = $row;
			}
			return json_encode($Data);
		}


		public function getUserById($id){
			$sql = "SELECT * FROM Users WHERE id = '$id'";
			//return mysqli_query($this->con,$sql);
			$result = mysqli_query($this->con,$sql);
			While ($row = mysqli_fetch_assoc($result)){
				$Data[] = $row;
			}
			return json_encode($Data);
		}

		public function getUserByEmail($email){
			$sql = "SELECT * FROM Users WHERE email = '$email'";
			//return mysqli_query($this->con,$sql);
			$result = mysqli_query($this->con,$sql);
			While ($row = mysqli_fetch_assoc($result)){
				$Data[] = $row;
			}
			return json_encode($Data);
		}



		public function loginUser($email, $password){
			$check = false;

			$sql = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
			$result = mysqli_query($this->con,$sql);
			//var_dump($result);
			if($result->num_rows > 0){
				$check = true;
			}
			//var_dump($check);
			return json_encode($check);
		}






		public function create($email, $password, $name, $dob, $phone, $image, $active){
			$sql = "INSERT INTO Users(email, password, name, dob, phone, img, active) VALUES ('$email','$password','$name','$dob','$phone', '$image', '$active')";
			$result = false;
			if(mysqli_query($this->con,$sql)){
				$result = true;
			}
			return json_encode($result);
		}


		public function email_exist($email){
			$check = false;

			$sql = "SELECT * FROM Users WHERE email = '$email'";
			$result = mysqli_query($this->con,$sql);
			//var_dump($result);
			if($result->num_rows > 0){
				$check = true;
			}
			//var_dump($check);
			return json_encode($check);
		}
		public function update($id, $password, $name, $dob, $phone, $image, $active){
			$sql = "UPDATE Users SET password = '$password', name = '$name', dob = '$dob', phone = '$phone', img = '$image', active = '$active' WHERE id = $id";
			$result = false;
			if(mysqli_query($this->con,$sql)){
				$result = true;
			}
			return json_encode($result);
		}


		public function delete($id){
			$sql = "DELETE FROM Users WHERE id = $id";
			$result = false;
			if(mysqli_query($this->con,$sql)){
				$result = true;
			}
			return json_encode($result);
		}
	}

 ?>