<?php 

    class AdminController extends controller{
        protected $user;
		protected $Errors = [];
		protected $Messages = [];

		function __construct()
		{
			$this->user = $this->model("User");
        }
        

        public function index(){
            $email = $password = '';
            if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
                if(!empty($_COOKIE['email']) && !empty($_COOKIE['password'])){
                    $email = $_COOKIE['email'];
                    $password = $_COOKIE['password'];
                }
            }
            
            $this->viewAdmin("layoutAdmin", [
                "page" => "admin/adminLogin",
                "email" => $email,
                "password" => $password,
            ]);
        }
        public function admin(){
            $email = $password = '';
            if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
                if(!empty($_COOKIE['email']) && !empty($_COOKIE['password'])){
                    $email = $_COOKIE['email'];
                    $password = $_COOKIE['password'];
                }
            }
            
            $this->viewAdmin("layoutAdmin", [
                "page" => "admin/adminLogin",
                "email" => $email,
                "password" => $password,
            ]);
        }

        public function register(){         
            
        }
        public function logout(){
            $email = $password = '';
            if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
                if(!empty($_COOKIE['email']) && !empty($_COOKIE['password'])){
                    $email = $_COOKIE['email'];
                    $password = $_COOKIE['password'];
                }
            }
            
            unset($_SESSION['userId'],$_SESSION['userName']);

            $this->viewAdmin("layoutAdmin", [
                "page" => "admin/adminLogin",
                "email" => $email,
                "password" => $password,
            ]);
        }

        public function login(){
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                $email = trim($_POST['username']);
                $password = trim($_POST['password']);
                $remember = isset($_POST['remember'])?true:false;


                if($remember == true){
                    $email1 = 'email';
                    $pass = 'password';
                    $expire = time()+86400;
                    //$path = '/';
                    setcookie($email1, $email, $expire);
                    setcookie($pass, $password, $expire);
                }

                $check = json_decode($this->user->loginUser($email, md5($password)));

                if($check == true){
                    $this->Messages = "Login Successfully!!";
                    $userByEmail = json_decode($this->user->getUserByEmail($email), true);

                    //check data
                    // echo "<pre>";
                    // print_r($userByEmail);
                    // echo "</pre>";


                    $this->view("masterLayout",[
                        "page" => "user/allUsers",
                        "AllUsers" => $this->user->getJson(),
                        "Messages" => $this->Messages,

                    ]);

                    foreach($userByEmail as $data){
                        $_SESSION['userId'] = $data['id'];
                        $_SESSION['userName'] = $data['name'];
                        $_SESSION['img'] = $data['img'];
                    }
                    

                    //var_dump($_SESSION['userName']);

                    
                    $this->Messages = [];

                }else{
                    $this->Errors = "Email or password is invalid! Please try again! Oop...! x_X'";

                    $this->viewAdmin("layoutAdmin",[
                        "page" => "admin/adminLogin",
                        "Errors" => $this->Errors,
                    ]);
                    $this->Errors = [];
                }

            }else{
                $this->Errors = "Something was wrong! Please check again..! x_X'";

                $this->viewAdmin("layoutAdmin",[
                    "page" => "admin/adminLogin",
                    "Errors" => $this->Errors,
                ]);
                $this->Errors = [];
            }
        }
    }
?>