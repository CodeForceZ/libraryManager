<div class="mt-5 mb-5 pt-5 pb-5"></div>
<footer class="bg-dark fixed-bottom p-2 text-light text-center">
    <?php
        if($_SESSION['user_id']){ 
        $footerUserData = $usersController->getUserById($_SESSION['user_id']);
    ?>
    <div class="mr-auto"><?php echo $footerUserData->first_name . ' ' . $footerUserData->last_name; ?></div>
    <?php } ?>
    
</footer>