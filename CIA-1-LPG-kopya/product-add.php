<?php  
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table']= 'products';
    $user = $_SESSION['user'];

?>



<!DOCTYPE html>
<html>
    <head>
        <title>User Management</title>
        <link rel="stylesheet" type="text/css" href="css/login.css?v=<?= time() ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://kit.fontawesome.com/39390442f3.js"></script>
    </head>
    <body>
        <div id="dashboardMainContainer">

           <?php include('partials/app-sidebar.php') ?>

           <div class="dashboard_content_container" id="dashboard_content_container">
                    <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">
                        <div class="row">
                            <div class="column column-12">
                                <h1 class="section_header"><i class="fa-solid fa-plus"></i> Create Product</h1>
                                    <div id="userAddFormContainer">
                                        <form action="database/add.php" method="POST" class="appForm">
                                            <div class="appFormInputContainer">
                                                <label for="product_name"> Product Name</label>
                                                <input type="text" class="appFormInput" id="product_name" placeholder="Enter Product Name" name="product_name" />
                                            </div>
                                            <div class="appFormInputContainer">
                                                <label for="description"> Description</label>
                                                <textarea class="appFormInput productTextAreaInput" id="description" placeholder="Enter Product Description" name="description" > </textarea>

                                            </div>
                                        
                                    
                                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add Product</button>
                                        </form>
                                            <?php 
                                            
                                                if( isset ($_SESSION['response'])) {
                                                    $response_message = $_SESSION['response']['message'];
                                                    $is_success = $_SESSION['response']['success'];
                                            ?>
                                                    <div class="responseMessage">
                                                        <p class="<?= $is_success ? 'responseMessage__success' : 'responseMessage__error'?>">
                                                            <?=$response_message ?>
                                                        
                                                        </p>
                                                    </div>
                                                <?php unset($_SESSION['response']); } ?>
                                    </div>
                            </div>
                            
                            </div>
                        </div>                                
                    </div>
            </div>
        </div>

    <script src="js/script.js"></script>
    <script src="js/jquery/jquery3.7.1.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    <script>
       function script(){

        this.initialize = function(){
            this.registerEvents();
        }

        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;
                classList = targetElement.classList


                if(classList.contains('deleteUser')){
                    e.preventDefault();
                    userId = targetElement.dataset.userid;
                    fname = targetElement.dataset.fname;
                    lname = targetElement.dataset.lname;
                    fullname = fname+' '+lname;
                    
                    BootstrapDialog.confirm({
                            type: BootstrapDialog.TYPE_DANGER,
                            message: 'Are you sure you want to delete ' + fullname + '?',
                            callback: function(isDelete){
                                if(isDelete){
                                    $.ajax({
                                        method: 'POST',
                                        data: {
                                            user_id: userId,
                                            f_name: fname,
                                            l_name: lname
                                        },
                                        url: 'database/delete-user.php',
                                        dataType: 'json',
                                        success: function(data){
                                            if(data.success){
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_SUCCESS,
                                                    message: data.message,
                                                    callback: function(){
                                                        location.reload();
                                                    }
                                                });
                                            } else {
                                                BootstrapDialog.alert({
                                                    type: BootstrapDialog.TYPE_DANGER,
                                                    message: data.message,
                                                });
                                            }
                                        }
                                    });
                                }
                            }
                        });
                }

                if(classList.contains('updateUser')){
                    e.preventDefault();

                    //Get Data
                    firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                    lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                    email = targetElement.closest('tr').querySelector('td.email').innerHTML;
                    userId = targetElement.dataset.userid;

                    BootstrapDialog.confirm({
                            title: 'Update ' + firstName + ' ' + lastName,
                            message: '<form>\
                                <div class="form-group">\
                                    <label for="firstName">First Name:</label>\
                                    <input type="text" class="form-control" id="firstName" value="'+ firstName +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="lastName">First Name:</labeltext>\
                                    <input type="text" class="form-control" id="lastName" value="'+ lastName +'">\
                                </div>\
                                <div class="form-group">\
                                    <label for="email">First Name:</label>\
                                    <input type="email" class="form-control" id="emailUpdate" value="'+ email +'">\
                                </div>\
                            </form>',
                            callback: function(isUpdate){
                                    if(isUpdate){
                                        $.ajax({
                                            method: 'POST',
                                            data: {
                                                userId: userId,
                                                f_name: document.getElementById('firstName').value,
                                                l_name: document.getElementById('lastName').value,
                                                email: document.getElementById('emailUpdate').value,
                                            },
                                            url: 'database/update-user.php',
                                            dataType: 'json',
                                            success: function(data){
                                                if(data.success){
                                                    BootstrapDialog.alert({
                                                        type: BootstrapDialog.TYPE_SUCCESS,
                                                        message: data.message,
                                                        callback: function(){
                                                            location.reload();
                                                        }
                                                    });
                                                } else {
                                                    BootstrapDialog.alert({
                                                        type: BootstrapDialog.TYPE_DANGER,
                                                        message: data.message,
                                                    });
                                                }
                                            }
                                        });
                                    }
                                }
                            
                        });
                    
                }
                  
            });
        }

       }

        var script = new script;
        script.initialize();
    </script>

    </body>
</html>


check check

