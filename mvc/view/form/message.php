
<?php 
//--------------Form Message -------------
    if(isset($_SESSION['success'])){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; unset($_SESSION['error']);?>
        </div>
<?php
    }else if(isset($_SESSION['error'])){ ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']);?>
        </div>
<?php
    }
?>