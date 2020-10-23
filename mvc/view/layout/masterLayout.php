<?php 
    include('./mvc/view/user/block/header.php');
    require "./mvc/view/".$data["page"].".php";
    include('./mvc/view/user/block/footer.php');
?>