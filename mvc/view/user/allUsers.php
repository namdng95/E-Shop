<!-- Get API Data -->
<?php 
    if(isset($data['AllUsers'])){
        $Data = json_decode($data['AllUsers'], true);
    }
?>


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Table User Management</h1>
<br>
<!-- DataTales Example -->
<?php include('./mvc/view/form/validation.php') ?>
<div class="card shadow mb-4">
    <!-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div> -->
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <span>
                    <a href="UserController/addUser"><i style="font-size: 50px;" class="fas fa-user-plus"></i></a>
                </span>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Day of Birth</th>
                        <th>Phone</th>
                        <th style="width: 10%;">Image</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php            
        foreach($Data as $row) {?>
                    <tr>
                        <th scope="row"><?php echo $row["id"]; ?></th>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["password"]; ?></td>
                        <td><?php echo $row["dob"]; ?></td>
                        <td><?php echo $row["phone"]; ?></td>
                        <td><img style="width: 50%;" src="public/admin/upload/<?php echo $row["img"]; ?>" alt=""></td>
                        <td><?php echo $row["active"]; ?></td>
                        <td>
                            <a href="UserController/editUser/<?php echo $row["id"] ?>" style="margin: 0 25%;"><i
                                    class="fas fa-edit"></i></a>
                            <a href="UserController/deleteUser/<?php echo $row["id"] ?>"
                                onclick="return confirm('Are you sure you want to delete this User?')"><i
                                    class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php 
        }
                  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>