
<?php include('./mvc/view/form/validation.php') ?>
<?php 
    if(isset($data['UserById']))
    {
        $Data = json_decode($data['UserById'], true);
        foreach($Data as $row) 
        { 
        ?>
            <form method="POST" action="UserController/updateUser/<?php echo $row["id"]; ?>" enctype="multipart/form-data">
                <h1>Edit User</h1>
                <div class="form-group position-relative">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" value="<?php echo $row["name"]; ?>" required>
                </div>
                <div class="form-group position-relative">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control" value="<?php echo $row["email"]; ?>" required>
                </div>
                <div class="form-group position-relative">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" value="<?php echo $row["password"]; ?>" required>
                </div>
                <div class="form-group position-relative">
                    <label>Password Confirm</label>
                    <input name="passConfirm" type="password" class="form-control" value="<?php echo $row["password"]; ?>" required>
                </div>
                <div class="form-group position-relative">
                    <label>Day of Birth</label>
                    <input name="dob" type="date" class="form-control" value="<?php echo $row["dob"]; ?>" required>
                </div>
                <div class="form-group position-relative">
                    <label>Phone</label>
                    <input name="phone" type="text" class="form-control" value="<?php echo $row["phone"]; ?>" required>
                </div>            
                <div class="form-group position-relative">
                    <label>Choose file</label>
                    <input type="file" name="image" class="form-control" value="" required>
                </div>
                <input name="submit" type="submit" value="Update" class="btn btn-primary" style="padding: 10px 40px; font-size: 30px;">
            </form>
        <?php
        }
    }else{ ?>
        <h3>Data not available! Please check again...<i class="fas fa-bug"></i></h3>
    <?php
    }
    ?>