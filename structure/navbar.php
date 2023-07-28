<?php 
if(isset($_SESSION['user_id'])){
    $homeLink = 'home.php';
}else{
    $homeLink = 'index.php';
}

?>


<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- <div class="container"> -->
        <a class="navbar-brand mr-5" href="<?php echo $homeLink ;?>"><img src="img/logo.png" class="img-fluid mr-2" style="width: 30px;" /> <?php echo $_ENV["APP_NAME"];?></a>
        <?php if(isset($_SESSION['user_id'])){ ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="codeBases.php">Code Bases</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="libraries.php">Libraries</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="test.php">Test</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto pr-5">
                <?php if($_SESSION['user_type'] == 1){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <?php } ?>
                <li class="nav-item dropdown mr-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- <a class="dropdown-item" href="#">Manage</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="profile.php">Edit Profile</a>
                        <a class="dropdown-item" href="signOut.php">Sign Out</a>
                    </div>
                </li>
            </ul>
            
        </div>
        <?php } ?>
    <!-- </div> -->
</nav> 