<?php 

    if(isset($data['Errors']) && !empty($data['Errors']))
    {   
        //var_dump($data['Errors']);
        foreach((array)$data['Errors'] as $err){
            echo '<div class="alert alert-danger" role="alert" >'.$err.'</div>';
            break;
        };
    }else if(isset($data['Messages']) && !empty($data['Messages'])){
        foreach((array)$data['Messages'] as $msg){
            echo '<div class="alert alert-success" role="alert" >'.$msg.'</div>';
            break;
        };
    }

    

?>