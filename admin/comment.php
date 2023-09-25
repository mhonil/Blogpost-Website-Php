
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
              <li class="breadcrumb-item active"> All Comments </li>
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
                    <h3 class="card-title">Manage All Comments</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                    <table class="table table table-bordered table-striped">
                      <thead class="table-dark">
                        <tr>
                            <th>SL</th>
                            <th>Comments</th>
                            <th>Post Name</th>
                            <th>User Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>

                        <?php
                        
                          $readData       = "SELECT * FROM comment ORDER BY id DESC ";
                          $commentData    = mysqli_query($db, $readData);
                          $total_row      = mysqli_num_rows($commentData);
                          $sl             = 0;
                         
                          if($total_row != 0){

                            while($comment_row = mysqli_fetch_assoc($commentData)){

                                $commentId         = $comment_row['id'];
                                $comment           = $comment_row['comments'];
                                $commentPost       = $comment_row['post_id'];
                                $commentUser       = $comment_row['user_id'];
                                $commentDate       = $comment_row['cmt_date'];
                
                                $sl++;

                              ?>

                                <tbody>
                                  <tr>
                                  <th><?php echo $sl; ?></th>
                                        <td class="description"><?php echo $comment ?></td>
                                        <td><?php 
                                          $nameSql = "SELECT * FROM post WHERE id = '$commentPost'";
                                          $sendDb  = mysqli_query($db,$nameSql);

                                          while( $nameRow = mysqli_fetch_array($sendDb) ){
                                            $postName = $nameRow['title'];
                                            echo $postName;
                                          }
                                        ?></td>
                                        <td><?php 
                                          $userSql = "SELECT * FROM usersinfo WHERE id = '$commentUser'";
                                          $sendDb  = mysqli_query($db,$userSql);

                                          while( $userRow = mysqli_fetch_array($sendDb) ){
                                            $userName = $userRow['name'];
                                            echo $userName;
                                          }
                                        ?></td>
                                        <td><?php echo $commentDate; ?></td>
                                       
                                        <td>
                                            <ul class="actionBtn">
                                                <li>
                                                    <a href="comment.php?do=Delete" data-toggle="modal" data-target="#deletecmt<?php echo $commentId; ?>">
                                                     <i class="fa fa-trash"></i> 
                                                  </a>
                                                </li>
                                            </ul>
                                        </td>
                                  </tr>

                               <!-- Modal -->
                               <div class="modal fade" id="deletecmt<?php echo $commentId ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <a  href="comment.php?do=Delete&dc=<?php echo $commentId; ?>" class="btn btn-danger">Confirm</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                                  
                                </tbody>
                                 
                              <?php

                            }

                          } else {
                            echo "<div class='alert alert-warning'> No Comment Found </div>";
                          }

                        ?>
                    </table>

                    </div>
                  </div>


                <?php

                } else if( $do == "Delete" ){

                  if( isset($_GET['dc']) ){
                    $delCmt = $_GET['dc'];

                    $deleteSql = "DELETE FROM comment WHERE id = '$delCmt'";
                    $sendDb    = mysqli_query( $db, $deleteSql );

                    if($sendDb){
                      header("Location: comment.php?do=Manage");
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
  
  
<?php 
  include("inc/footer.php");
?>
