<?php 
    include('./mvc/view/admin/block/header.php');
    require "./mvc/view/".$data["page"].".php";
    include('./mvc/view/admin/block/footer.php');   
?>