
<?php 
  include("inc/header.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
            <?php
            
                $do = (isset( $_GET['do'] )) ? $_GET['do'] : 'Manage' ;

                if( $do == 'Manage' ){
                   
                  ?>

                    <div class="card card-primary">
                      <div class="card-header">
                      <h3 class="card-title">Manage All Users</h3>
                      </div>
                      
                      <div class="card-body" style="display: block;">
                      <table class="table table table-bordered table-striped">
                        <thead class="table-dark">
                          <tr>
                            <th scope="col">#Sl</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">User Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>

                          <?php
                          
                            $readData   = "SELECT * FROM usersinfo  ORDER BY name ASC ";
                            $userData   = mysqli_query($db, $readData);
                            $total_row  = mysqli_num_rows($userData);
                            $sl         = 0;
                           
                            if($total_row != 0){

                              while($userRow = mysqli_fetch_assoc($userData)){

                                $userID         = $userRow['id'];
                                $userName       = $userRow['name'];
                                $userEmail      = $userRow['email'];
                                $userPassword   = $userRow['password'];
                                $userPhone      = $userRow['phone'];
                                $userAddress    = $userRow['address'];
                                $role           = $userRow['role'];
                                $userStatus     = $userRow['status'];
                                $userImage      = $userRow['image'];
                  
                                $sl++;

                                ?>

                                  <tbody>
                                    <tr>
                                      <th> <?php echo $sl; ?> </th>
                                      <td style="text-align: center;"> <?php 
                                        if( !empty( $userImage ) ){
                                          ?>
                                            <img src="dist/upload-image/<?php echo $userImage; ?>" alt="" width="50" height="50">
                                          <?php
                                        } else {
                                          ?>
                                          <img src="dist/upload-image/default.png" alt="" width="50" height="50">
                                        <?php
                                        }
                                      ?> </td>
                                      <td> <?php echo $userName; ?> </td>
                                      <td> <?php echo $userEmail; ?> </td>
                                      <td> <?php echo $userPhone; ?> </td>
                                      <td> <?php echo $userAddress; ?> </td>
                                      <td> <?php 
                                          if( $role == 1 ){

                                            echo "<span style='color:#c82333;'>Admin</span";

                                          }else if($role == 2) {

                                            echo "User";

                                          }
                                      ?> </td>
                                      <td style="text-align:center;"> <?php 
                                          if($userStatus == 1){

                                            echo "<span class=\" badge badge-success \">Active</span>";

                                          } else if($userStatus == 0) {

                                            echo "<span class=\" badge badge-danger \">Inactive</span>";

                                          }
                                      ?> </td>
                                      <td>
                                        <ul class="actionBtn">
                                          <li>
                                            <a href="user.php?do=Edit&id=<?php echo $userID; ?>">
                                              <i class="fa fa-edit"></i>
                                            </a>
                                          </li>
                                          <li>
                                            <a href="user.php?do=Delete" data-toggle="modal" data-target="#deleteuser<?php echo $userID ?>" >
                                              <i class="fa fa-trash"></i>
                                            </a>
                                          </li>
                                        </ul>
                                      </td>
                                    </tr>

                                    <!-- Modal -->
                                        <div class="modal fade" id="deleteuser<?php echo $userID ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are Your Sure?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                              <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                                <a  href="user.php?do=Delete&did=<?php echo $userID; ?>" class="btn btn-danger">Confirm</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    
                                  </tbody>

                                <?php


                              }

                            } else {
                              echo "<div class='alert alert-warning'> No User Found </div>";
                            }

                          ?>
                      </table>
                      </div>
                    </div>

                  <?php
                } 

                else if( $do == 'Add' ) {
                   
                  ?>

                  <div class="card card-primary">
                      <div class="card-header">
                      <h3 class="card-title"> Add New User</h3>
                      </div>
                      
                      <div class="card-body" style="display: block;">
                        <form action="user.php?do=Store" method="POST" enctype="multipart/form-data" class="addUser">
                            <div class="row g-lg-5">
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" placeholder="Write Your Name"   required>
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="Enter Your Email"  required>
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter Your Number" >
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="address">Your Address</label>
                                    <input type="text" name="address" id="address" placeholder="Write Your Address" >
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="Password">Your Password</label>
                                    <input type="Password" name="password" id="Password" placeholder="Enter Your Password" maxlength="6"  required>
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="re-type">Re-Type Password</label>
                                    <input type="Password" name="reType" id="re-type" placeholder="ReType Password" maxlength="6"   required>
                                  </div>
                              </div>
                              
                              <div class="col-lg-4 mb-3">
                                  <div class="form-group">
                                    <label for="role">User Role</label>
                                    <select name="role" id="role" required>
                                        <option value=''>Select User Role</option>
                                        <option value="1"> Admin </option>
                                        <option value="2"> User </option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-lg-4 mb-3">
                                  <div class="form-group">
                                    <label for="status">Account Status</label>
                                    <select name="status" id="status" required>
                                        <option value=''>Select User Status</option>
                                        <option value="1"> Active </option>
                                        <option value="0"> Inactive </option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-lg-4 mb-3">
                                  <div class="form-group">
                                    <label for="image">Choose Image</label>
                                    <input type="file" name="image" id="image">
                                  </div>
                              </div>

                              <input type="submit" value="Submit" name="btnSubmit">
                                
                            </div>
                        </form>
                      </div>
                    </div>

                  <?php

                } 

                else if( $do == 'Store' ) {
                    
                  if(isset($_POST['btnSubmit'])){

                    $name               = mysqli_real_escape_string($db, $_POST['name']);
                    $email              = mysqli_real_escape_string($db, $_POST['email']);
                    $password           = mysqli_real_escape_string($db, $_POST['password']);
                    $re_typePassword    = mysqli_real_escape_string($db, $_POST['reType']);
                    $phone              = mysqli_real_escape_string($db, $_POST['phone']);
                    $address            = mysqli_real_escape_string($db, $_POST['address']);
                    $userRole           = mysqli_real_escape_string($db, $_POST['role']);
                    $status             = mysqli_real_escape_string($db, $_POST['status']);
                    $image              =  $_FILES['image']['name'];

                    if( $password == $re_typePassword ){
                      $hassedPass = sha1($password);

                      if( !empty($image) ){
                        
                        $image_tmp     =  $_FILES['image']['tmp_name'];
                        $img           =  rand(1,99999) . '-' . $image;

                        move_uploaded_file($image_tmp, "dist/upload-image/" . $img);

                      }else {
                        $img = NULL;
                      }

                      if($userRole == 1 || $userRole == 2 &&  $status = 1 || $status == 0){

                        // user info sent into database
                      $addSql = "INSERT INTO usersinfo (name, email, password, phone, address, role, status, image) VALUES ('$name' , '$email' , '$hassedPass' , '$phone' , '$address', '$userRole', '$status', '$img')";

                      $addUser = mysqli_query($db, $addSql); 
                      if($addUser){
                        header("Location: user.php?do=Manage");
                      }else {
                        die();
                      }
                      
                      }else {
                        echo "<h3>Please Select the user role and user status</h3>  <br>"; ?> 
                        <a href="user.php?do=Add" style="display:block;">Go Back</a> <?php
                      }
                     
                      
                    }else {
                      $_SESSION['inncor'] =  "<h3 class=\"password\">Password Does't Macth!</h3>";
                      echo $_SESSION['inncor'];
                    }

                  }

                } 

                else if( $do == 'Edit' ) {
                    
                  if(isset($_GET['id'])){
                    $userID = $_GET['id'];

                    $editSql = "SELECT * FROM usersinfo WHERE id='$userID' ";
                    $editData = mysqli_query($db, $editSql);

                    // loop start
                    while($userRow = mysqli_fetch_array($editData)){

                      $userID         = $userRow['id'];
                      $userName       = $userRow['name'];
                      $userEmail      = $userRow['email'];
                      $userPassword   = $userRow['password'];
                      $userPhone      = $userRow['phone'];
                      $userAddress    = $userRow['address'];
                      $role           = $userRow['role'];
                      $userStatus     = $userRow['status'];
                      $userImage      = $userRow['image'];

                      ?>
                      
                      <div class="card card-primary">
                      <div class="card-header">
                      <h3 class="card-title"> Change User Information </h3>
                      </div>
                      
                      <div class="card-body" style="display: block;">
                        <form action="user.php?do=Update" method="POST" enctype="multipart/form-data" class="addUser">

                        <input type="hidden" name="updateId" value="<?php echo $userID; ?>">
                        <input type="hidden" name="oldImg" value="<?php echo $userImage; ?>">

                            <div class="row g-lg-5">
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" placeholder="Write Your Name" value="<?php echo $userName; ?>"  required>
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="Enter Your Email" value="<?php echo $userEmail; ?>" <?php 
                                      if( $role == 2 ){
                                        echo "readonly";
                                      }
                                    ?> >
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter Your Number" value="<?php echo $userPhone; ?>" >
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="address">Your Address</label>
                                    <input type="text" name="address" id="address" placeholder="Write Your Address" value="<?php echo $userAddress; ?>" >
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="Password">Your Password</label>
                                    <input type="Password" name="password" id="Password" placeholder="*******">
                                  </div>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <div class="form-group">
                                    <label for="re-type">Re-Type Password</label>
                                    <input type="Password" name="reType" id="re-type" placeholder="*******" >
                                  </div>
                              </div>
                              
                              <div class="col-lg-4 mb-3">
                                  <div class="form-group">
                                    <label for="role">User Role</label>
                                    <select name="role" id="role" required>
                                      <option value=''>Select User Role</option>
                                        <option value="1" <?php 
                                          if ($role == 1){ 
                                            echo "selected";
                                           }
                                        ?> > Admin </option>
                                        <option value="2" <?php 
                                          if ($role == 2){ 
                                            echo "selected";
                                           }
                                        ?> > User </option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-lg-4 mb-3">
                                  <div class="form-group">
                                    <label for="status">Account Status</label>
                                    <select name="status" id="status" required>
                                        <option value=''>Select Account Status</option>
                                        <option value="1" <?php 
                                          if($userStatus == 1){
                                            echo "selected";
                                          }
                                        ?> > Active </option>
                                        <option value="0" <?php 
                                          if($userStatus == 0){
                                            echo "selected";
                                          }
                                        ?> > Inactive </option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-lg-4 mb-3">
                                  <div class="form-group">
                                    <label for="image">Choose Image</label>
                                      <?php 
                                        if(!empty($userImage)){
                                          ?>
                                            <img src="dist/upload-image/<?php echo $userImage; ?>" alt="" width="50" style="display:block">
                                          <?php
                                        }
                                      ?>
                                    <input type="file" name="image" id="image">
                                  </div>
                              </div>

                              <input type="submit" value="Save Changes" name="btnUpdate">

                            </div>
                        </form>
                      </div>
                    </div>

                    <?php
                      
                    }
                    // loop end

                  }

                }

                 else if( $do == 'Update' ) {
                    
                  // user data update
                  if(isset( $_POST['btnUpdate'] )){

                    $updateUser         = $_POST['updateId'];
                    $name               = mysqli_real_escape_string($db, $_POST['name']);
                    $email              = mysqli_real_escape_string($db, $_POST['email']);
                    $password           = mysqli_real_escape_string($db, $_POST['password']);
                    $re_typePassword    = mysqli_real_escape_string($db, $_POST['reType']);
                    $phone              = mysqli_real_escape_string($db, $_POST['phone']);
                    $address            = mysqli_real_escape_string($db, $_POST['address']);
                    $userRole           = mysqli_real_escape_string($db, $_POST['role']);
                    $status             = mysqli_real_escape_string($db, $_POST['status']);
                    $oldImage           = $_POST['oldImg'];
                    $image              = $_FILES['image']['name'];

                    
                    //image & password
                    if( !empty($password) && !empty($image) ){

                      if( !empty($oldImage) ){
                        unlink('dist/upload-image/' . $oldImage);
                      }

                        $image_tmp     =  $_FILES['image']['tmp_name'];
                        $img           =  rand(1,99999) . '-' . $image;
                        move_uploaded_file($image_tmp, "dist/upload-image/" . $img);


                      if( $password == $re_typePassword ){
                        $hassedPass = sha1($password);

                       if( $userRole == 1 ){

                        $updateData = "UPDATE usersinfo SET name='$name', email='$email', password='$hassedPass', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                       }else if ($userRole == 2) {

                        $updateData = "UPDATE usersinfo SET name='$name', password='$hassedPass', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                       }

                      
                      }else {
                        echo "<h3>Password Does't Macth!</h3>";
                      }


                    }
                    // password
                    else if( !empty($password) && empty($image) ){

                      if( $password == $re_typePassword ){
                        $hassedPass = sha1($password);

                        if($userRole == 1){

                        $updateData = "UPDATE usersinfo SET name='$name', email='$email', password='$hassedPass', phone='$phone', address='$address',           role='$userRole', status='$status' WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                        } else if($userRole == 2){

                        $updateData = "UPDATE usersinfo SET name='$name', password='$hassedPass', phone='$phone', address='$address',           role='$userRole', status='$status' WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                        }


                      }else {
                        echo "<h3>Password Does't Macth!</h3>";
                      }

                    }
                    // image
                    else if( empty($password) && !empty($image) ){

                      if( !empty($oldImage) ){
                        unlink('dist/upload-image/' . $oldImage);
                      }

                        $image_tmp     =  $_FILES['image']['tmp_name'];
                        $img           =  rand(1,99999) . '-' . $image;
                        move_uploaded_file($image_tmp, "dist/upload-image/" . $img);

                      if($userRole == 1){

                        $updateData = "UPDATE usersinfo SET name='$name', email='$email', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                      } else if($userRole == 2){

                        $updateData = "UPDATE usersinfo SET name='$name', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                      }

                     

                    }

                    // without image or password
                    else {
                     
                      if($userRole == 1){

                        $updateData = "UPDATE usersinfo SET name='$name', email='$email',  phone='$phone', address='$address', role='$userRole', status='$status'  WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                      } else if($userRole == 2){

                        $updateData = "UPDATE usersinfo SET name='$name', phone='$phone', address='$address', role='$userRole', status='$status'  WHERE id='$updateUser'";

                        $update = mysqli_query( $db, $updateData );
                        if($update){
                          header("Location: user.php?do=Manage");
                        }else {
                          die();
                        }

                      }
                      
                    }
                    
                  }


                }

                 else if( $do == 'Delete' ) {
                   
                  if( isset($_GET['did']) ){
                    $deleteUser = $_GET['did'];

                    $deleteSql = "DELETE FROM usersinfo WHERE id='$deleteUser' ";
                    $delete = mysqli_query( $db, $deleteSql );
                    if($delete){
                      header("Location: user.php?do=Manage");
                    }else {
                      die();
                    }
                  }

                }

                else {
                  echo "<span class=notfound> Page Not Found </span>";
                }
            ?>
            

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php 
  include("inc/footer.php");
?>
