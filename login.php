
<?php
  session_start();
  ob_start();
  include("admin/inc/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
 
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php
      
        if( !empty($_SESSION['error_msg']) ){
          ?>
              <div class="alert alert-danger">
                <?php echo $_SESSION['error_msg']; ?>
              </div>
          <?php
          session_unset();
          session_destroy();
        }
      
      ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" maxlength="6" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="loginBtn" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php
      
        if(isset($_POST['loginBtn'])){

          $email       = mysqli_real_escape_string($db , $_POST['email']);
          $password    = mysqli_real_escape_string($db , $_POST['password']);
          $hasspass    = sha1($password);         

          $loginSql    = "SELECT * FROM usersinfo WHERE email='$email' AND status = 1 ";
          $userAth     = mysqli_query( $db , $loginSql );
          $userCount   = mysqli_num_rows($userAth);
          
          if( $userCount == 1 ){

            while( $loginRow = mysqli_fetch_array($userAth) ){

              $_SESSION['userId']            = $loginRow['id'];
              $_SESSION['userName']          = $loginRow['name'];
              $_SESSION['userEmail']         = $loginRow['email'];
              $_SESSION['userImg']           = $loginRow['image'];
              $userPassword                  = $loginRow['password'];
              $status                        = $loginRow['status'];
             
              
              if(  $_SESSION['userEmail'] == $email && $userPassword == $hasspass ){
                if(isset($_GET['lp'])){
                  $postPage = $_GET['lp'];

                  header("Location: single.php?p=$postPage");

                }else if (isset($_GET['lc'])){
                  $CatPage = $_GET['lc'];

                  header("Location: category.php?cid=$CatPage");

                }
                else {
                  header("Location: index.php");
                }
                             
            }
            else if( $_SESSION['userEmail'] != $email || $userPassword != $hasspass ){
              $_SESSION['error_msg'] = 'Your information is invalid';
              if(isset($_GET['lp'])){
                $postPage = $_GET['lp'];

                header("Location: login.php?lp=$postPage");

              }else if (isset($_GET['lc'])){
                $CatPage = $_GET['lc'];

                header("Location: login.php?lc=$CatPage");

              }else {
                header("Location: login.php");
              }
          }             
          else {
              $_SESSION['error_msg'] = 'Your information is invalid';
              if(isset($_GET['lp'])){
                $postPage = $_GET['lp'];

                header("Location: login.php?lp=$postPage");

              }else if (isset($_GET['lc'])){
                $CatPage = $_GET['lc'];

                header("Location: login.php?lc=$CatPage");

              }
              else {
                header("Location: login.php");
              }
          }
  

            }
            

        }else {
          $_SESSION['error_msg'] = 'User not found!';
          if(isset($_GET['lp'])){
            $postPage = $_GET['lp'];

            header("Location: login.php?lp=$postPage");

          }else if (isset($_GET['lc'])){
            $CatPage = $_GET['lc'];

            header("Location: login.php?lc=$CatPage");

          }
          else {
            header("Location: login.php");
          }
        }  

      }
      
      
      ?>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership <strong style='color:black;'> Sign In </strong></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

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
