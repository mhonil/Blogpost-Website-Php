<?php 
  session_start();
  ob_start();
  include "admin/inc/db.php";
?>
 <?php

  if( !empty($_SESSION['userName']) || !empty($_SESSION['userEmail']) ){

    $name    = $_SESSION['userName'];
    $emailId = $_SESSION['userEmail'];
  
    $statusSql = "SELECT * FROM usersinfo WHERE name='$name' AND email='$emailId'";
    $sendDb    = mysqli_query( $db, $statusSql );
  
    while( $statusRow = mysqli_fetch_array( $sendDb ) ){
  
        $userStatus = $statusRow['status'];
  
        if( $userStatus == 0 ){

          ob_start();
          session_start();
          session_unset();
          session_destroy();
          header("Location: index.php");
          ob_end_flush();
    
      }
  
    }

  }


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Description -->
    <meta name="description" content="Blue Chip: Corporate Multi Purpose Business Template" />
    <meta name="author" content="Blue Chip" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/favicon.png" />

    <title>Blog Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

    <!-- Flat Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- Fency Box CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.min.css">

    <!-- Theme Main Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>

  <body>
    <!-- :::::::::: Header Section Start :::::::: -->

    <header>
         <div class="container">
          <div class="row">
           <div class="col-lg-12">
           <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"><img src="assets/images/favicon/favicon.png" alt="" width="50"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php  
            
            $readData   = "SELECT * FROM category WHERE cat_status = 1 ORDER BY cat_name ASC";
             $catData   = mysqli_query($db, $readData);

             while($catRow = mysqli_fetch_assoc($catData)){
              $catID           = $catRow['id'];
              $catTitle        = $catRow['cat_name'];

              ?>
                <li class="nav-item"> 
                <a class="nav-link <?php
                  if( isset($_GET['cid']) ){

                    $menuId = $_GET['cid'];
                    if( $catID == $menuId ){
                      echo 'add';
                    }
                    
                  }
                ?> " aria-current="page" href="category.php?cid=<?php echo $catID; ?>" ><?php echo $catTitle; ?></a>
              </li>
              <?php

             }
            
            ?>

            <li class="nav-item">
              <?php
                if( empty($_SESSION['userEmail']) || empty($_SESSION['userName']) )  {
                 ?>
                    <a href="register.php" class="nav-link btn-login">
                       Sign In
                    </a>
                    <?php
                      
                      ?>
                    <a href="login.php<?php if(isset($_GET['p'])){$postPage = $_GET['p'];echo "?lp=" . $postPage;}else if(isset($_GET['cid'])){$categoryPage = $_GET['cid']; echo "?lc=" . $categoryPage;} ?>" class="nav-link btn-login">
                      Log In
                    </a>
                 <?php
                }
              ?>
              
            </li>

                <li class="nav-item dropdown">
                  
                    <?php

                  if(!empty($_SESSION['userEmail'])){

                    $name    = $_SESSION['userName'];
                    $emailId = $_SESSION['userEmail'];

                    $sql = "SELECT * FROM usersinfo WHERE name='$name' AND email='$emailId' ";
                    $sendDb    = mysqli_query($db, $sql);
                    $totalRow = mysqli_num_rows($sendDb);

                    if( $totalRow == 1 ){

                    while($idRow = mysqli_fetch_array($sendDb)){

                    $_SESSION['userId'] = $idRow['id'];

                    }

                    }

                    ?>
                      <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php

                      $user    = $_SESSION['userId'];
    
                      $sql = "SELECT * FROM usersinfo WHERE id = '$user' ";
                      $sendDb    = mysqli_query($db, $sql);
                      $totalRow = mysqli_num_rows($sendDb);
                      
                      if( $totalRow == 1 ){

                       while($imgRow = mysqli_fetch_array($sendDb)){

                        $img  = $imgRow['image'];

                        if(!empty($img)){
                          ?>
                            <img src="admin/dist/upload-image/<?php echo $img; ?>" alt="User" class="userImg">
                          <?php
                        }else {
                          ?>
                              <img src="admin/dist/upload-image/default.png" alt="User" class="userImg">
                          <?php
                        }

                       }

                      }

                  }
                  
                     
                    ?>
                  </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                          if(empty($_SESSION['userEmail'])){
                            ?>
                              <a href="login.php" class="dropdown-item"> Log In </a>
                            <?php
                          }
                        ?>
                        <a href="update.php?id=<?php echo  $_SESSION['userId']; ?>" class="dropdown-item"> Update Porfile </a>
                        <?php
                          if(!empty($_SESSION['userEmail'])){
                            ?>
                               <a href="logoutuser.php<?php if(isset($_GET['p'])){$postPage = $_GET['p'];echo "?lg=" . $postPage;}else if(isset($_GET['cid'])){$categoryPage = $_GET['cid']; echo "?lgc=" . $categoryPage;} ?>" class="dropdown-item"> Log Out </a>
                            <?php
                          }
                        ?>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
           </div>
          
          </div>
         </div>
    </header>
    
    <!-- ::::::::::: Header Section End ::::::::: -->