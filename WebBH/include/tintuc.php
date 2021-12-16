<?php
	if(isset($_GET['id_tin'])){
		$id_danhmuc = $_GET['id_tin'];
	}else{
		$id_danhmuc = '';
	}
?>
    <div class="single">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            <div class="sidebar-widget">
                                <div class="search-widget">
                                    <form>
                                        <input class="form-control" type="text" placeholder="Search Keyword">
                                        <button class="btn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-widget">
                                <h2 class="widget-title">Categories</h2>
                                <div class="category-widget">
                                    <ul>
                                        <li><a href="">National</a><span>(98)</span></li>
                                        <li><a href="">International</a><span>(87)</span></li>
                                        <li><a href="">Economics</a><span>(76)</span></li>
                                        <li><a href="">Politics</a><span>(65)</span></li>
                                        <li><a href="">Lifestyle</a><span>(54)</span></li>
                                        <li><a href="">Technology</a><span>(43)</span></li>
                                        <li><a href="">Trades</a><span>(32)</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Tags Cloud</h2>
                                <div class="tag-widget">
                                    <a href="">National</a>
                                    <a href="">International</a>
                                    <a href="">Economics</a>
                                    <a href="">Politics</a>
                                    <a href="">Lifestyle</a>
                                    <a href="">Technology</a>
                                    <a href="">Trades</a>
                                </div>
                            </div>
                            <div class="sidebar-widget">
                                <h2 class="widget-title">Recent Post</h2>
                                <div class="recent-post">
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-1.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            <div class="post-meta">
                                                <p>By<a href="">Admin</a></p>
                                                <p>In<a href="">Web Design</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-2.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            <div class="post-meta">
                                                <p>By<a href="">Admin</a></p>
                                                <p>In<a href="">Web Design</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-3.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            <div class="post-meta">
                                                <p>By<a href="">Admin</a></p>
                                                <p>In<a href="">Web Design</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-4.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            <div class="post-meta">
                                                <p>By<a href="">Admin</a></p>
                                                <p>In<a href="">Web Design</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="img/post-5.jpg" />
                                        </div>
                                        <div class="post-text">
                                            <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            <div class="post-meta">
                                                <p>By<a href="">Admin</a></p>
                                                <p>In<a href="">Web Design</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Blog Start -->
                        <div class="blog">
                            <div class="container">
                                <div class="section-header text-center">
                                    <?php
					$sql_tendanhmuc1 = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin WHERE danhmuctin_id='$id_danhmuc'");
					$row_danh1 = mysqli_fetch_array($sql_tendanhmuc1); 
                                    ?>		
                                    <h2><?php echo $row_danh1['tendanhmuc'] ?></h2>
                                </div>
                                <div class="row">
                                    <?php 
                                        $sql_baiviet = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin,tbl_baiviet WHERE tbl_danhmuc_tin.danhmuctin_id = tbl_baiviet.danhmuctin_id AND tbl_danhmuc_tin.danhmuctin_id='$id_danhmuc'");
                                        while($row_baiviet = mysqli_fetch_array($sql_baiviet)){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="blog-item">
                                            <div class="blog-img">
                                                <img src="uploads/<?php echo $row_baiviet['baiviet_image'] ?>" alt="Blog">
                                            </div>
                                            <div class="blog-content">
                                                <h2 class="blog-title"><a href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id'] ?>"><?php echo $row_baiviet['tenbaiviet'] ?></a></h2>
                                                <div class="blog-meta">
                                                    <p><i class="far fa-user"></i><?php echo $row_baiviet['nguoidang'] ?></p>
                                                    <p><i class="far fa-calendar-alt"></i><?php echo $row_baiviet['ngaydang'] ?></p>
                                                </div>
                                                <div class="blog-text">
                                                    <p><?php echo substr($row_baiviet['tomtat'], 0, 90)?>...</p>
                                                    <a class="btn custom-btn" href="index.php?quanly=chitiettin&id_tin=<?php echo $row_baiviet['baiviet_id'] ?>">Đọc ngay</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        } 
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Blog End -->
                    </div>
                </div>
            </div>
        </div>