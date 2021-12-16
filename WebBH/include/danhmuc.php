<!-- Team Start -->
<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}else{
		$id = '';
	}
	$sql_cate = mysqli_query($con,"SELECT * FROM tbl_category,tbl_sanpham WHERE tbl_category.category_id=tbl_sanpham.category_id AND tbl_sanpham.category_id='$id' ORDER BY tbl_sanpham.sanpham_id DESC");	
	$sql_category = mysqli_query($con,"SELECT * FROM tbl_category,tbl_sanpham WHERE tbl_category.category_id=tbl_sanpham.category_id AND tbl_sanpham.category_id='$id' ORDER BY tbl_sanpham.sanpham_id DESC");		

	$row_title = mysqli_fetch_array($sql_category);
	$title = $row_title['category_name'];		
?>
        <!-- Single Post Start-->
        <div class="single">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            <div class="sidebar-widget">
                                <div class="search-widget">
                                    <form>
                                        <input class="form-control" type="text" placeholder="Tìm kiếm..">
                                        <button class="btn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">Danh mục</h2>
                                <div class="category-widget">
                                    <ul>
                                        <?php
                                            $sql_category_danhmuc = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');
                                            while($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)){
                                        ?>
                                        <li><a href="?quanly=danhmuc&id=<?php echo $row_category_danhmuc['category_id'] ?>"><?php echo $row_category_danhmuc['category_name'] ?></a><span>(98)</span></li>
                                        <?php
                                            }
                                        ?>
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
                        </div>
                    </div>


                    <div class="col-lg-9">
                        
                        <div class="team">
                            <div class="container">
                                <div class="section-header text-center">
                                    <h2><?php echo $title ?></h2>
                                </div>
                                <div class="row">
                                    <?php
                                        while($row_sanpham = mysqli_fetch_array($sql_cate)){
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="team-item">
                                            <div class="team-img">
                                                <img src="uploads/<?php echo $row_sanpham['sanpham_image'] ?>" alt="Image">
                                                <div class="team-social">
                                                    <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><i class="fas fa-eye"></i></a>
                                                    <form action="?quanly=giohang" method="post">
                                                        <a href="?quanly=giohang" name="themgiohang" type="submit"><i class="fas fa-cart-plus"></i></a>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="team-text">
                                                <h2><a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><?php echo $row_sanpham['sanpham_name'] ?></a></h2>
                                                <p><?php echo number_format($row_sanpham['sanpham_gia']).' đ' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                    ?>
                                </div>
                            </div>
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
            </div>
        </div>
        <!-- Single Post End-->