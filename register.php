<?php 
  session_start();
  ob_start();
  include "admin/inc/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="POST" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Full name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <label for="" display="block">Upload Profile</label>
        <div class="input-group mb-3"> 
        
          <div class="img">
            <img src="admin/dist/upload-image/default.png" alt="" class="defualtimg">
            <input type="file"  name="userImg" class="form-control-file">
        
          </div>
          <?php
            if(!empty($_SESSION['error_img'])){
              ?>
              <span style="color:red;">
                <?php echo $_SESSION['error_img']; ?>
            </span>
            <?php
            session_unset();
            session_destroy();
            }
            ?>

        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btnRegister" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>

        <?php
        
        
          if(isset($_POST['btnRegister'])){

              $userName              = mysqli_real_escape_string($db, $_POST['name']);
              $userEmail             = mysqli_real_escape_string($db, $_POST['email']);
              $userPassword          = mysqli_real_escape_string($db, $_POST['password']);
              $password              = sha1($userPassword);
              $userImg               = $_FILES['userImg']['name'];
              $image_size            = $_FILES['userImg']['size'];
              
               
                if( !empty( $userImg ) ){
                if($image_size < 2000000) {
                  
                    $image_tmp             = $_FILES['userImg']['tmp_name'];
                    $img    =  rand(1,99999) . '-' . $userImg;
                    move_uploaded_file($image_tmp, "admin/dist/upload-image/" . $img);

                  $addUser = "INSERT INTO usersinfo (name, email, password, role, image) VALUES ('$userName', '$userEmail', '$password', 2, '$img')";
                  $addDb   = mysqli_query($db, $addUser);

                  if($addDb){
                    header("Location: index.php");
                  }else {
                    die();
                  }

              }else {
                $_SESSION['error_img']="File size must be excately 2 MB"; 
                header("Location: register.php");
              }

               }else {

                  $addUser = "INSERT INTO usersinfo (name, email, password, role) VALUES ('$userName', '$userEmail', '$password', 2)";
                  $addDb   = mysqli_query($db, $addUser);

                  if($addDb){
                    header("Location: index.php");
                  }else {
                    die();
                  }

               }


               $_SESSION['userName']   = $userName;
               $_SESSION['userEmail']  = $userEmail;
               $_SESSION['userPass']   = $password;
               $_SESSION['userImg']    = $userImg;

            } 
        
        ?>

      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.php" class="text-center">I already have a membership <strong style='color:black;'> Log In </strong> </a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<?php
    ob_end_flush();
  ?>

</body>
</html>
