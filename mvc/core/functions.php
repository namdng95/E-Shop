<?php 

    function clean($str){
        return htmlentities(($str));
    }
    function set_message($msg){
        if(!$msg){
            $_SESSION['Message'] = $msg;
        }else{
            $msg = '';
        }
    }
    function get_message(){
        if(isset($_SESSION['Message'])){
            $msg = $_SESSION['Message'];
            unset($_SESSION['Message']);
        }
        
    }

    function user_validation(){
        
    }






?>