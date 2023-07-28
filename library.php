<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    $libraryId = $_REQUEST['id'];
    $usersController = new Users();
    $codeBaseController = new CodeBases();
    $librariesController = new Libraries();
    $statusController = new Statuses();
    $generalsController = new Generals();
    $library = $librariesController->getLibraryById($libraryId);
    $libraryDeliveryTypes = $librariesController->getLibraryDeliveryTypes();
    $codeBase = $codeBaseController->getCodeBaseById($library->code_base_id);
    $yesNoOptions = $generalsController->getYesNoOptions();
    $licenseOptions = $generalsController->getLicenseOptions();
    $siblingLibraries = $librariesController->getSiblingLibraries($libraryId, $library->code_base_id);
    $origin = getOriginPath($_REQUEST['origin'], $library->code_base_id);

    if(isset($_POST['submit'])){
        $result = $librariesController->update($libraryId, $_REQUEST['origin']);
    }

?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">Library : <?php echo $library->library_name ;?></h1>
    <h6 class="text-secondary">CodeBase : <?php echo $codeBase->code_base_name; ?></h6>
    <div class="row pt-4">
        <p class="pl-3 text-info">Manage Data for this Library</p>
    </div>
    <div class="row mt-1 mb-3 pl-1">
        <a href="<?php echo $origin ;?>" class="btn blueBG btn-sm text-light">Back</a>
    </div>
    <div class="row p-3 blueBG">
        <div class="col-lg-4 p-4 text-secondary">
            <div class="card bg-light p-2">
                <form method="post">
                    
                    <!-- LibraryName -->
                    <div class="form-group">
                        <label for="libraryName"><small>Library</small></label>
                        <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" name="libraryName" id="libraryName" placeholder="Enter Library Name" value="<?php echo $library->library_name ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryName']['invalidChars'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryName']['unique'];?></small></div>
                    </div>

                    <!-- Version -->
                    <div class="form-group">
                        <label for="libraryVersion"><small>Version</small></label>
                        <input type="text" class="form-control form-control-sm" name="libraryVersion" id="libraryVersion" placeholder="Enter Version Number" value="<?php echo $library->version ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryVersion']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryVersion']['invalidChars'];?></small></div>
                    </div>

                    <!-- DeliveryType -->
                    <div class="form-group">
                        <label for="deliveryType"><small>Delivery type</small></label>
                        <select name="deliveryType" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($libraryDeliveryTypes as $deliveryType){
                                    if($deliveryType->type_id == $library->delivery_type){
                                        $selected ='selected';
                                    }else{
                                        $selected ='';
                                    }
                                    echo "<option value=\"$deliveryType->type_id\" $selected>$deliveryType->title</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['deliveryType']['required'];?></small></div>
                    </div>
                    
                    <!-- Purpose -->
                    <div class="form-group">
                        <label for="purpose"><small>Purpose</small></label>
                        <input type="text" class="form-control form-control-sm" name="purpose" id="purpose" placeholder="Please state the purpose of this library" value="<?php echo $library->purpose ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['purpose']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['purpose']['invalidChars'];?></small></div>
                    </div>

                    <!-- ScriptName -->
                    <div class="form-group">
                        <label for="scriptName"><small>Script Name</small></label>
                        <input type="text" class="form-control form-control-sm" name="scriptName" id="scriptName" placeholder="Enter Script Name" value="<?php echo $library->script_name ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['scriptName']['invalidChars'];?></small></div>
                    </div>

                    <!-- LocalPath -->
                    <div class="form-group">
                        <label for="localPath"><small>Local Path</small></label>
                        <input type="text" class="form-control form-control-sm" name="localPath" id="localPath" placeholder="Enter Local Path" value="<?php echo $library->local_path ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['localPath']['invalidChars'];?></small></div>
                    </div>

                    <!-- Recommended -->
                    <div class="form-group">
                        <label for="recommended"><small>Is this library recommended ?</small></label>
                        <select name="recommended" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($yesNoOptions as $option){
                                    if($option->option_id == $library->recommended){
                                        $selected ='selected';
                                    }else{
                                        $selected ='';
                                    }
                                    echo "<option value=\"$option->option_id\" $selected>$option->option_value</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['recommended']['required'];?></small></div>
                    </div>

                    <!-- Maintained -->
                    <div class="form-group">
                        <label for="maintained"><small>Is this library actively maintained ?</small></label>
                        <select name="maintained" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($yesNoOptions as $option){
                                    if($option->option_id == $library->maintained){
                                        $selected ='selected';
                                    }else{
                                        $selected ='';
                                    }
                                    echo "<option value=\"$option->option_id\" $selected>$option->option_value</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['maintained']['required'];?></small></div>
                    </div>

                    <!-- Security Risks -->
                    <div class="form-group">
                        <label for="securityRisks"><small>Does this library have known security risks ?</small></label>
                        <select name="securityRisks" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($yesNoOptions as $option){
                                    if($option->option_id == $library->security_risk){
                                        $selected ='selected';
                                    }else{
                                        $selected ='';
                                    }
                                    echo "<option value=\"$option->option_id\" $selected>$option->option_value</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['securityRisks']['required'];?></small></div>
                    </div>

                    <!-- License -->
                    <div class="form-group">
                        <label for="license"><small>What type of license does this library have ?</small></label>
                        <select name="license" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($licenseOptions as $option){
                                    if($option->license_type_id == $library->license){
                                        $selected ='selected';
                                    }else{
                                        $selected ='';
                                    }
                                    echo "<option value=\"$option->license_type_id\" $selected>$option->license_type</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['license']['required'];?></small></div>
                    </div>

                    <!-- Latest Version -->
                    <div class="form-group">
                        <label for="latestVersion"><small>Is this the latest version of this library ?</small></label>
                        <select name="latestVersion" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($yesNoOptions as $option){
                                    if($option->option_id == $library->latest_version){
                                        $selected ='selected';
                                    }else{
                                        $selected ='';
                                    }
                                    echo "<option value=\"$option->option_id\" $selected>$option->option_value</option>";
                                }
                            ?>
                        </select>
                        <div class="text-danger pl-1"><small><?php echo $result['latestVersion']['required'];?></small></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-sm">Update</button>
                        <small class="text-danger p-1"><?php echo $result['insertError'];?></small>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-6 p-4 text-secondary">
            
                <h4 class="text-light"><span class="text-info"><?php echo $library->library_name;?>'s</span> relationships to other libraries from <span class="text-info"><?php echo $codeBase->code_base_name ;?></span></h4>
                <div class="card bg-light p-2 mt-4">
                    <table class="table table-light table-hover">
                        <thead>
                            <tr>
                                <!--th></th-->
                                <th>Is a Parent of</th>
                                <th>Is Dependent On</th>
                                <th>Library</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($siblingLibraries as $siblingLibrary){
                                    $deliveryType = $librariesController->getDeliveryTypeById($siblingLibrary->delivery_type);
                                    if($librariesController->checkForDependency($libraryId, $siblingLibrary->library_id) == true){
                                        $dependencyAction = 'remove';
                                        $dependecyChecked = 'checked';
                                        
                                    }else{
                                        $dependencyAction = 'add';
                                        $dependecyChecked = '';
                                        $parencyDisabled = '';
                                        
                                    }

                                    if($librariesController->checkForParency($siblingLibrary->library_id, $libraryId) == true){
                                        $parencyAction = 'remove';
                                        $parencyChecked = 'checked';
                                        $dependencyDisabled = 'disabled';
                                        
                                    }else{
                                        $parencyAction = 'add';
                                        $parencyChecked = '';
                                        $dependencyDisabled = '';
                                        
                                    }

                                    echo "<tr>
                                            <!--td>$library->library_name</td-->
                                            <td><input type=\"checkbox\" id=\"parent\" value=\"$parencyAction\" $parencyChecked disabled /></td>
                                            <td><input type=\"checkbox\" id=\"dependency\" value=\"$dependencyAction\" $dependecyChecked onchange=\"updateLibraryDependency('dependency', '$libraryId', '$siblingLibrary->library_id', this.value)\" $dependencyDisabled/></td>
                                            <td>".$siblingLibrary->library_name."</td>
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



        
        
        
    