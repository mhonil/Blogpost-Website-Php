<?php
    include "inc/header.php";
?>


    <section class="userInfo">
        <div class="container">

    <?php
    
    $userid = $_SESSION['userId'];

    $sql = "SELECT * FROM usersinfo WHERE id= '$userid' ";
    $sendDb    = mysqli_query($db, $sql);
    $totalRow = mysqli_num_rows($sendDb);
    
    if( $totalRow == 1 ){

     while($imgRow = mysqli_fetch_array($sendDb)){

      $img                = $imgRow['image'];
      $_SESSION['userId'] = $imgRow['id'];
      
      if(!empty($img)){
        ?>
            <div class="removeimg">
                <img src="admin/dist/upload-image/<?php echo $img; ?>" alt="User" class="userImg">
                    <form action="" method="POST">
                        <button type="submit" name="removemg">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form> 
                        <?php
                        if(isset($_POST['removemg'])){
                            // unlink('admin/dist/upload-image/' . $img);
                            $img = NULL;
                            $removeImg = "UPDATE usersinfo SET image='$img' WHERE id = '$userid' ";
                            $removeDb   = mysqli_query($db, $removeImg);   
                            header("Location: update.php?id=$userid");
                        }
                    
                    ?>

            </div>
        <?php
      }else {
        ?>
             <div class="newimg">
                <div class="addimg">
                 <img src="admin/dist/upload-image/default.png" alt="User" class="userImg">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="newImg" id="">
                        <button type="submit">
                            <img src="admin/dist/upload-image/image.png" alt="" class="photo">
                        </button>
                        </div>
                        <input type="submit" value="Upload Picture" name="addimg">
                    </form> 
                        <?php
                        if(isset($_POST['addimg'])){

                            $image              = $_FILES['newImg']['name'];
                            $image_tmp          =  $_FILES['newImg']['tmp_name'];
                            $img                =  rand(1,99999) . '-' . $image;
                            move_uploaded_file($image_tmp, "admin/dist/upload-image/" . $img);

                            if( !empty( $image ) ){
                                $addImg = "UPDATE usersinfo SET image='$img' WHERE id = '$userid' ";
                                $addDb   = mysqli_query($db, $addImg); 
                                header("Location: update.php?id=$userid");  
                            }

                        }
                    
                    ?>

            </div>
        <?php
      }

     }

    }
    
    ?>

    <h2>
        <?php 

            $userid = $_SESSION['userId'];

            $sql = "SELECT * FROM usersinfo WHERE id= '$userid' ";
            $sendDb    = mysqli_query($db, $sql);
            $totalRow = mysqli_num_rows($sendDb);

            if( $totalRow == 1 ){ 
                while($nameRow = mysqli_fetch_array($sendDb)){
                    $userName = $nameRow['name'];
                    echo $userName;
                }
            }

        ?>
    </h2>

        <?php
        
            if( isset($_GET['id']) ){

                $user = $_GET['id'];
                $userSql = "SELECT * FROM usersinfo WHERE id = $user";
                $userDb = mysqli_query($db, $userSql);
                $Total_row = mysqli_num_rows($userDb);
                
                if($Total_row == 1){

                    while( $userRow = mysqli_fetch_array($userDb) ){

                        $id         = $userRow['id'];
                        $name       = $userRow['name'];
                        $email      = $userRow['email'];
                        $password   = $userRow['password'];
                        $phone      = $userRow['phone'];
                        $address    = $userRow['address'];

                        ?>

                        <form action="" method="POST">
                          <div class="row">
                            <input type="hidden" name="updateUser" value="<?php echo $id; ?>">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" value="<?php echo $name; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="You have no number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="address">Your Address</label>
                                    <input type="text" name="address" id="address" value="<?php echo $address; ?>" placeholder="You have no Address">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password"  placeholder="*******">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="repassword">Re Type Password</label>
                                    <input type="password" name="repassword" id="repassword" placeholder="*******">
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit" name="changeUser" value="SAVE CHANGES" class="btn-main">
                            </div>
                          </div>

                          <?php
                            if(!empty($_SESSION['error'])){
                                ?>
                                <span style='color: red;text-align:center;display:block;font-weight: 500;'>
                                    <?php echo $_SESSION['error'] . "!"; ?>
                                </span>
                            <?php
                            unset($_SESSION['error']);
                            }
                            ?>

                        </form>

                        <?php



                    }

                }

            }
        
        ?>
        </div>
    </section>   

    <?php
    
            if( isset($_POST['changeUser']) ){

                if(!empty($_SESSION['error'])){

                    ?>
                      <span>
                        <?php echo $_SESSION['error']; ?>
                    </span>
                   <?php

                }else {

                $upId            = $_POST['updateUser'];
                $upName          = mysqli_real_escape_string($db, $_POST['name']);
                $upEmail         = mysqli_real_escape_string($db, $_POST['email']);
                $upPhone         = mysqli_real_escape_string($db, $_POST['phone']);
                $upAddress       = mysqli_real_escape_string($db, $_POST['address']);
                $upPass          = mysqli_real_escape_string($db, $_POST['password']);
                $rePass          = mysqli_real_escape_string($db, $_POST['repassword']);

                if( !empty($upPass) ){

                   if( $upPass == $rePass ){

                    $pass = sha1($upPass);
                    $updateSql = " UPDATE usersinfo SET name='$upName', email='$upEmail', password='$pass', phone='$upPhone', address='$upAddress' WHERE id = '$upId' ";
                    $upDb    = mysqli_query($db, $updateSql);

                    if($updateSql){
                        header("Location: update.php");

                    }else {
                        die();
                    }

                   }else {
                    $id = $_SESSION['userId'];
                     $_SESSION['error'] = "password doesn't match";
                     header("Location: update.php?id=$id");
                   }

                }else {
                    $updateSql = " UPDATE usersinfo SET name='$upName', email='$upEmail', phone='$upPhone', address='$upAddress' WHERE id = '$upId' ";
                    $upDb      = mysqli_query($db, $updateSql);
                    
                    if($updateSql){
                        header("Location: update.php");
                    }else {
                        die();
                    }
                }
            }

            }
    
    ?>


<?php
    include "inc/footer.php";
?>