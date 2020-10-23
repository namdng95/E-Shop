
    <div id="login">
        <h3 class="text-center text-white pt-5">Administrator Login</h3>
        
        
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="login" method="POST">
                            <h3 class="text-center text-info">Login</h3>
                            <?php include('./mvc/view/form/validation.php'); ?>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input value="<?php if(isset($data['email'])) echo trim($data['email']); ?>"  type="text" name="username" id="username" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input value="<?php if(isset($data['password'])) echo trim($data['password']); ?>" type="password" name="password" id="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input
                                            id="remember-me" name="remember" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    