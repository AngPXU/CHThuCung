<!-- Nav Bar Start -->
        <?php 
            $sql_category = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');
	?>
        <div class="navbar navbar-expand-lg bg-light navbar-light">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand"><img src="Style/img/logoanhklee.png" alt="Image"></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.php" class="nav-item nav-link active">Trang chủ</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sản phẩm</a>
                            <div class="dropdown-menu">
                                <?php 
                                    $sql_category_danhmuc = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');
                                    while($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)){
				?>
                                <a href="?quanly=danhmuc&id=<?php echo $row_category_danhmuc['category_id'] ?>" class="nav-item nav-link"><?php echo $row_category_danhmuc['category_name'] ?></a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <a href="View/Pages/Gioithieu.php" class="nav-item nav-link">Giới thiệu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Tin tức</a>
                            <div class="dropdown-menu">
                                <?php
                                    $sql_danhmuctin = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC"); 
                                    while($row_danhmuctin = mysqli_fetch_array($sql_danhmuctin)){
				?>
                                <a href="?quanly=tintuc&id_tin=<?php echo $row_danhmuctin['danhmuctin_id'] ?>" class="nav-item nav-link"><?php echo $row_danhmuctin['tendanhmuc'] ?></a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <a href="include/lienhe.php" class="nav-item nav-link">Liên hệ</a>
                        <a href="#" class="nav-item nav-link">|</a>
                        <a href="?quanly=giohang" class="nav-item nav-link"><i class="fas fa-cart-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->