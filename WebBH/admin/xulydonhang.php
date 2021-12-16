<?php
	include('../db/connect.php');
?>
<?php 
if(isset($_POST['capnhatdonhang'])){
	$xuly = $_POST['xuly'];
	$mahang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET tinhtrangdon='$xuly' WHERE magiaodich='$mahang'");
}

?>
<?php
	if(isset($_GET['xoadonhang'])){
		$mahang = $_GET['xoadonhang'];
		$sql_delete = mysqli_query($con,"DELETE FROM tbl_donhang WHERE mahang='$mahang'");
		header('Location:xulydonhang.php');
	} 
	if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
		$huydon = $_GET['xacnhanhuy'];
		$magiaodich = $_GET['mahang'];
	}else{
		$huydon = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng - Admin</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Admin/style/css/bootstrap.css">
    
    <link rel="stylesheet" href="../Admin/style/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../Admin/style/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../Admin/style/css/app.css">
    <link rel="shortcut icon" href="../Admin/style/images/favicon.svg" type="image/x-icon">
</head>
<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="../Admin/dashboard.php"><img src="../Admin/style/images/logo/logoanhklee.png" alt="Logo" srcset="" style="height:60px;"></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <?php
        include('../Admin/Home/left-menu.php');
    ?>
</div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h2>Danh mục đơn hàng</h2>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../Admin/dashboard.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    

    <!-- Input with Icons start -->
    <section id="input-with-icons">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    
                    <?php
			if(isset($_GET['quanly'])=='xemdonhang'){
				$mahang = $_GET['mahang'];
				$sql_chitiet = mysqli_query($con,"SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'");
				?>
                                <div class="card-header">
                                    <h3 class="card-title">Xem chi tiết đơn hàng</h3>
                                </div>
                                <div class="table-responsive">
                                    <form action="" method="POST">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>MÃ HÀNG</th>
                                                <th>TÊN SẢN PHẨM</th>
                                                <th>SỐ LƯỢNG</th>
                                                <th>GIÁ</th>
                                                <th>TỔNG TIỀN</th>
                                                <th>NGÀY ĐẶT</th>
<!--                                                <th>QUẢN LÝ</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            while($row_donhang = mysqli_fetch_array($sql_chitiet)){ 
                                                    $i++;
                                            ?>
                                            <tr>
                                                <td width="150px"><?php echo $i ?></td>
                                                <td width="350px"><?php echo $row_donhang['mahang']; ?></td>
                                                <td width="300px"><?php echo $row_donhang['sanpham_name']; ?></td>
                                                <td width="750px"><?php echo $row_donhang['soluong']; ?></td>
                                                <td width="750px"><?php echo $row_donhang['sanpham_gia']; ?></td>
                                                <td width="750px"><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_gia']).'vnđ'; ?></td>
                                                <td width="450px"><?php echo $row_donhang['ngaythang'] ?></td>
                                                <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">
<!--                                            <td width="450px">
                                                    <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>" class="btn btn-warning">Xem đơn hàng</a> |
                                                    <a href="?xoa=<?php echo $row_donhang['donhang_id'] ?>" class="btn btn-danger">Xóa</a>
                                                </td>-->
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                        <select class="form-control" name="xuly">
                                            <option value="0">Chưa xử lý</option>
                                            <option value="1">Đã xử lý</option>
                                        </select>
                                        <input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang">
                                    </form>
                                </div>
                            <?php
                        } else {
                            ?>
                               <div class="card-header">
                                    <h3 class="card-title">Đơn hàng</h3>
                                </div>
                            <?php
                        }
                    ?>
                    
                    
                    
                    
                    
                    <div class="card-header">
                        <h4 class="card-title">Danh sách đơn hàng</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <?php
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang "); 
				?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MÃ HÀNG</th>
                                        <th>TÊN KHÁCH HÀNG</th>
                                        <th>NGÀY ĐẶT</th>
                                        <th>GHI CHÚ</th>
                                        <th>TÌNH TRẠNG</th>
                                        <th>HỦY ĐƠN</th>
                                        <th>QUẢN LÝ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?> 
                                    <tr>
                                        <td width="100px"><?php echo $i ?></td>
                                        <td width="250px"><?php echo $row_donhang['mahang']; ?></td>
                                        <td width="450px"><?php echo $row_donhang['name']; ?></td>
                                        <td width="350px"><?php echo $row_donhang['ngaythang'] ?></td>
                                        <td width="350px"><?php echo $row_donhang['note'] ?></td>
                                        <td width="350px"><?php
							if($row_donhang['tinhtrang']==0){
								echo 'Chưa xử lý';
							}else{
								echo 'Đã xử lý';
							}
						?></td>
                                        <td width="350px"><?php if($row_donhang['huydon']==0){ }elseif($row_donhang['huydon']==1){
							echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">Xác nhận hủy đơn</a>';
						}else{
							echo 'Đã hủy';
						} 
						?></td>
                                        <td width="450px">
                                            <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>" class="btn btn-warning">Xem CT</a> |
                                            <a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>" class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Input with Icons end -->


</div>
        </div>
    </div>
    <script src="../Admin/style/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../Admin/style/js/bootstrap.bundle.min.js"></script>
    
    <script src="../Admin/style/js/mazer.js"></script>
</body>

</html>
