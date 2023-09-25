
<?php
    include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="javascript:;">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li>
                                <?php
                                     if(isset($_GET['p'])){

                                            $postId = $_GET['p'];
                                            $readData   = "SELECT * FROM post WHERE id = '$postId' ";
                                            $postData   = mysqli_query($db, $readData);
                                            $total_post = mysqli_num_rows($postData);

                                            if( $total_post != 0){  

                                            while($postRow = mysqli_fetch_assoc($postData)){
                                                $postTitle        = $postRow['title'];
                                                echo $postTitle;

                                           }
                                        }
                                    } 
                                ?>
                            </li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->

    <?php
        function agoTime($timestamp){
            $time_ago     = strtotime($timestamp);
            $current_time = time();
            
            $time_differnce = $current_time - $time_ago;
            $seconds   = $time_differnce;
            $minutes   = round($seconds / 60);
            $hours     = round($seconds / 3600);
            $days      = round($seconds / 86400);
            $weeks     = round($seconds / 604800);
            $months    = round($seconds / 2629440);
            $years     = round($seconds / 31553280);

            if( $seconds <= 60 ){
                return "Just Now";
            }

            else if( $minutes <= 60 ){

                if( $minutes == 1 ){
                    return "1 minute ago";
                } else {
                    return $minutes . " minutes ago";
                }

            }

            else if( $hours <= 24 ){

                if( $hours == 1 ){
                    return "1 hour ago";
                } else {
                    return $hours . " hrs ago";
                }
                
            }

            else if( $days <= 7 ){

                if( $days == 1 ){
                    return "1 day ago";
                } else {
                    return $days . " days ago";
                }
                
            }

            else if( $days <= 7 ){

                if( $days == 1 ){
                    return "1 day ago";
                } else {
                    return $days . " days ago";
                }
                
            }

            else if( $weeks <= 4.3 ){

                if( $weeks == 1 ){
                    return "1 week ago";
                } else {
                    return $weeks . " weeks ago";
                }
                
            }

            else if( $months <= 12 ){

                if( $months == 1 ){
                    return "1 month ago";
                } else {
                    return $months . " months ago";
                }
                
            }

            else {
                if( $years == 1 ){
                    return "1 year ago";
                } else {
                    return $years . " years ago";
                }
            }									
        }
    ?>

    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row" >
                <!-- Blog Single Posts -->
                <div class="col-md-8">

                    <?php 
                    
                        if(isset($_GET['p']))
                        {
                            $postId = $_GET['p'];
                            
                            $readData   = "SELECT * FROM post WHERE id = '$postId' ";
                            $postData   = mysqli_query($db, $readData);
                            $total_post = mysqli_num_rows($postData);
       
                            if( $total_post != 0){
       
                               while($postRow = mysqli_fetch_assoc($postData)){
       
                                   $postID           = $postRow['id'];
                                   $postTitle        = $postRow['title'];
                                   $postDes          = $postRow['description'];
                                   $postCat          = $postRow['category_id'];
                                   $postAuth         = $postRow['author_id'];
                                   $postDate         = $postRow['post_date'];
                                   $postMeta         = $postRow['meta_tag'];
                                   $postImage        = $postRow['thaumbnail'];
       
                                   ?>

                    <div class="blog-single">
                        
                        <!-- Blog Thumbnail Image Start -->
                        <div class="blog-banner">
                            <img src="admin/dist/post-image/<?php echo $postImage;?>">
                        </div>
                        <!-- Blog Thumbnail Image End -->

                        <!-- Blog Title -->
                        <h3 class="post-title"> <?php echo $postTitle;?> </h3>

                        <!-- Blog Categories -->
                        <div class="single-categories">
                            <?php 
                               $meta = explode(",",$postMeta);
                               foreach($meta as $tag){       
                                ?>
                                    <span>
                                        <?php echo $tag; ?>
                                    </span>
                                <?php
                            }
                            ?>
                           
                        </div>

                        <!-- Blog Description Start -->
                        <p>
                            <?php echo $postDes ?>
                        </p>

                        <div class="blog-description-quote">
                            <p><i class="fa fa-quote-left"></i> <?php 
                                 $sql = "SELECT * FROM category WHERE id='$postCat'";
                                 $catDesc = mysqli_query($db, $sql);

                                 while( $row = mysqli_fetch_assoc($catDesc) ){
                                     $category = $row['cat_desc'];
                                     echo $category;
                                 }
                            ?> <i class="fa fa-quote-right"></i></p>
                        </div>

                        <!-- Blog Description End -->
                    </div>


                                   <?php
                               }
                            }
                        }

                    ?>
                        
                    <!-- comment -->

                        <?php

                            if(isset($_GET['p'])){ 

                                $postId          = $_GET['p'];
                                $cmtSql          = "SELECT * FROM comment WHERE post_id = $postId";
                                $sendDb          = mysqli_query($db, $cmtSql);
                                $total_cmt       = mysqli_num_rows($sendDb);

                                ?>
                                <!-- Single Comment Section Start -->
                                <div class="single-comments">
                                    <!-- Comment Heading Start -->
                                    <div class="row" style="margin-bottom: 40px;">
                                        <div class="col-md-12">
                                            <h4>All Latest Comments (<?php echo $total_cmt; ?>)</h4>
                                            <div class="title-border"></div>
                                        </div>
                                    </div>
                                    <!-- Comment Heading End -->                         
                            <?php

                                if( $total_cmt != 0 ){
                                    
                                    while( $cmt_row = mysqli_fetch_assoc($sendDb) ){

                                        $cmtId       = $cmt_row['id'];
                                        $cmt         = $cmt_row['comments'];
                                        $cmtpst      = $cmt_row['post_id'];
                                        $cmtuser     = $cmt_row['user_id'];
                                        $cmtdate     = $cmt_row['cmt_date'];
                                        $time        = $cmt_row['date_time'];

                                        ?>

                                                <!-- Single Comment Post Start -->
                                                <div class="row each-comments">
                                                    <div class="col-md-2">
                                                        <!-- Commented Person Thumbnail -->
                                                        <div class="comments-person">
                                                            <?php
                                                                $userSql = "SELECT * FROM usersinfo WHERE id = $cmtuser ";
                                                                $sendUser = mysqli_query($db, $userSql);

                                                                while($userRow = mysqli_fetch_array($sendUser)){
                                                                    $userImg = $userRow['image'];

                                                                    if(!empty($userImg)){
                                                                        ?>
                                                                            <img src="admin/dist/upload-image/<?php echo $userImg; ?>" alt="User" class="userImg">
                                                                        <?php
                                                                    }else {
                                                                        ?>
                                                                            <img src="admin/dist/upload-image/default.png" alt="User" class="userImg">
                                                                        <?php
                                                                    }

                                                                }
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-10 no-padding">
                                                        <!-- Comment Box Start -->
                                                        <div class="comment-box">      
                                                            <div class="comment-box-header">
                                                                <ul>
                                                                    <li class="post-by-name">
                                                                        <?php 
                                                                        
                                                                        $userSql = "SELECT * FROM usersinfo WHERE id = $cmtuser ";
                                                                        $sendUser = mysqli_query($db, $userSql);
        
                                                                        while($userRow = mysqli_fetch_array($sendUser)){
                                                                            $userName = $userRow['name'];
                                                                            echo $userName;
                                                                        }

                                                                        if(  !empty($_SESSION['userId']) || !empty($_SESSION['userEmail']) ){
                                                                            if( $cmtuser == $_SESSION['userId'] ){
                                                                                ?>
                                                                                   <form action="" method="POST" class="delCmt">
                                                                                   <input type="hidden" name="delCmt_id" value=<?php echo $cmtId; ?>>
                                                                                        <button type="submit" name="delCmt">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>
                                                                                        
                                                                                   </form>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        
                                                                        ?>
                                                                    </li>
                                                                    <li class="post-by-hour"><?php echo agoTime($time); ?></li>
                                                                </ul>
                                                            </div>
                                                            <p>
                                                                <?php echo $cmt; ?>
                                                            </p>
                                                        </div>
                                                        <!-- Comment Box End -->
                                                    </div>
                                                </div>
                                                <!-- Single Comment Post End -->

                                        <?php

                                    }   

                                } else {
                                    echo "<span class='no-comment'>No comment found in this post !</span>";
                                }
                                
                                if(isset($_POST['delCmt'])){
                                    $delId     = $_POST['delCmt_id'];
                                    $del_cmt   = "DELETE FROM comment WHERE id = '$delId'";
                                    $delDb     = mysqli_query($db, $del_cmt);

                                    if($delDb){
                                        header("Location: single.php?p=$postId");
                                    }
                                }
                                            
                                ?>
                                </div>
                                   <!-- Single Comment Section End -->
                           <?php

                            }
                        ?>                    

                    <!-- Post New Comment Section Start -->
                    <div class="post-comments">
                        <h4>Post Your Comments</h4>
                        <div class="title-border"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        <!-- Form Start -->
                        <?php

                            if(  !empty($_SESSION['userId']) || !empty($_SESSION['userEmail']) ){

                                ?>

                                <form action="" method="POST" class="contact-form">
                                    <!-- Right Side Start -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Comments Textarea Field -->
                                            <div class="form-group">
                                                <textarea name="comments" class="form-input" placeholder="Your Comments Here..." required></textarea>
                                                <i class="fa fa-pencil-square-o"></i>
                                            </div>
                                            <!-- Post Comment Button -->
                                            <button type="submit" name='btnComment' class="btn-main">
                                                <i class="fa fa-paper-plane-o"></i> Post Your Comments
                                            </button>    
                                        </div>

                                        </div>
                                    <!-- Right Side End -->
                                </form>  
                                <?php

                                    if( isset($_POST['btnComment']) ){

                                        if(isset($_GET['p'])){ 

                                            $postId     = $_GET['p'];
                                            $readData   = "SELECT * FROM post WHERE id = '$postId' ";
                                            $postData   = mysqli_query($db, $readData);
                                            $total_post = mysqli_num_rows($postData);  

                                            while($postRow = mysqli_fetch_assoc($postData)){
                                                $cpostId        = $postRow['id'];
                                            
                                             } 

                                             $comment         =  mysqli_real_escape_string($db, $_POST['comments']);
                                             $commentPost     =  $cpostId;
                                             $userId          =  $_SESSION['userId'];
                                             $time            = date("d-M-Y h:ia");
											 date_default_timezone_set('Asia/Dhaka');
                                             
                                             if(!empty($comment)){
                                                 $commentSql = "INSERT INTO comment (comments, post_id, user_id, cmt_date, date_time) VALUES ('$comment', '$commentPost', '$userId', now(), '$time')";
                                             $commentDb  = mysqli_query( $db, $commentSql );

                                             if($commentDb){
                                                header("Location: single.php?p=$postId");
                                             }
                                             
                                         }
                                        
                                        }
                                    

                                    }

                                    } else {
                                        ?>
                                            <div class="alert alert-warning">
                                                Please <strong> <a href="login.php?lp=<?php echo $postId;?>">Log In</a> </strong> to post your comment
                                            </div>
                                        <?php
                                    }


                                    ?>

                               
                    </div>
                    <!-- Post New Comment Section End -->              
                </div>     

                <!-- Blog Right Sidebar -->
                <div class="col-md-4">
                     <?php 
                        include "inc/sidebar.php";
                     ?>   
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->


    <?php
    include "inc/footer.php";
    ?>
