<?php 
    require_once('bootstrap.php');
    checkSessionUserId();
    applyUserTypePermission($_SESSION['user_type']);

    $baseName = basename(__FILE__, '.php');    

    $usersController = new Users();
    $statusController = new Statuses();
    $gendersController = new Genders();
    $userRecords = $usersController->getUsers();
    $userTypes = $usersController->getUserTypes();
    $genders = $gendersController->getGenders();
    
    $data = [];
    if(isset($_POST["submit"])){
        $result = $usersController->add($_POST);
    }

    
    
    
?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">Users</h1>
    <div class="row pt-4">
        <p class="pl-3 text-info">Create and Manage User Accounts</p>
    </div>
    <div class="row p-3 blueBG">
        <div class="col-lg-3 col-md-4 col-sm-6 p-4 text-secondary">
            <div class="card bg-light p-2">
                <form method="post">

                    <!-- User Type -->
                    <div class="form-group">
                        <label for="userType"><small>User Type</small></label>
                        <select class="form-control form-control-sm" name="userType" id="userType">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($userTypes as $userType){
                                    if($userType->user_type_id == $_POST['userType']){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo "<option value=\"".$userType->user_type_id."\" $selected>".$userType->title."</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['userType']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['userType']['numeric'];?></small></div>
                    </div>

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="firstName"><small>First Name</small></label>
                        <input type="text" class="form-control form-control-sm" name="firstName" id="firstName" placeholder="Enter First Name" value="<?php echo $_POST['firstName'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['invalidChars'];?></small></div>
                    </div>

                    <!-- Last Type -->
                    <div class="form-group">
                        <label for="lastName"><small>Last Name</small></label>
                        <input type="text" class="form-control form-control-sm" name="lastName" id="lastName" placeholder="Enter Last Name" value="<?php echo $_POST['lastName'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['lastName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['lastName']['invalidChars'];?></small></div>
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label for="gender"><small>Gender</small></label>
                        <select class="form-control form-control-sm" name="gender" id="gender">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($genders as $gender){
                                    if($gender->gender_id == $_POST['gender']){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo "<option value=\"".$gender->gender_id."\" $selected>".$gender->gender_title."</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['gender']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['gender']['numeric'];?></small></div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email"><small>Email</small></label>
                        <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Enter Email" value="<?php echo $_POST['email'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['email']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['email']['emailFormat'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['email']['unique'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['email']['invalidChars'];?></small></div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password"><small>Password</small></label>
                        <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Enter Password" value="<?php echo $_POST['password'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['password']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['password']['passwordFormat'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['password']['invalidChars'];?></small></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="confirmPassword"><small>Confirm Password</small></label>
                        <input type="password" class="form-control form-control-sm" name="confirmPassword" id="confirmPassword" placeholder="Re-enter Password" value="<?php echo $_POST['confirmPassword'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['confirmPassword']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['confirmPassword']['match'];?></small></div>
                    </div>

                    <!-- Submit -->
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-sm">Add</button>
                        <small class="text-danger"><?php echo $data['insertError'];?></small>
                    </div>



                </form>
            </div>
        </div>

        <div class="col-lg-9 col-lg-8 col-sm-6 p-4 text-secondary">
            <div class="card bg-light p-2">
                <table class="table table-sm table-light table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>User Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($userRecords as $userRecord){
                            $userGender = $gendersController->getGenderById($userRecord->gender);
                            $userStatus = $statusController->getStatusById($userRecord->status);
                            $userType = $usersController->getUserType($userRecord->user_type);
                            echo "<tr>
                                        <td>".$userRecord->first_name."</td>
                                        <td>".$userRecord->last_name."</td>
                                        <td>".$userGender->gender_title."</td>
                                        <td>".$userRecord->email."</td>
                                        <td>".$userStatus->title."</td>
                                        <td>".$userRecord->date_created."</td>
                                        <td>".$userType->title."</td>
                                        <td class=\"text-right\">
                                            <a href=\"#\" onclick=\"delete_record('$baseName', '$userRecord->user_id');\"><i class=\"fa fa-trash mr-1 text-danger\"></i></a>
                                        </td>
                                    </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('structure/footer.php'); ?>
<?php require_once('structure/js_scripts.php'); ?>
<?php require_once('structure/foot.php'); ?>



        
        
        
    