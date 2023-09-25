
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
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active"> Manage Category </li>
            </ol>
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
            
                $do = (isset($_GET['do'])) ? $_GET['do'] : "Manage";
                
                if( $do == "Manage" ){

                  ?>

                  <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Manage All Category</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                    <table class="table table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">#Sl</th>
                          <th scope="col">Picture</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>

                        <?php
                        
                          $readData   = "SELECT * FROM category WHERE cat_status = 1 ORDER BY cat_name ASC ";
                          $catData   = mysqli_query($db, $readData);
                          $total_row  = mysqli_num_rows($catData);
                          $sl         = 0;
                         
                          if($total_row != 0){

                            while($catRow = mysqli_fetch_assoc($catData)){

                              $catID           = $catRow['id'];
                              $catTitle        = $catRow['cat_name'];
                              $catDes          = $catRow['cat_desc'];
                              $catStatus       = $catRow['cat_status'];
                              $catImage        = $catRow['cat_image'];
                
                              $sl++;

                              ?>

                                <tbody>
                                  <tr>
                                    <th> <?php echo $sl; ?> </th>
                                    <td style="text-align: center;"> <?php 
                                      if( !empty( $catImage ) ){
                                        ?>
                                          <img src="dist/category-image/<?php echo $catImage; ?>" alt="" width="50" height="50">
                                        <?php
                                      } else {
                                        ?>
                                        <img src="dist/category-image/default.png" alt="" width="50" height="50">
                                      <?php
                                      }
                                    ?> </td>
                                    <td> <?php echo $catTitle; ?> </td>
                                    <td class="description" > <?php echo $catDes; ?> </td>
                                    
                                    <td>
                                      <ul class="actionBtn">
                                        <li>
                                          <a href="category.php?do=Edit&id=<?php echo $catID; ?>">
                                            <i class="fa fa-edit"></i>
                                          </a>
                                        </li>
                                        <li>
                                          <a href="category.php?do=Delete" data-toggle="modal" data-target="#deletecat<?php echo $catID ?>" >
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </li>
                                      </ul>
                                    </td>
                                  </tr>

                                  <!-- Modal -->
                                      <div class="modal fade" id="deletecat<?php echo $catID ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              <a  href="category.php?do=Delete&dcid=<?php echo $catID; ?>" class="btn btn-danger">Confirm</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  
                                </tbody>

                              <?php


                            }

                          } else {
                            echo "<div class='alert alert-warning'> No Category Found </div>";
                          }

                        ?>
                    </table>

                    </div>
                  </div>

                  
                  <a href="category.php?do=Trash">
                      <span> View Trash <i class="fa-solid fa-arrow-right" style="margin-left: 4px"></i> </span>
                    </a>


                <?php

                }

                else if( $do == "Add" ){

                    ?>

                     <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <div class="card-body" style="display: block;">

                        <form action="category.php?do=Store" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="cat-name">Catagory Name</label>
                                        <input type="text" name="cat-name" id="cat-name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Catagory Image</label>
                                        <input type="file" name="cat-image" id="image">
                                        <?php
      
                                        if( !empty($_SESSION['img_error']) ){
                                          ?>
                                              <span style="color:red;">
                                            <?php echo $_SESSION['img_error']; ?>
                                        </span>
                                          <?php
                                          unset($_SESSION['img_error']);
                                         
                                        }
                                      ?>
                                      <?php
                                      if(!empty($_SESSION['error_msg'])){
                                        ?>
                                        <span style="color:red;">
                                          <?php echo $_SESSION['error_msg']; ?>
                                      </span>
                                     <?php
                                      unset($_SESSION['error_msg']);
                                      }
                                      ?>
                                  </div>

                                  <div class="form-group">
                                        <input type="submit" name="addCategory" value="Add Cetagory" >
                                  </div>

                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="description_box" cols="30" rows="20" required>
                                        </textarea>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </form>    

                        </div>
                    </div>


                    <?php
                    
                }

                else if( $do == "Store" ){

                    if(isset($_POST['addCategory'])){

                      if(!empty($_SESSION['error_msg'])){
                        ?>
                        <span>
                          <?php echo $_SESSION['error_msg']; ?>
                      </span>
                     <?php
                      } else {

                        $catName                   = mysqli_real_escape_string($db, $_POST['cat-name']);
                        $description               = mysqli_real_escape_string($db, $_POST['description']);
                        $catImage                  = $_FILES['cat-image']['name'];
                        $image_size                = $_FILES['cat-image']['size'];
                        $file_type                 = $_FILES['cat-image']['type'];
                        $image_tmp                 = $_FILES['cat-image']['tmp_name'];
                         
                          if( !empty( $catImage ) ){
                          if($image_size < 1000000) {

                            $extensions = array("jpeg","jpg","png");
      
                            if(in_array($file_type,$extensions , FALSE)  ){
                  
                            $_SESSION['img_error'] = "please choose a JPEG or PNG file.";
                            header("Location: category.php?do=Add");          

                            }else {
                              $img    =  rand(1,99999) . '-' . $catImage;
                              move_uploaded_file($image_tmp, "dist/category-image/" . $img);
  
                              $addcatSql = "INSERT INTO category (cat_name, cat_desc, cat_image) VALUES ('$catName', '$description', '$img')";
                              $add_cat = mysqli_query($db, $addcatSql); 
    
                              if($add_cat){
                                header("Location: category.php?do=Manage");
                              }else {
                                die();
                              } 
                            }

                        }else {
                          $_SESSION['error_msg']="File size must be excately 1 MB"; 
                          header("Location: category.php?do=Add");
                        }

                         }else {
                          $img = NULL;

                          $addcatSql = "INSERT INTO category (cat_name, cat_desc) VALUES ('$catName', '$description')";
                          $add_cat = mysqli_query($db, $addcatSql); 

                          if($add_cat){
                            header("Location: category.php?do=Manage");
                          }else {
                            die();
                          }                  
                        }

                      }
                      } else {
                        die("MySql Error:" . mysqli_error($db));
                      }
                    
                }

                else if( $do == "Edit" ){

                  if(isset($_GET['id'])){
                    $editCatId = $_GET['id'];

                    $editCatSql = "SELECT * FROM category WHERE id='$editCatId'";
                    $editCat    = mysqli_query($db, $editCatSql);

                    if($editCat){

                      while($editCatRow = mysqli_fetch_array($editCat)){

                              $catID           = $editCatRow['id'];
                              $catTitle        = $editCatRow['cat_name'];
                              $catDes          = $editCatRow['cat_desc'];
                              $catStatus       = $editCatRow['cat_status'];
                              $catImage        = $editCatRow['cat_image'];

                              ?>

                      <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <div class="card-body" style="display: block;">

                        <form action="category.php?do=Update" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="editcatId" value="<?php echo $catID; ?>" >
                          <input type="hidden" name="oldcatImg" value="<?php echo $catImage; ?>" >
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="cat-name">Catagory Name</label>
                                        <input type="text" name="cat-name" id="cat-name" class="form-control" value="<?php echo $catTitle; ?>" required>
                                    </div>

                                    <div class="form-group categoryImage">
                                        <label for="image">Catagory Image</label>
                                        <?php
                                          if(!empty($catImage)){
                                            ?>
                                              <img src="dist/category-image/<?php echo $catImage; ?>" alt="" width="50" style="display:block">
                                            <?php
                                          }
                                        ?>
                                        <input type="file" name="up-image" id="image">
                                        
                                          
                                          <?php
      
                                        if( !empty($_SESSION['img_error']) ){
                                          ?>
                                              <div class="alert alert-danger">
                                                <?php echo $_SESSION['img_error']; ?>
                                              </div>
                                          <?php
                                          unset($_SESSION['img_error']);
                                        }
                                      
                                      ?>
                                      
                                      <?php 
                                        if(!empty($_SESSION['error_msg'])){
                                          ?>
                                          <span style="color:red;">
                                            <?php echo $_SESSION['error_msg']; ?>
                                        </span>
                                       <?php
                                        unset($_SESSION['error_msg']);
                                        }
                                      ?>
                                  </div>

                                  <div class="form-group">
                                        <input type="submit" name="editCategory" value="Save Changes" >
                                  </div>

                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="description_box" cols="30" rows="20" required>
                                            <?php echo $catDes?>
                                        </textarea>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </form>  
                      <div class="deleteform"> 
                        <form action="" method="POST">
                        <input type="submit" name="deleteimage" value="click">
                        <?php 
                          
                        ?>
                        </form>
                      </div>

                        </div>
                    </div>

                    <a href="category.php?do=Manage">
                      <span> Go Back <i class="fa-solid fa-arrow-right" style="margin-left: 4px"></i> </span>
                    </a>


                              <?php
                             

                      }

                    }

              
                  }

                    ?>       
                   
                    <?php

                    
                }

                else if( $do == "Update" ){

                  if(isset($_POST['editCategory'])){

                    if(!empty($_SESSION['error_msg'])){
                      ?>
                      <span>
                        <?php echo $_SESSION['error_msg']; ?>
                    </span>
                   <?php
                    } else {

                      $updateCat          = $_POST['editcatId'];
                      $updatecatTitle     = mysqli_real_escape_string($db, $_POST['cat-name']);
                      $updatecatDesc      = mysqli_real_escape_string($db, $_POST['description']);
                      $oldcatImg          = $_POST['oldcatImg'];
                      $updatecatImg       = $_FILES['up-image']['name'];
                      $image_size         = $_FILES['up-image']['size'];
                      $file_type          = $_FILES['up-image']['type'];
                    
                      if(!empty($updatecatImg)){
                        if($image_size < 1000000){
                    
                          // $extensions = array("jpeg","jpg","png");
                    
                          // if(in_array($file_type,$extensions) === TRUE){
                            if(!empty($oldcatImg)){
                              unlink("dist/category-image/" . $oldcatImg);
                            }
                    
                            $image_tmp       =  $_FILES['up-image']['tmp_name'];
                            $UPimg           =  rand(1,99999) . '-' . $updatecatImg;
                    
                            move_uploaded_file($image_tmp, "dist/category-image/" . $UPimg);
                            
                            $updateCatSql = "UPDATE category SET cat_name='$updatecatTitle', cat_desc='$updatecatDesc', cat_image='$UPimg' WHERE id = '$updateCat'";
                    
                            $updatecatData = mysqli_query($db, $updateCatSql);
                    
                            if($updatecatData){
                              header("Location: category.php?do=Manage");
                            }else {
                              die();
                            }
                    
                          // }else {
                          //     $_SESSION['img_error'] = "please choose a JPEG or PNG file.";
                          //     header("Location: category.php?do=Edit");
                          // }
                            
                        }else {
                          $_SESSION['error_msg']="File size must be excately 1 MB"; 
                          header("Location: category.php?do=Edit&id=$updateCat");
                        }
                    
                      }                       
                       else {
                        $updateCatSql = "UPDATE category SET cat_name='$updatecatTitle', cat_desc='$updatecatDesc'  WHERE id = '$updateCat'";
                    
                        $updatecatData = mysqli_query($db, $updateCatSql);
                    
                        if($updatecatData){
                          header("Location: category.php?do=Manage");
                        }else {
                          die();
                        }
                      }

                     

                    }
                  
                           
                  
                  }
                  
                    
                }

                else if( $do == "Delete" ){
                    
                  if( isset($_GET['dcid']) ){
                    $deleteCat = $_GET['dcid'];

                    $deleteSql = "UPDATE category set cat_status = 0 WHERE id='$deleteCat'";
                    $delete = mysqli_query( $db, $deleteSql );
                    if($delete){
                      header("Location: category.php?do=Manage");
                    }else {
                      die();
                    }
                  }

                }
                else if($do == "Trash"){

                  ?>

                  <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Manage Trash Category</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                    <table class="table table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">#Sl</th>
                          <th scope="col">Picture</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>

                        <?php
                        
                          $readData   = "SELECT * FROM category WHERE cat_status = 0 ORDER BY cat_name ASC ";
                          $catData   = mysqli_query($db, $readData);
                          $total_row  = mysqli_num_rows($catData);
                          $sl         = 0;
                         
                          if($total_row != 0){

                            while($catRow = mysqli_fetch_assoc($catData)){

                              $catID           = $catRow['id'];
                              $catTitle        = $catRow['cat_name'];
                              $catDes          = $catRow['cat_desc'];
                              $catStatus       = $catRow['cat_status'];
                              $catImage        = $catRow['cat_image'];
                
                              $sl++;

                              ?>

                                <tbody>
                                  <tr>
                                    <th> <?php echo $sl; ?> </th>
                                    <td style="text-align: center;"> <?php 
                                      if( !empty( $catImage ) ){
                                        ?>
                                          <img src="dist/category-image/<?php echo $catImage; ?>" alt="" width="50" height="50">
                                        <?php
                                      } else {
                                        ?>
                                        <img src="dist/category-image/default.png" alt="" width="50" height="50">
                                      <?php
                                      }
                                    ?> </td>
                                    <td> <?php echo $catTitle; ?> </td>
                                    <td class="description" > <?php echo $catDes; ?> </td>
                                    
                                    <td>
                                      <ul class="actionBtn">
                                        <li style="display:block">
                                          <a href="category.php?do=Trash&rid=<?php echo $catID; ?>">
                                            Restore
                                          </a>
                                        </li>
                                        <li style="display:block">
                                          <a href="category.php?do=Trash&pid=<?php echo $catID; ?>">
                                           Permant Delete
                                          </a>
                                        </li>
                                      </ul>
                                    </td>
                                  </tr>
                                  
                                </tbody>

                              <?php

                                if( isset($_GET['rid']) ){
                                  $restoreId = $_GET['rid'];

                                  $restoreSql    = "UPDATE category set cat_status = 1 WHERE id = '$restoreId'";
                                  $restoreCat    = mysqli_query($db,$restoreSql);

                                  if($restoreCat){
                                    header("Location: category.php?do=Manage");
                                  }else {
                                    die();
                                  }

                                }

                                if(isset($_GET['pid'])){

                                  $permantId = $_GET['pid'];

                                  $permantSql    = "DELETE FROM category WHERE id = '$permantId'";
                                  $permantCat    = mysqli_query($db,$permantSql);

                                  if($permantCat){
                                    header("Location: category.php?do=Trash");
                                  }else {
                                    die();
                                  }

                                }


                            }

                          } else {
                            echo "<div class='alert alert-warning'> No Category Found </div>";
                          }

                        ?>
                    </table>

                    </div>
                  </div>

                  
                  <a href="category.php?do=Manage">
                      <span> Go Back <i class="fa-solid fa-arrow-right" style="margin-left: 4px"></i> </span>
                    </a>


                <?php

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


<?php 
  include("inc/footer.php");
?>
