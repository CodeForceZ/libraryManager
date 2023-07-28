<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    $usersController = new Users();
    $statusController = new Statuses();
    $librariesController = new Libraries();
    $codeBasesController = new CodeBases(); 
    $generalsController = new Generals(); 
    $libraries = $librariesController->getLibraries();
    
    if(isset($_POST["submit"])){
        $result = $codeBasesController->add($_POST);
    }

    
    
?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">All Libraries</h1>
    <div class="row pt-4">
        <p class="pl-3 text-info">Manage Libraries</p>
    </div>
    <div class="row p-3 blueBG">
        <div class="col-lg-12 p-4 text-secondary">
            <div class="card bg-light p-2">
                <table class="table table-light table-hover">
                    <thead>
                        <tr>
                            <th>Codebase</th>
                            <th>Server</th>
                            <th>Library Name</th>
                            <th>Version</th>
                            <th>Latest</th>
                            <th>Delivery</th>
                            <th>Dependency Count</th>
                            <th>Parency Count</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($libraries as $library){
                                $codeBase = $codeBasesController->getCodeBaseById($library->code_base_id);
                                $deliveryType = $librariesController->getDeliveryTypeById($library->delivery_type);
                                $status = $statusController->getStatusById($library->status);
                                $dependencyCount = $librariesController->getCountOfDependencies($library->library_id);
                                $parencyCount = $librariesController->getCountOfParencies($library->library_id);
                                $latestVersion = $generalsController->getYesNoById($library->latest_version);

                                if($status->title == 'Active'){
                                    $statusIcon = 'fa fa-check-circle-o text-success';
                                    $statusAction = 'disable';
                                }else{
                                    $statusIcon = 'fa fa-times text-danger';
                                    $statusAction = 'enable';
                                }
                                echo "<tr>
                                            <td>".$codeBase->code_base_name."</td>            
                                            <td>".$codeBase->server_address."</td>
                                            <td><a href=\"library.php?id=".$library->library_id."&&origin=libraries\" class=\"text-info\">".$library->library_name."</a></td>
                                            <td>".$library->version."</td>
                                            <td>".$latestVersion->option_value."</td>
                                            <td>".$deliveryType->title."</td>
                                            <td>".$dependencyCount->total."</td>
                                            <td>".$parencyCount->total."</td>
                                            <td><a href=\"#\" onclick=\"updateStatus('library', '$library->library_id', '$statusAction')\"><i class=\"$statusIcon mr-1\"></i></a></td>
                                            <td class=\"text-right\">
                                                <a href=\"#\" onclick=\"deleteEntity('library', '$library->library_id', 'delete');\"><i class=\"fa fa-trash mr-1 text-danger\"></i></a>
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



        
        
        
    