
<!-- Check Validate Data -->
<?php include('./mvc/view/form/validation.php') ?>

<form action="UserController/createUser" method="POST" enctype="multipart/form-data">
    <h1>Add User</h1>
    <div class="form-group position-relative">
        <label>Name</label>
        <input name="name" type="text" class="form-control" value="" required>
    </div>
    <div class="form-group position-relative">
        <label>Email</label>
        <input name="email" type="email" class="form-control" value="" required>
    </div>
    <div class="form-group position-relative">
        <label>Password</label>
        <input name="password" type="password" class="form-control" value="" required>
    </div>
    <div class="form-group position-relative">
        <label>Password Confirm</label>
        <input name="passConfirm" type="password" class="form-control" value="" required>
    </div>
    <div class="form-group position-relative">
        <label>Day of Birth</label>
        <input name="dob" type="date" class="form-control" value="" required>
    </div>
    <div class="form-group position-relative">
        <label>Phone</label>
        <input name="phone" type="text" class="form-control" value="" required>
    </div>  
    <div class="form-group position-relative">
        <label>Choose file</label>
        <input name="image" type="file" class="form-control" value="" required>
    </div>      
    <input type="submit" name="submit" value="Create" class="btn btn-primary" style="padding: 10px 40px; font-size: 30px;" >
</form>