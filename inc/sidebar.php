    <!-- Latest News -->
    <div class="widget">
          <h4>Latest News</h4>
            <div class="title-border"></div> 
              <!-- Sidebar Latest News Slider Start -->
               <div class="sidebar-latest-news owl-carousel owl-theme">
                    <?php

                        $readData   = "SELECT * FROM post WHERE post_status = 1 ORDER BY id DESC LIMIT 3 ";
                        $postData   = mysqli_query($db, $readData);
                        $total_post = mysqli_num_rows($postData);

                        if( $total_post != 0){

                        while($postRow = mysqli_fetch_assoc($postData)){

                            $postID           = $postRow['id'];
                            $postTitle        = $postRow['title'];
                            $postDes          = $postRow['description'];
                            $postImage        = $postRow['thaumbnail'];

                            ?>
                                    
                                <div class="item">
                                    <div class="latest-news">
                                    <a href="single.php?p=<?php echo $postID;?>">
                                        <div class="latest-news-image">
                                            <img src="admin/dist/post-image/<?php echo $postImage;?>">
                                        </div>
                                        <h5><?php echo $postTitle; ?></h5>
                                        <p>
                                            <?php
                                                echo substr($postDes, 0,145) . "...";
                                            ?>
                                        </p>
                                    </a>
                                     </div>
                               </div>

                            <?php

            }
        }


         ?>
         </div>
                        <!-- Sidebar Latest News Slider End -->
         </div>
         
                    <!-- Search Bar Start -->
                    <div class="widget"> 
                            <!-- Search Bar -->
                            <h4>Blog Search</h4>
                            <div class="title-border"></div>
                            <div class="search-bar">
                                <!-- Search Form Start -->
                                <form action="search.php" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
                                        <i class="fa fa-paper-plane-o"></i>
                                    </div>
                                </form>
                                <!-- Search Form End -->
                            </div>
                    </div>
                    <!-- Search Bar End -->

                    <!-- Recent Post -->
                    <div class="widget">
                        <h4>Recent Posts</h4>
                        <div class="title-border"></div>
                        <div class="recent-post">
                            <!-- Recent Post Item Content Start -->
                            
                                <?php
                                     $readData   = "SELECT * FROM post WHERE post_status = 1 ORDER BY id DESC LIMIT 4 ";
                                     $postData   = mysqli_query($db, $readData);
                                     $total_post = mysqli_num_rows($postData);
             
                                     if( $total_post != 0){
             
                                     while($postRow = mysqli_fetch_assoc($postData)){
             
                                         $postID           = $postRow['id'];
                                         $postTitle        = $postRow['title'];
                                         $postImage        = $postRow['thaumbnail'];
                                         $postDate         = $postRow['post_date'];

                                        ?>
                                        <div class="recent-post-item">
                                        <a href="single.php?p=<?php echo $postID;?>">
                                        <div class="row">
                                        
                                        <div class="col-md-4">
                                                <img src="admin/dist/post-image/<?php echo $postImage; ?>">
                                            </div>
                                            <div class="col-md-8 no-padding">
                                                <h5><?php echo $postTitle; ?></h5>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i><?php echo $postDate; ?></li>
                                                </ul>
                                         </div>
                                        
                                            
                                    </div>
                                    </a>
                                </div>
                                        <?php

                                     }
                                     } 
                                ?>
                                    
                                

                        </div>
                    </div>

                    <!-- All Category -->
                    <div class="widget">
                        <h4>Blog Categories</h4>
                        <div class="title-border"></div>
                        <!-- Blog Category Start -->
                        <div class="blog-categories">
                            <ul>
                                <?php 
                                     $sql = "SELECT * FROM category WHERE cat_status = 1 ORDER BY cat_name ASC";
                                     $catName = mysqli_query($db, $sql);
                                     while( $row = mysqli_fetch_assoc($catName) ){
                                        $catID     = $row['id'];
                                         $category = $row['cat_name'];
                                         ?>
                                            <li>
                                                <a href="category.php?cid=<?php echo $catID; ?>">
                                                    <i class="fa fa-check"></i>
                                                    <?php echo $category; ?>
                                                    <span>
                                                        <?php
                                                            $sql2 = "SELECT * FROM post WHERE post_status = 1 AND category_id = $catID";
                                                            $postCat = mysqli_query($db,$sql2);
                                                            $totalCat_No = mysqli_num_rows($postCat);
                                                            
                                                            echo "[". $totalCat_No ."]";
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                         <?php
                                     }
                                ?>
                                
                            </ul>
                        </div>
                        <!-- Blog Category End -->
                    </div>

                    <!-- Recent Comments -->
                    <div class="widget">
                        <h4>Recent Comments</h4>
                        <div class="title-border"></div>
                        <div class="recent-comments">

                        <?php
                        
                            $re_cmt = "SELECT * FROM comment ORDER BY id DESC LIMIT 3";
                            $reDb   = mysqli_query($db, $re_cmt);
                            
                            while( $row = mysqli_fetch_assoc( $reDb )){

                                $cmtpost     = $row['post_id'];
                                $cmtuser     = $row['user_id'];

                                ?>
                                    <!-- Recent Comments Item Start -->
                                    <div class="recent-comments-item">
                                        <div class="row">
                                            <!-- Comments Thumbnails -->
                                            <div class="col-md-4">
                                                <i class="fa fa-comments-o"></i>
                                            </div>
                                            <!-- Comments Content -->
                                            <div class="col-md-8 no-padding">
                                                <h5>
                                                    <?php 
                                                          $postSql  = "SELECT * FROM post WHERE id = $cmtpost ";
                                                          $sendPost = mysqli_query($db, $postSql);

                                                          while($postRow = mysqli_fetch_array($sendPost)){
                                                              $postName = $postRow['title'];
                                                              echo $postName;
                                                          }  
                                                     ?>
                                                </h5>
                                                <!-- Comments Date -->
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-user-o"></i>
                                                        <?php
                                                            $userSql = "SELECT * FROM usersinfo WHERE id = $cmtuser ";
                                                            $sendUser = mysqli_query($db, $userSql);

                                                            while($userRow = mysqli_fetch_array($sendUser)){
                                                                $userName = $userRow['name'];
                                                                echo $userName;
                                                            }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Recent Comments Item End -->

                                <?php

                            }

                        
                        ?>


                        </div>
                    </div>

                    <!-- Meta Tag -->
                    <div class="widget">
                        <h4>Tags</h4>
                        <div class="title-border"></div>
                        <!-- Meta Tag List Start -->
                        <div class="meta-tags">
                            <?php 
                                $sql = "SELECT * FROM post ORDER BY id DESC";
                                $metatags = mysqli_query($db, $sql);
                                $countMeta = mysqli_num_rows($metatags);
                                
                                if($countMeta != 0 ){
                                    while($row = mysqli_fetch_assoc($metatags)){
                                        $allMetaTags = $row['meta_tag'];

                                        $tags = explode(",",$allMetaTags);
                                        
                                        foreach($tags as $Alltag){
                                          $tag = trim($Alltag," ");
                                            ?>
                                             <a href="search.php?meta=<?php echo $tag;?>">
                                                <span class="meta">
                                                    <?php echo $tag; ?>
                                                </span>
                                            </a>
                                            <?php
                                        }

                                        ?>
                                            
                                        <?php
                                    }
                                }
                            ?>
                                    
                        </div>
                        <!-- Meta Tag List End -->
                    </div>