<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    $usersController = new Users();
    $statusController = new Statuses();
    $codeBasesController = new CodeBases();
    $generalsController = new Generals();
    $codeBases = $codeBasesController->getCodeBases();

    if(isset($_POST["submit"])){
        $result = $codeBasesController->add($_POST);
    }

    
    
?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">Code Bases</h1>
    <div class="row pt-4">
        <p class="pl-3 text-info">Create and Manage Code Bases</p>
    </div>
    <div class="row p-3 blueBG">
        <div class="col-lg-4 p-4 text-secondary">
            <div class="card bg-light p-2">
                <form method="post">

                    <!-- CodeBaseName -->
                    <div class="form-group">
                        <label for="codeBaseName"><small>Code Base</small></label>
                        <input type="text" class="form-control form-control-sm" name="codeBaseName" id="codeBaseName" placeholder="Enter Code Base Name" value="<?php echo $_POST['codeBaseName'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['codeBaseName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['codeBaseName']['invalidChars'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['codeBaseName']['unique'];?></small></div>
                    </div>

                    <!-- ServerAddress -->
                    <div class="form-group">
                        <label for="serverAddress"><small>Server Address</small></label>
                        <input type="text" class="form-control form-control-sm" name="serverAddress" id="serverAddress" placeholder="Enter Server Address" value="<?php echo $_POST['serverAddress'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['serverAddress']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['serverAddress']['invalidChars'];?></small></div>
                    </div>

                    <!-- RootDirectory -->
                    <div class="form-group">
                        <label for="rootDir"><small>Root Directory</small></label>
                        <input type="text" class="form-control form-control-sm" name="rootDir" id="rootDir" placeholder="Enter Root Dir" value="<?php echo $_POST['rootDir'];?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['rootDir']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['rootDir']['invalidChars'];?></small></div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-sm">Add</button>
                        <small class="text-danger p-1"><?php echo $result['insertError'];?></small>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8 p-4 text-secondary">
            <div class="card bg-light p-2">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th>Code Base</th>
                            <th>Server</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($codeBases as $codeBase){
                                
                                $status = $statusController->getStatusById($codeBase->status);
                                if($status->title == 'Active'){
                                    $statusIcon = 'fa fa-check-circle-o text-success';
                                    $statusAction = 'disable';
                                }else{
                                    $statusIcon = 'fa fa-times text-danger';
                                    $statusAction = 'enable';
                                }
                                echo "<tr>
                                            <td><a href=\"codeBase.php?id=".$codeBase->code_base_id."\" class=\"text-info\">".$codeBase->code_base_name."</a></td>
                                            <td>".$codeBase->server_address."</td>
                                            <td><a href=\"#\" onclick=\"updateStatus('codeBase', '$codeBase->code_base_id', '$statusAction')\"><i class=\"$statusIcon mr-1\"></i></a></td>
                                            <td class=\"text-right\">
                                                <a href=\"#\" onclick=\"deleteEntity('codeBase', '$codeBase->code_base_id', 'delete');\"><i class=\"fa fa-trash mr-1 text-danger\"></i></a>
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



        
        
        
    