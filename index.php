
<?php
    include "inc/header.php";
?>
    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="javascript:;">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Blog</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->


   
    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Posts Start -->
                <div class="col-md-8">

                <?php
                     $readData   = "SELECT * FROM post WHERE post_status = 1 ORDER BY id DESC ";
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
                            
                               <!-- Single Item Blog Post Start -->
                                <div class="blog-post">
                                    <!-- Blog Banner Image -->
                                    <div class="blog-banner">
                                        <a href="single.php?p=<?php echo $postID;?>">
                                            <img src="admin/dist/post-image/<?php echo $postImage;?>" class="thumbnail">
                                            <!-- Post Category Names -->
                                            <div class="blog-category-name">
                                                <h6><?php 
                                                    $sql = "SELECT * FROM category WHERE id='$postCat'";
                                                    $catName = mysqli_query($db, $sql);
                                                    while( $row = mysqli_fetch_assoc($catName) ){
                                                        $category = $row['cat_name'];
                                                        echo $category;
                                                    }
                                                ?></h6>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Blog Title and Description -->
                                    <div class="blog-description">
                                        <a href="single.php?p=<?php echo $postID;?>">
                                            <h3 class="post-title"><?php echo $postTitle; ?></h3>
                                        </a>
                                        <p>
                                            <?php 
                                                echo substr($postDes, 0 ,269) . "....";
                                             ?>
                                        </p>
                                        <!-- Blog Info, Date and Author -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="blog-info">
                                                    <ul>
                                                        <li><i class="fa fa-calendar"></i> <?php 
                                                            $sql = "SELECT * FROM usersinfo WHERE id='$postAuth'";
                                                            $auther = mysqli_query($db, $sql);
                                                            while( $row = mysqli_fetch_assoc($auther) ){
                                                                $autherName = $row['name'];
                                                                echo $autherName;
                                                            }
                                                        ?> </li>
                                                        <li><i class="fa fa-user"></i> <?php echo $postDate; ?> </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-4 read-more-btn">
                                                <button type="button" class="btn-main">
                                                    <a href="single.php?p=<?php echo $postID;?>">
                                                    Read More <i class="fa fa-angle-double-right"></i>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             <!-- Single Item Blog Post End -->

                            <?php

                        }

                     }else {
                        echo "<div class='alert alert-warning'> No Post Found </div>";
                     }
                    
                 ?>

                    <!-- Blog Paginetion Design Start -->
                    <div class="paginetion">
                        <ul>
                            <!-- Next Button -->
                            <li class="blog-prev">
                                <a href=""><i class="fa fa-long-arrow-left"></i>  Previous</a>
                            </li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li class="active"><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">5</a></li>
                            <!-- Previous Button -->
                            <li class="blog-next">
                                <a href=""> Next <i class="fa fa-long-arrow-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Blog Paginetion Design End -->               
                </div>



                <!-- Blog Right Sidebar -->
                <div class="col-md-4">

                    <?php 
                        include "inc/sidebar.php";
                    ?>

                </div>
                <!-- Right Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    


<?php
    include "inc/footer.php";
?>