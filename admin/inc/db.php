<?php


    $dbName = 'onil_blog';
    $db_user = 'onil_blog';
    $db_pass = '';
    $db_host = 'localhost';

  $db = mysqli_connect($db_host, $db_user,$db_pass,$dbName);

  if(isset($db)){
    // echo 'yes';
  }else {
    echo die();
  }


?>