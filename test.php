<?php 
    require_once('bootstrap.php');
    checkSessionUserId();

    

    $testsController = new Tests();
    $formGenerator = new FormGenerator();
    

    $firstName = 'text, form-control, firstName, firstName, Enter First Name, required|invalidChars|unique';
    // $firstName = [];
    // $firstName['type'] = 'text';
    // $firstName['class'] = 'form-control';
    // $firstName['name'] = 'firstName';
    // $firstName['id'] = 'firstName';
    // $firstName['placeholder'] = 'Enter First Name';
    // $firstName['validations'] = 'required|invalidChars|unique';
    
    $fields = [];
    $fields[] = $firstName;


    $form = $formGenerator->generateForm('post', $fields);

    $data = [];
    if(isset($_POST["submit"])){
        
    }

?>



<?php require_once('structure/head.php'); ?>
<?php require_once('structure/navbar.php'); ?>

<div class="container-fluid p-5">
    <h1 class="display-4 text-light">Test</h1>
    <div class="row pt-4">
        <p class="pl-3 text-info">Test Space</p>
    </div>
    <div class="row p-1">
        <div class="col-lg-3 col-md-4 col-sm-6 p-1 text-secondary  bg-secondary">
            <div class="card bg-light p-2">
                <form method="post">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter First Name" value="<?php echo $_POST['firstName'] ;?>"/>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['required'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['invalidChars'];?></small></div>
                        <div class="text-danger pl-1"><small><?php echo $result['firstName']['unique'];?></small></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info">Save</button>
                        <small class="text-danger p-1"><?php echo $data['insertError'];?></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('structure/footer.php'); ?>
<?php require_once('structure/js_scripts.php'); ?>
<?php require_once('structure/foot.php'); ?>



        
        
        
    