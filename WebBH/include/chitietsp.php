<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}else{
		$id = '';
	}
	$sql_chitiet = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$id'"); 
?>

<?php
    while($row_chitiet = mysqli_fetch_array($sql_chitiet)){
?>
        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img">
                            <img src="uploads/<?php echo $row_chitiet['sanpham_image'] ?>" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <div class="section-header">
                                <h2><?php echo $row_chitiet['sanpham_name'] ?></h2><br>
                                <h4><?php echo number_format($row_chitiet['sanpham_gia']).' đ' ?></h4>
                            <div class="about-text">
                                <hr color="yellow">
                                <p>
                                    <?php echo $row_chitiet['sanpham_mota'] ?>
                                </p>
                                <hr color="yellow">
                                <form action="?quanly=giohang" method="post">
                                    <input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['sanpham_name'] ?>" />
                                    <input type="hidden" name="sanpham_id" value="<?php echo $row_chitiet['sanpham_id'] ?>" />
                                    <input type="hidden" name="giasanpham" value="<?php echo $row_chitiet['sanpham_gia'] ?>" />
                                    <input type="hidden" name="hinhanh" value="<?php echo $row_chitiet['sanpham_image'] ?>" />
                                    <input type="hidden" name="soluong" value="1" />
                                    <input class="btn custom-btn" name="themgiohang" type="submit" value="Thêm Giỏ Hàng">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        <?php
            }
        ?>