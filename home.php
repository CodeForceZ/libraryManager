<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    $usersController = new Users();
    $userRecord = $usersController->getUserById($_SESSION['user_id']);
?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">Welcome <?php echo $userRecord->first_name ;?></h1>
</div>

<?php require_once('structure/footer.php'); ?>
<?php require_once('structure/js_scripts.php'); ?>
<?php require_once('structure/foot.php'); ?>



        
        
        
    