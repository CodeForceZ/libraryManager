<?php 
    require_once('bootstrap.php');

    $usersController = new Users();
    $data = [];
    if(isset($_POST["submit"])){
        $result = $usersController->signIn($_POST);
        $data['emptyEmail'] = $result['emptyEmail'];
        $data['emptyPassword'] = $result['emptyPassword'];
        $data['invalidPassword'] = $result['invalidPassword'];
        $data['userNotFound'] = $result['userNotFound'];
    }else{
        $data['emptyEmail'] = '';
        $data['emptyPassword'] = '';
        $data['invalidPassword'] = '';
        $data['userNotFound'] = '';
    }
?>


<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <div class="row">
        <h1 class="display-4 text-light">Welcome to <?php echo $_ENV["APP_NAME"];?></h1>
    </div>
    <div class="row">
        <p class="pl-1 text-info">Please sign in to continue</p>
    </div>
    <div class="row pt-4">
        <div class="card col-lg-3 col-md-4 col-sm-6 p-4 bg-light text-secondary">
            <form id="signInForm" method="post">
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $_POST['email'];?>"/>
                    <small class="text-danger p-1"><?php echo $data['emptyEmail'];?></small><small class="text-danger p-1"><?php echo $data['userNotFound'];?></small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" />
                    <small class="text-danger p-1"><?php echo $data['emptyPassword'];?></small><small class="text-danger p-1"><?php echo $data['invalidPassword'];?></small>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-info">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('structure/footer.php'); ?>
<?php require_once('structure/js_scripts.php'); ?>
<?php require_once('structure/foot.php'); ?>



        
        
        
    