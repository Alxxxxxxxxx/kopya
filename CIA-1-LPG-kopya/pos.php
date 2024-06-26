<?php  
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Point of Sales</title>
        <link rel="stylesheet" type="text/css" href="css/login.css?v=<?= time() ?>">
        <script src="https://kit.fontawesome.com/39390442f3.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="dashboardMainContainer">
                  <?php include('partials/app-sidebar.php') ?>

            <div class="dashboard_content_container" id="dashboard_content_container">
                  <?php include('partials/app-topnav.php') ?>

                <div class="dashboard_content">
                    <div class="dashboard_content_main">

                        <div class="row">
                            <div class="column column-7">                                
                                <div class="searchInputContainer">
                                    <input type="text" placeholder="Search Product...">
                                </div> 
                                <div class="searchResultContainer">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="productResultContainer">
                                                <img src="images/sakto.png" alt="">
                                                <div class="productInfoContainer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="productName">1.5kg Sakto</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p class="productPrice"> P155.00</p>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="productResultContainer">
                                                <img src="images/11kg.png" alt="">
                                                <div class="productInfoContainer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="productName">11kg Cylinder</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p class="productPrice"> P1016.00</p>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="productResultContainer">
                                                <img src="images/50kg.png" alt="">
                                                <div class="productInfoContainer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="productName">50kg Cylinder</p>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p class="productPrice"> P000.00</p>
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    
                                    </div>  
                                </div> 
                            </div>
                            <div class="column column-5 posOrderContainer">
                                <div class="pos_header">
                                    <div class="setting">
                                        <a href="javascript:void(0)"><i class="fa fa-gear"> </i></a>
                                    </div>
                                    <p class="logo">IMS</p>
                                    <p class="timeAndDate">June 25, 2024    7:00PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
         <script src="js/script.js"> </script>
        
    </body>
</html>
