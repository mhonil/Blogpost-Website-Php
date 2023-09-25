
<?php
  session_start();
  ob_start();
  include("inc/db.php");
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
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>
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
          

          $loginSql    = "SELECT * FROM usersinfo WHERE email='$email' AND role=1 AND status=1 ";
          $userAth     = mysqli_query( $db , $loginSql );
          $userCount   = mysqli_num_rows($userAth);
          
          if( $userCount == 1 ){

            while( $loginRow = mysqli_fetch_array($userAth) ){

              $_SESSION['id']         = $loginRow['id'];
              $_SESSION['name']       = $loginRow['name'];
              $_SESSION['email']      = $loginRow['email'];
              $_SESSION['image']      = $loginRow['image'];
              $userPassword           = $loginRow['password'];
              $role                   = $loginRow['role'];
              $status                 = $loginRow['status'];

              
              if(  $_SESSION['email'] == $email && $userPassword == $hasspass ){
                header("Location: dashboard.php");
            }
            else if( $_SESSION['email'] != $email || $userPassword != $hasspass ){
              $_SESSION['error_msg'] = 'Your information is invalid';
              header("Location: index.php");
          }             
          else {
              $_SESSION['error_msg'] = 'Your information is invalid';
              header("Location: index.php");
          }
  

            }

        }else {
          $_SESSION['error_msg'] = 'User not found!';
          header("Location: index.php");
        }

        echo $_SESSION['image'];

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
        <a href="register.html" class="text-center">Register a new membership</a>
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
