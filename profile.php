<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    $usersController = new Users();
    $statusController = new Statuses();
    $userRecord = $usersController->getUserById($_SESSION['user_id']);
    $gendersController = new Genders();
    $genderRecords = $gendersController->getGenders();
    $userType = $usersController->getUserType($userRecord->user_type);

    if(isset($_POST["submit"])){
        $result = $usersController->updateProfile($_POST);
    }
    
?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">Your Profile</h1>
    <div class="row pt-4">
        <p class="pl-3 text-info">Manage your details</p>
    </div>
    <div class="row pt-4 blueBG">
        <div class="col-lg-3 col-md-4 col-sm-6 p-4 text-secondary profile_form_card">
            <div class="card p-2">
                <form method="post"">

                <!-- FirstName -->
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control form-control-sm" name="firstName" id="firstName" placeholder="Enter your First Name" value="<?php echo $userRecord->first_name;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['invalidChars'];?></small></div>
                    </div>

                    <!-- LastName -->
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control form-control-sm" name="lastName" id="lastName" placeholder="Enter your Last Name" value="<?php echo $userRecord->last_name;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['lastName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['lastName']['invalidChars'];?></small></div>
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control form-control-sm" name="gender" id="gender">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($genderRecords as $genderRecord){
                                    if($userRecord->gender == $genderRecord->gender_id){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo "<option value=\"".$genderRecord->gender_id."\" $selected>".$genderRecord->gender_title."</option>";
                                }
                            ?>
                            
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['gender']['required'];?></small></div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Enter your email" value="<?php echo $userRecord->email;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['email']['required'];?></small></div>
                    </div>

                    <!-- AccountType -->
                    <div class="form-group">
                        <label for="accountType">Account Type</label>
                        <input type="text" class="form-control form-control-sm" name="accountType" id="accountType" value="<?php echo $userType->title;?>" disabled/>
                    </div>

                    <!-- Submit -->
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-sm">Update</button>
                        <small class="text-danger p-1"><?php echo $result['insertError'];?></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('structure/footer.php'); ?>
<?php require_once('structure/js_scripts.php'); ?>
<?php require_once('structure/foot.php'); ?>



        
        
        
    