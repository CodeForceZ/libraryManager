<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    $codeBaseId = $_REQUEST['id'];
    $usersController = new Users();
    $codeBaseController = new CodeBases();
    $librariesController = new Libraries();
    $statusController = new Statuses();
    $generalsController = new Generals();
    $codeBase = $codeBaseController->getCodeBaseById($codeBaseId);
    $libraries = $librariesController->getLibrariesByCodeBase($codeBaseId);
    $libraryDeliveryTypes = $librariesController->getLibraryDeliveryTypes();
    $yesNoOptions = $generalsController->getYesNoOptions();
    $licenseOptions = $generalsController->getLicenseOptions();
    
    if(isset($_POST["codeBaseSubmit"])){
        $result = $codeBaseController->update($codeBaseId);
    }

    if(isset($_POST["librarySubmit"])){
        $result = $librariesController->add($codeBaseId);
    }



?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">CodeBase : <?php echo $codeBase->code_base_name ;?></h1>
    <div class="row pt-4">
        <p class="pl-3 text-info">Manage Data for this Code Base</p>
    </div>
    <div class="row mt-1 mb-3 pl-1">
        <a href="codeBases.php" class="btn blueBG btn-sm text-light">Back</a>
    </div>
    <div class="row p-3 blueBG">
        <div class="col-lg-4 p-4 text-secondary">
            <div class="card bg-light p-2 mb-5">
                <form method="post">

                    <!-- CodeBaseName -->
                    <div class="form-group">
                        <label for="codeBaseName"><small>Code Base</small></label>
                        <input type="text" class="form-control form-control-sm" name="codeBaseName" id="codeBaseName" placeholder="Enter Code Base Name" value="<?php echo $codeBase->code_base_name ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['codeBaseName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['codeBaseName']['invalidChars'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['codeBaseName']['unique'];?></small></div>
                    </div>

                    <!-- Server Address -->
                    <div class="form-group">
                        <label for="serverAddress"><small>Server Address</small></label>
                        <input type="text" class="form-control form-control-sm" name="serverAddress" id="serverAddress" placeholder="Enter Server Address" value="<?php echo $codeBase->server_address ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['serverAddress']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['serverAddress']['invalidChars'];?></small></div>
                    </div>

                    <!-- RootDirectory -->
                    <div class="form-group">
                        <label for="rootDir"><small>Root Directory</small></label>
                        <input type="text" class="form-control form-control-sm" name="rootDir" id="rootDir" placeholder="Enter Root Dir" value="<?php echo $codeBase->root_dir ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['rootDir']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['rootDir']['invalidChars'];?></small></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="codeBaseSubmit" class="btn btn-info btn-sm">Update</button>
                        <small class="text-danger p-1"><?php echo $result['insertError'];?></small>
                    </div>
                </form>
            </div>
            <div class="card bg-light p-2">
                <form method="post">
                    
                    <!-- LibraryName -->
                    <div class="form-group">
                        <label for="libraryName"><small>Library</small></label>
                        <input type="text" class="form-control form-control-sm" name="libraryName" id="libraryName" placeholder="Enter Library Name" value="<?php echo $_POST['libraryName'] ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryName']['invalidChars'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['libraryName']['unique'];?></small></div>
                    </div>

                    <!-- Version -->
                    <div class="form-group">
                        <label for="libraryVersion"><small>Version</small></label>
                        <input type="text" class="form-control form-control-sm" name="libraryVersion" id="libraryVersion" placeholder="Enter Version Number" value="<?php echo $_POST['libraryVersion'] ;?>"/>
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
                                    if($deliveryType->type_id == $_POST['deliveryType']){
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
                        <input type="text" class="form-control form-control-sm" name="purpose" id="purpose" placeholder="State the purpose of this library" value="<?php echo $_POST['purpose'] ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['purpose']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['purpose']['invalidChars'];?></small></div>
                    </div>

                    <!-- Script name -->
                    <div class="form-group">
                        <label for="scriptName"><small>Script Name</small></label>
                        <input type="text" class="form-control form-control-sm" name="scriptName" id="scriptName" placeholder="Enter Script Name" value="<?php echo $_POST['scriptName'] ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['scriptName']['invalidChars'];?></small></div>
                    </div>

                    <!-- Local Path -->
                    <div class="form-group">
                        <label for="localPath"><small>Local Path</small></label>
                        <input type="text" class="form-control form-control-sm" name="localPath" id="localPath" placeholder="Enter Local Path" value="<?php echo $_POST['localPath'] ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['localPath']['invalidChars'];?></small></div>
                    </div>

                    <!-- Recommended -->
                    <div class="form-group">
                        <label for="recommended"><small>Is this library recommended ?</small></label>
                        <select name="recommended" class="form-control form-control-sm">
                            <option value="">--SELECT--</option>
                            <?php
                                foreach($yesNoOptions as $option){
                                    if($option->option_id == $_POST['recommended']){
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
                                    if($option->option_id == $_POST['maintained']){
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
                                    if($option->option_id == $_POST['securityRisks']){
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
                                    if($option->license_type_id == $_POST['license']){
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
                                    if($option->option_id == $_POST['securityRisks']){
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
                        <button type="submit" name="librarySubmit" class="btn btn-info btn-sm">Add</button>
                        <small class="text-danger p-1"><?php echo $result['insertError'];?></small>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-lg-8 p-4 text-secondary">
            <?php if(count($libraries) > 0){?>
            <div class="card bg-light p-2">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th>Library</th>
                            <th>Version</th>
                            <th>Delivery</th>
                            <th>Script</th>
                            <th>Path</th>
                            <th>Maintained</th>
                            <th>Security Risk</th>
                            <th>License</th>
                            <th>Latest</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($libraries as $library){
                                $deliveryType = $librariesController->getDeliveryTypeById($library->delivery_type);
                                $status = $statusController->getStatusById($library->status);
                                if($status->title == 'Active'){
                                    $statusIcon = 'fa fa-check-circle-o text-success';
                                    $statusAction = 'disable';
                                }else{
                                    $statusIcon = 'fa fa-times text-danger';
                                    $statusAction = 'enable';
                                }
                                $maintained = $generalsController->getYesNoById($library->maintained);
                                $securityRisk = $generalsController->getYesNoById($library->security_risk);
                                $licenseType = $generalsController->getLicenseById($library->license);
                                $latestVersion = $generalsController->getYesNoById($library->latest_version);
                                echo "<tr>
                                        <td><a href=\"library.php?id=".$library->library_id."&&origin=codeBase\" class=\"text-info\">".$library->library_name."</a></td>
                                        <td>".$library->version."</td>
                                        <td>".$deliveryType->title."</td>
                                        <td>".$library->script_name."</td>
                                        <td>".$library->local_path."</td>
                                        <td>".$maintained->option_value."</td>
                                        <td>".$securityRisk->option_value."</td>
                                        <td>".$licenseType->license_type."</td>
                                        <td>".$latestVersion->option_value."</td>
                                        <td><a href=\"#\" onclick=\"updateStatus('library', '$library->library_id', '$statusAction')\"><i class=\"$statusIcon mr-1\"></i></a></td>
                                        <td class=\"text-right\"><a href=\"#\" onclick=\"deleteEntity('library', '$library->library_id', 'delete');\"><i class=\"fa fa-trash mr-1 text-danger\"></i></a></td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php } else{ ?>
                <h3 class="text-light">There are no libraries for the <span class="text-info"><?php echo $codeBase->code_base_name ; ?></span> code base right now</h3>
                <h5 class="mt-5 text-info">You can add some by using the form on this page</span></h5>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once('structure/footer.php'); ?>
<?php require_once('structure/js_scripts.php'); ?>
<?php require_once('structure/foot.php'); ?>



        
        
        
    