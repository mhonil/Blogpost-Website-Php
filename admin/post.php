
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
                    <h3 class="card-title">Manage All Post</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                    <table class="table table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">#Sl</th>
                          <th scope="col">Picture</th>
                          <th scope="col">Post Title</th>
                          <th scope="col">Category</th>
                          <th scope="col">Author</th>
                          <th scope="col">Post Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>

                        <?php
                        
                          $readData   = "SELECT * FROM post WHERE post_status = 1 ORDER BY id DESC ";
                          $postData   = mysqli_query($db, $readData);
                          $total_row  = mysqli_num_rows($postData);
                          $sl         = 0;
                         
                          if($total_row != 0){

                            while($postRow = mysqli_fetch_assoc($postData)){

                              $postID           = $postRow['id'];
                              $postTitle        = $postRow['title'];
                              $postDes          = $postRow['description'];
                              $postCat          = $postRow['category_id'];
                              $postAuth         = $postRow['author_id'];
                              $postDate         = $postRow['post_date'];
                              $postMeta         = $postRow['meta_tag'];
                              $postImage        = $postRow['thaumbnail'];
                
                              $sl++;

                              ?>

                                <tbody>
                                  <tr>
                                    <th> <?php echo $sl; ?> </th>
                                    <td style="text-align: center;"> <?php 
                                      if( !empty( $postImage ) ){
                                        ?>
                                          <img src="dist/post-image/<?php echo $postImage; ?>" alt="" width="50" height="50" style="object-fit: cover;">
                                        <?php
                                      }
                                    ?> </td>
                                    <td class="postitle"> <?php echo $postTitle; ?> </td>
                                    <td> <?php 
                                      $sql         = "SELECT * FROM category WHERE id = '$postCat'";
                                      $catDeteials = mysqli_query($db,$sql);
                                      while( $row = mysqli_fetch_array($catDeteials) ){
                                        $cat_name = $row['cat_name'];
                                        echo $cat_name;
                                      }
                                    ?> </td>
                                    <td> <?php 
                                      $sql         = "SELECT * FROM usersinfo WHERE id = '$postAuth'";
                                      $userDeteials = mysqli_query($db,$sql);
                                      while( $row = mysqli_fetch_array($userDeteials) ){
                                        $user_name = $row['name'];
                                        echo $user_name;
                                      }
                                    ?> </td>
                                    <td> <?php echo $postDate; ?> </td>

                                    <td>
                                      <ul class="actionBtn">
                                        <li>
                                          <a href="post.php?do=Edit&id=<?php echo $postID; ?>">
                                            <i class="fa fa-edit"></i>
                                          </a>
                                        </li>
                                        <li>
                                          <a href="post.php?do=Delete" data-toggle="modal" data-target="#deletepost<?php echo $postID ?>" >
                                            <i class="fa fa-trash"></i>
                                          </a>
                                        </li>
                                      </ul>
                                    </td>
                                  </tr>

                                  <!-- Modal -->
                                      <div class="modal fade" id="deletepost<?php echo $postID ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              <a  href="post.php?do=Delete&dpid=<?php echo $postID; ?>" class="btn btn-danger">Confirm</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  
                                </tbody>

                              <?php


                            }

                          } else {
                            echo "<div class='alert alert-warning'> No Post Found </div>";
                          }

                        ?>
                    </table>

                    </div>
                  </div>

                  
                  <a href="post.php?do=Trash">
                      <span> View Trash <i class="fa-solid fa-arrow-right" style="margin-left: 4px"></i> </span>
                    </a>


                <?php

                }

                else if( $do == "Add" ){

                  ?>

                   <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Add New Post</h3>
                      </div>
                      <div class="card-body" style="display: block;">

                      <form action="post.php?do=Store" method="POST" enctype="multipart/form-data">
                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label for="title">Post Title</label>
                                      <input type="text" name="title" id="title" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label for="">Category Name</label>
                                      <Select class="form-control" name="postCat" required>
                                        <option value="">Select Category</option>
                                        <!-- all category -->
                                        <?php 
                                          $CategorySql = "SELECT * FROM category WHERE cat_status = 1 ORDER BY cat_name ASC";
                                          $postCat     = mysqli_query($db, $CategorySql);

                                          while($catRow = mysqli_fetch_assoc($postCat)){
                                            $catID           = $catRow['id'];
                                            $catTitle        = $catRow['cat_name'];

                                            ?>
                                              <option value="<?php echo $catID; ?>"><?php echo $catTitle; ?></option>
                                            <?php
                                          }
                                        ?>
                                      </Select>
                                    </div>

                                    <div class="form-group">
                                      <label for="metaTag">Meta Tags [use (,) for each tag]</label>
                                      <input type="text" name="metaTag" id="metaTag" class="form-control" required>
                                  </div>


                                  <div class="form-group">
                                      <label for="image">Thaumbnail Image</label>
                                      <input type="file" name="post-image" id="image" required>
                                      
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
                                      <input type="submit" name="addPost" value="Publish" >
                                </div>

                              </div>

                              <div class="col-lg-8">
                                  <div class="form-group">
                                      <label for="">Description</label>
                                      <textarea name="description" id="description_box" cols="30" rows="30" required>
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

                  if(isset($_POST['addPost'])){

                    if(!empty($_SESSION['error_msg'])){
                      ?>
                      <span>
                        <?php echo $_SESSION['error_msg']; ?>
                    </span>
                   <?php
                    } else {

                      $postName                  = mysqli_real_escape_string($db, $_POST['title']);
                      $CategoryName              = mysqli_real_escape_string($db, $_POST['postCat']);
                      $metaTag                   = mysqli_real_escape_string($db, $_POST['metaTag']);
                      $description               = mysqli_real_escape_string($db, $_POST['description']);
                      $authId                    = $_SESSION['id'];
                      $postImage                 = $_FILES['post-image']['name'];
                      $image_size                = $_FILES['post-image']['size'];
                      $file_type                 = $_FILES['post-image']['type'];
                      $image_tmp                 = $_FILES['post-image']['tmp_name'];
                       
                        if( !empty( $postImage ) ){
                        if($image_size < 2000000) {
                          
                            $img    =  rand(1,99999) . '-' . $postImage;
                            move_uploaded_file($image_tmp, "dist/post-image/" . $img);

                            $addpostSql = "INSERT INTO post (title, description, thaumbnail, category_id, author_id, post_date, meta_tag) VALUES ('$postName', '$description', '$img', '$CategoryName', '$authId', now() , '$metaTag')";
                            $add_post = mysqli_query($db, $addpostSql); 
  
                            if($add_post){
                              header("Location: post.php?do=Manage");
                            }else {
                              die();
                            } 

                      }else {
                        $_SESSION['error_msg']="File size must be excately 2 MB"; 
                        header("Location: post.php?do=Add");
                      }

                       }
                    }
                    } else {
                      die("MySql Error:" . mysqli_error($db));
                    }
                  
              }


              else if( $do == "Edit" ){

                if(isset($_GET['id'])){
                  $editpostId = $_GET['id'];

                  $editpostSql = "SELECT * FROM post WHERE id='$editpostId'";
                  $editPost    = mysqli_query($db, $editpostSql);

                  if($editPost){

                    while($editCatRow = mysqli_fetch_array($editPost)){

                            $postID           = $editCatRow['id'];
                            $postTitle        = $editCatRow['title'];
                            $postDes          = $editCatRow['description'];
                            $postImage        = $editCatRow['thaumbnail'];
                            $category         = $editCatRow['category_id'];
                            $metaTags         = $editCatRow['meta_tag'];

                            ?>

                    <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Edit Post</h3>
                      </div>
                      <div class="card-body" style="display: block;">

                      <form action="post.php?do=Update" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="postId" value=<?php echo $postID ?> >
                        <input type="hidden" name="oldImage" value=<?php echo $postImage ?> >

                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label for="title">Post Title</label>
                                      <input type="text" name="title" id="title" class="form-control" value="<?php echo $postTitle; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label for="">Category Name</label>
                                      <Select class="form-control" name="postCat" required>
                                        <option value="">Select Category</option>
                                        <!-- all category -->
                                        <?php 
                                          $CategorySql = "SELECT * FROM category WHERE cat_status = 1 ORDER BY cat_name ASC";
                                          $postCat     = mysqli_query($db, $CategorySql);

                                          while($catRow = mysqli_fetch_assoc($postCat)){
                                            $catID           = $catRow['id'];
                                            $catTitle        = $catRow['cat_name'];

                                            ?>
                                              <option value="<?php echo $catID; ?>" <?php if($catID == $category){echo "selected";} ?> ><?php echo $catTitle; ?></option>
                                            <?php
                                          }
                                        ?>
                                      </Select>
                                    </div>

                                    <div class="form-group">
                                      <label for="metaTag">Meta Tags [use (,) for each tag]</label>
                                      <input type="text" name="metaTag" id="metaTag" class="form-control" value="<?php echo $metaTags; ?>">
                                  </div>

                                  <div class="form-group">
                                      <label for="image">Thaumbnail Image</label>
                                      <?php
                                        if(!empty($postImage)){
                                          ?>
                                            <img src="dist/post-image/<?php echo $postImage; ?>" alt="" width="50" height="50" style="display: block;">
                                          <?php
                                        }
                                      ?>
                                      <input type="file" name="up-image" id="image">
                                      
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
                                      <input type="submit" name="editPost" value="Save Changes" >
                                </div>

                              </div>

                              <div class="col-lg-8">
                                  <div class="form-group">
                                      <label for="">Description</label>
                                      <textarea name="description" id="description_box" cols="30" rows="30">
                                        <?php echo $postDes; ?>
                                      </textarea>
                                  </div>
                              </div>
                              
                          </div>
                          
                      </form>  

                      </div>
                  </div>

                  <a href="post.php?do=Manage">
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

                if(isset($_POST['editPost'])){

                  if(!empty($_SESSION['error_msg'])){
                    ?>
                    <span>
                      <?php echo $_SESSION['error_msg']; ?>
                  </span>
                 <?php
                  } else {

                    $updatePost           = $_POST['postId'];
                    $updatepostTitle      = mysqli_real_escape_string($db, $_POST['title']);
                    $updatepostDesc       = mysqli_real_escape_string($db, $_POST['description']);
                    $oldpostImg           = $_POST['oldImage'];
                    $upCategory           = $_POST['postCat'];
                    $upMetatag            = $_POST['metaTag'];
                    $updatepostImg        = $_FILES['up-image']['name'];
                    $image_size           = $_FILES['up-image']['size'];
                  
                    if(!empty($updatepostImg)){
                      if($image_size < 2000000){
                  
                          if(!empty($oldpostImg)){
                            unlink("dist/post-image/" . $oldpostImg);
                          }
                  
                          $image_tmp       =  $_FILES['up-image']['tmp_name'];
                          $UPimg           =  rand(1,99999) . '-' . $updatepostImg;
                  
                          move_uploaded_file($image_tmp, "dist/post-image/" . $UPimg);
                          
                          $updatepostSql = "UPDATE post SET title='$updatepostTitle', description='$updatepostDesc', thaumbnail='$UPimg', category_id='$upCategory', meta_tag='$upMetatag'  WHERE id = '$updatePost'";
                  
                          $updatepostData = mysqli_query($db, $updatepostSql);
                  
                          if($updatepostData){
                            header("Location: post.php?do=Manage");
                          }else {
                            die();
                          }
                          
                      }else {
                        $_SESSION['error_msg']="File size must be excately 2 MB"; 
                        header("Location: post.php?do=Edit&id=$updatePost");
                      }
                  
                    }else {

                      $updatepostSql = "UPDATE post SET title='$updatepostTitle', description='$updatepostDesc', category_id='$upCategory', meta_tag='$upMetatag'  WHERE id = '$updatePost'";
                  
                          $updatepostData = mysqli_query($db, $updatepostSql);
                  
                          if($updatepostData){
                            header("Location: post.php?do=Manage");
                          }else {
                            die();
                          }

                    } 

                  }
                
                         
                
                }
                
                  
              }

                else if( $do == "Delete" ){
                    
                  if( isset($_GET['dpid']) ){
                    $deletePost = $_GET['dpid'];

                    $deleteSql = "UPDATE post set post_status = 0 WHERE id='$deletePost'";
                    $delete = mysqli_query( $db, $deleteSql );
                    if($delete){
                      header("Location: post.php?do=Manage");
                    }else {
                      die();
                    }
                  }

                }
                else if($do == "Trash"){

                  ?>

                  <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">Manage All Post</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                    <table class="table table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col">#Sl</th>
                          <th scope="col">Picture</th>
                          <th scope="col">Post Title</th>
                          <th scope="col">Category</th>
                          <th scope="col">Author</th>
                          <th scope="col">Post Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>

                        <?php
                        
                          $DeleteData   = "SELECT * FROM post WHERE post_status = 0 ORDER BY id DESC ";
                          $postData   = mysqli_query($db, $DeleteData);
                          $total_row  = mysqli_num_rows($postData);
                          $sl         = 0;
                         
                          if($total_row != 0){

                            while($postRow = mysqli_fetch_assoc($postData)){

                              $postID           = $postRow['id'];
                              $postTitle        = $postRow['title'];
                              $postDes          = $postRow['description'];
                              $postCat          = $postRow['category_id'];
                              $postAuth         = $postRow['author_id'];
                              $postDate         = $postRow['post_date'];
                              $postMeta         = $postRow['meta_tag'];
                              $postImage        = $postRow['thaumbnail'];
                
                              $sl++;

                              ?>

                                <tbody>
                                  <tr>
                                    <th> <?php echo $sl; ?> </th>
                                    <td style="text-align: center;"> <?php 
                                      if( !empty( $postImage ) ){
                                        ?>
                                          <img src="dist/post-image/<?php echo $postImage; ?>" alt="" width="50" height="50">
                                        <?php
                                      }
                                    ?> </td>
                                    <td class="postitle"> <?php echo $postTitle; ?> </td>
                                    <td> <?php 
                                      $sql         = "SELECT * FROM category WHERE id = '$postCat'";
                                      $catDeteials = mysqli_query($db,$sql);
                                      while( $row = mysqli_fetch_array($catDeteials) ){
                                        $cat_name = $row['cat_name'];
                                        echo $cat_name;
                                      }
                                    ?> </td>
                                    <td> <?php 
                                      $sql         = "SELECT * FROM usersinfo WHERE id = '$postAuth'";
                                      $userDeteials = mysqli_query($db,$sql);
                                      while( $row = mysqli_fetch_array($userDeteials) ){
                                        $user_name = $row['name'];
                                        echo $user_name;
                                      }
                                    ?> </td>
                                    <td> <?php echo $postDate; ?> </td>

                                    <td>
                                    <ul class="actionBtn">
                                        <li style="display:block">
                                          <a href="post.php?do=Trash&rid=<?php echo $postID; ?>">
                                            Restore
                                          </a>
                                        </li>
                                        <li style="display:block">
                                          <a href="post.php?do=Trash&pid=<?php echo $postID; ?>">
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

                                    $restoreSql    = "UPDATE post set post_status = 1 WHERE id = '$restoreId'";
                                    $restoreCat    = mysqli_query($db,$restoreSql);

                                    if($restoreCat){
                                      header("Location: post.php?do=Manage");
                                    }else {
                                      die();
                                    }

                                  }

                                  if(isset($_GET['pid'])){
                                    $permantId = $_GET['pid'];

                                    $permantSql    = "DELETE FROM post WHERE id = '$permantId'";
                                    $permantCat    = mysqli_query($db,$permantSql);

                                    if($permantCat){
                                      header("Location: post.php?do=Trash");
                                    }else {
                                      die();
                                    }

                                  }


                            }

                          } else {
                            echo "<div class='alert alert-warning'> No Post Found </div>";
                          }

                        ?>
                    </table>

                    </div>
                  </div>

                  
                  <a href="post.php?do=Manage">
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
