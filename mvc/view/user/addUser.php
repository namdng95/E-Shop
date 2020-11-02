
<!-- Check Validate Data -->
<?php //include('./mvc/view/form/validation.php') ?>
<?php if(isset($data['Errors']) && !empty($data['Errors'])){
    $Errors = $data['Errors'];
}?>


<form action="UserController/createUser" method="POST" enctype="multipart/form-data">
    <h1>Add User</h1>
    <div class="form-group position-relative">
        <label>Name</label>
        <input name="name" type="text" class="form-control" value="" required>
    </div>
<?php 
    if(isset($Errors['name']['name_format']))
    echo '<div class="alert alert-danger" role="alert" >'.$Errors['name']['name_format'].'</div>'; 
    if(isset($Errors['name']['name_len']))
    echo '<div class="alert alert-danger" role="alert" >'.$Errors['name']['name_len'].'</div>'; 
?>

    <div class="form-group position-relative">
        <label>Email</label>
        <input name="email" type="email" class="form-control" value="" required>
    </div>
<?php 
    if(isset($Errors['email']['email_exists']))
    echo '<div class="alert alert-danger" role="alert" >'.$Errors['email']['email_exists'].'</div>'; 
    if(isset($Errors['email']['email_format']))
    echo '<div class="alert alert-danger" role="alert" >'.$Errors['email']['email_format'].'</div>'; 
?>
    <div class="form-group position-relative">
        <label>Password</label>
        <input name="password" type="password" class="form-control" value="" required>
    </div>

    <div class="form-group position-relative">
        <label>Password Confirm</label>
        <input name="passConfirm" type="password" class="form-control" value="" required>
    </div>
<?php 
    if(isset($Errors['password']['pass_not_match']))
    echo '<div class="alert alert-danger" role="alert" >'.$Errors['password']['pass_not_match'].'</div>'; 
?>
    <div class="form-group position-relative">
        <label>Day of Birth</label>
        <input name="dob" type="date" class="form-control" value="" required>
    </div>
    <div class="form-group position-relative">
        <label>Phone</label>
        <input name="phone" type="text" class="form-control" value="" required>
    </div>  
<?php 
    if(isset($Errors['phone']['phone_format']))
    echo '<div class="alert alert-danger" role="alert" >'.$Errors['phone']['phone_format'].'</div>'; 
?>
    <div class="form-group position-relative">
        <label>Choose file</label>
        <input name="image" type="file" class="form-control" value="" required>
    </div>      
    <input type="submit" name="submit" value="Create" class="btn btn-primary" style="padding: 10px 40px; font-size: 30px;" >
</form>