<?php 
	class UserController extends controller {
		protected $user;
		protected $Errors = [];
		protected $Messages = [];

		function __construct()
		{
			$this->user = $this->model("User");
		}

		public function index(){
			$this->view("masterLayout",[
				"page" => "user/allUsers",
				"AllUsers" => $this->user->getJson(),
			]);
		}

		public function viewApi(){
			$this->view("masterLayout",[
				"page" => "user/viewApi",
				"Data" => $this->user->getJson(),
			]);
		}

		public function addUser(){
			$this->view("masterLayout", [
				"page" => "user/addUser",
			]);
		}

		public function createUser(){
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
				$email = $_POST['email'];
				$password = $_POST['password'];
				$passConfirm = $_POST['passConfirm'];
				$name = $_POST['name'];
				$dob = $_POST['dob'];
				$phone = $_POST['phone'];
				$active = 0;
				$emailCheck = json_decode($this->user->email_exist($email));

				$Max = 30;
				$Min = 5;
				//$check_validation = true;


				if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
					$this->Errors['name']['name_format'] = "Name only letters and white space allowed";
					//$check_validation = false;
				}
				if(strlen($name) < $Min || strlen(($name)) > $Max){
					$this->Errors['name']['name_len'] = "Name can not be less than {$Min} or more than {$Max} character!";
					//$check_validation = false;
				}	
				if($emailCheck == true){
					$this->Errors['email']['email_exists'] = "Email already exists!";
					//$check_validation = false;
				}
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$this->Errors['email']['email_format'] = "Invalid email format";
					//$check_validation = false;
				}
				if($password != $passConfirm){
					$this->Errors['password']['pass_not_match'] = "Password do not match!";
					//$check_validation = false;
				}
						
				
				if (!preg_match("/^[0-9]*$/",$phone)) {
					$this->Errors['phone']['phone_format'] = "Invalid phone numbers format";
					//$check_validation = false;
				}
				// if (!preg_match("/^[a-zA-Z,0-9]*$/",$name)) {
				// 	$Errors[] = "Name can not accept those characters!";
				// }

				//Check Validate image file
				if(isset($_FILES['image']) && $_FILES['image']["name"] != null){
					$allowUpload   = true;

					//lấy tên của file:
					$file_name = $_FILES['image']["name"];
					
					//lấy đường dẫn tạm lưu nội dung file:
					$file_tmp = $_FILES['image']['tmp_name'];

					//tạo đường dẫn lưu file trên host:
					$path = "public/admin/upload/".basename($file_name);


					//Lấy phần mở rộng của file (jpg, png, ...)
					$imageFileType = pathinfo($path,PATHINFO_EXTENSION);
					  
					//Những loại file được phép upload
					$allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
					
					// Cỡ lớn nhất được upload (bytes)
  					$maxfilesize   = 800000;
					  
					
					// Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
					if ($_FILES["image"]["size"] > $maxfilesize)
					{
						$this->Errors[] = "Can't upload more than $maxfilesize (bytes).";
						$allowUpload = false;
					}
				  
				  
					// Kiểm tra kiểu file
					if (!in_array($imageFileType, $allowtypes))
					{
						$this->Errors[] = "Only upload JPG, PNG, JPEG, GIF format!";
						$allowUpload = false;
					}

					
					//Kiểm tra xem có phải là ảnh bằng hàm getimagesize
					$check = getimagesize($_FILES["image"]["tmp_name"]);
					if($check !== false)
					{
						//$this->Messages[] = "Selected an image file!";
						$allowUpload = true;
					}
					else
					{
						$this->Errors[] = "This is not image file!";
						$allowUpload = false;
					}

					if($allowUpload){
						//upload nội dung file từ đường dẫn tạm vào đường dẫn vừa tạo:
						move_uploaded_file($file_tmp, $path);
						//$this->Messages[] = "Upload Successfully!";
						$check_validation = true;
					}else{

						$this->Errors[] = "Upload file error!";
						$check_validation = false;
					}
				}else{

					$this->Errors[] = "Upload file error!";
					//$check_validation = false;
				}

				

				if(empty($this->Errors)){
					$check = json_decode($this->user->create($email, md5($password), $name, $dob, $phone, $file_name, $active));

					if($check == true){	
						$this->Messages[] = "Create User Successfully!";
						$this->view("masterLayout", [
							"page" => "user/allUsers",
							"AllUsers" => $this->user->getJson(),
							"Messages" => $this->Messages,
							"Errors" => $this->Errors,
						]);
						$this->Errors = [];
						$this->Messages = [];			
					}else{
						$Errors[] = "Create User Error! Please try again...! x_X'";
						$this->view("masterLayout", [
							"page" => "user/addUser",
							//"AllUsers" => $this->user->getAllUsers(),
							"Messages" => $this->Messages,
							"Errors" => $this->Errors,
						]);
						$this->Errors = [];
						$this->Messages = [];		
					}
				}else{
					$this->view("masterLayout", [
						"page" => "user/addUser",
						//"AllUsers" => $this->user->getAllUsers(),
						"Messages" => $this->Messages,
						"Errors" => $this->Errors,
					]);
					$this->Errors = [];
					$this->Messages = [];		
				}
				
			}
		}


		public function editUser($id){
			$this->view("masterLayout", [
				"page" => "user/editUser",
				"UserById" => $this->user->getUserById($id),
			]);
		}

		public function updateUser($id){
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
				//$email = $_POST['email'];
				$password = $_POST['password'];
				$passConfirm = $_POST['passConfirm'];
				$name = $_POST['name'];
				$dob = $_POST['dob'];
				$phone = $_POST['phone'];
				$active = 0;
				//$emailCheck = json_decode($this->user->email_exist($email));

				$Max = 30;
				$Min = 5;
				//$check_validation = true;



				if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
					$this->Errors[] = "Name only letters and white space allowed";
					//$check_validation = false;
				}
				if(strlen($name) < $Min || strlen(($name)) > $Max){
					$this->Errors[] = "Name can not be less than {$Min} or more than {$Max} character!";
					//$check_validation = false;
				}
				// if($this->user->email_exist($email) === true){
				// 	$this->Errors[] = "Email already exists!";
				// 	//$check_validation = false;
				// }
				// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// 	$this->Errors[] = "Invalid email format";
				// 	//$check_validation = false;
				// }
				if($password != $passConfirm){
					$this->Errors[] = "Password do not match!";
					//$check_validation = false;
				}
							
				
				if (!preg_match("/^[0-9]*$/",$phone)) {
					$this->Errors[] = "Invalid phone numbers format";
					//$check_validation = false;
				}
				// if (!preg_match("/^[a-zA-Z,0-9]*$/",$name)) {
				// 	$Errors[] = "Username can not accept those characters!";
				// }

				//Check Validate image file
				if(isset($_FILES['image']) && $_FILES['image']["name"] != null){
					$allowUpload   = true;

					//lấy tên của file:
					$file_name = $_FILES['image']["name"];
					
					//lấy đường dẫn tạm lưu nội dung file:
					$file_tmp = $_FILES['image']['tmp_name'];

					//tạo đường dẫn lưu file trên host:
					$path = "public/admin/upload/".basename($file_name);


					//Lấy phần mở rộng của file (jpg, png, ...)
					$imageFileType = pathinfo($path,PATHINFO_EXTENSION);
					  
					//Những loại file được phép upload
					$allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
					
					// Cỡ lớn nhất được upload (bytes)
  					$maxfilesize   = 800000;
					  
					
					// Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
					if ($_FILES["image"]["size"] > $maxfilesize)
					{
						$this->Errors[] = "Can't upload more than $maxfilesize (bytes).";
						$allowUpload = false;
					}
				  
				  
					// Kiểm tra kiểu file
					if (!in_array($imageFileType, $allowtypes))
					{
						$this->Errors[] = "Only upload JPG, PNG, JPEG, GIF format!";
						$allowUpload = false;
					}

					
					//Kiểm tra xem có phải là ảnh bằng hàm getimagesize
					$check = getimagesize($_FILES["image"]["tmp_name"]);
					if($check !== false)
					{
						//$this->Messages[] = "Selected an image file!";
						$allowUpload = true;
					}
					else
					{
						$this->Errors[] = "This is not image file!";
						$allowUpload = false;
					}

					if($allowUpload){
						//upload nội dung file từ đường dẫn tạm vào đường dẫn vừa tạo:
						move_uploaded_file($file_tmp, $path);
						//$this->Messages[] = "Upload Successfully!";
						//$check_validation = true;

					}else{

						$this->Errors[] = "Upload file error!";
						//$check_validation = false;
					}

				}else{

					$this->Errors[] = "Upload file error!";
					//$check_validation = false;
				}

				
				if(empty($this->Errors)){
					$check = json_decode($this->user->update($id, md5($password), $name, $dob, $phone, $file_name, $active));

					if($check == true){	
						$this->Messages[] = "Update User Successfully!";
						$this->view("masterLayout", [
							"page" => "user/allUsers",
							"AllUsers" => $this->user->getJson(),
							"Messages" => $this->Messages,
							"Errors" => $this->Errors,
						]);
						$this->Errors = [];
						$this->Messages = [];			
					}else{
						$this->Errors[] = "Update User Error! Please try again...! x_X'";
						$this->view("masterLayout", [
							"page" => "user/editUser",
							"UserById" => $this->user->getUserById($id),
							//"AllUsers" => $this->user->getAllUsers(),
							"Messages" => $this->Messages,
							"Errors" => $this->Errors,
						]);
						$this->Errors = [];
						$this->Messages = [];		
					}

				}else{

					$Errors[] = "Update User Error! Please try again...!'";
					$this->view("masterLayout", [
						"page" => "user/editUser",
						"UserById" => $this->user->getUserById($id),
						//"AllUsers" => $this->user->getAllUsers(),
						"Messages" => $this->Messages,
						"Errors" => $this->Errors,
					]);
					$this->Errors = [];
					$this->Messages = [];		
				}
				
			}
		}
		

		public function deleteUser($id){
			if($this->user->delete($id) == true){
				$this->Messages[] = "Delete Successfully!";
				$this->view("masterLayout", [
					"page" => "user/allUsers",
					"AllUsers" => $this->user->getJson(),
					"Messages" => $this->Messages,
					//"Errors" => $this->Errors,
				]);

				$this->Messages = [];	

			}else{
				$Errors[] = "Delete Error! Please try again!";
				$this->view("masterLayout", [
					"page" => "user/allUsers",
					"AllUsers" => $this->user->getJson(),
					//"Messages" => $this->Messages,
					"Errors" => $this->Errors,
				]);

				$this->Errors = [];
			}
		}

		public function get_message(){
			if(isset($_SESSION['Message'])){
				$msg = $_SESSION['Message'];
				unset($_SESSION['Message']);
			}
		}

		public function set_message($msg){
			if($msg){
				$_SESSION['Message'] = $msg;
			}else{
				$msg = '';
			}
		}
		
		

	}

 ?>