<?php
include('../db/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng - Admin</title>
    
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
                    <div class="card-header">
                        <h4 class="card-title">Danh sách khách hàng</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <?php
				$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang,tbl_giaodich WHERE tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id DESC"); 
				?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN KHÁCH HÀNG</th>
                                        <th>SỐ ĐIỆN THOẠI</th>
                                        <th>ĐỊA CHỈ</th>
                                        <th>EMAIL</th>
                                        <th>NGÀY MUA</th>
                                        <th>QUẢN LÝ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					$i = 0;
					while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){ 
						$i++;
					?>
                                    <tr>
                                        <td width="150px"><?php echo $i ?></td>
                                        <td width="350px"><?php echo $row_khachhang['name'] ?></td>
                                        <td width="750px"><?php echo $row_khachhang['phone'] ?></td>
                                        <td width="350px"><?php echo $row_khachhang['address'] ?></td>
                                        <td width="450px"><?php echo $row_khachhang['email'] ?></td>
                                        <td width="450px"><?php echo $row_khachhang['ngaythang'] ?></td>
                                        <td width="450px">
                                            <a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>" class="btn btn-warning">Xem chi tiết</a>
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
    
    
                    <div class="card-header">
                        <h4 class="card-title">Lịch sử đặt hàng</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <?php
				if(isset($_GET['khachhang'])){
					$magiaodich = $_GET['khachhang'];
				}else{
					$magiaodich = '';
				}
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC"); 
				?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MÃ GIAO DỊCH</th>
                                        <th>TÊN SẢN PHẨM</th>
                                        <th>NGÀY ĐẶT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?>
                                    <tr>
                                        <td width="150px"><?php echo $i ?></td>
                                        <td width="350px"><?php echo $row_donhang['magiaodich'] ?></td>
                                        <td width="750px"><?php echo $row_donhang['sanpham_name'] ?></td>
                                        <td width="450px"><?php echo $row_donhang['ngaythang'] ?></td>
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
    <script src="../Admin/style/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../Admin/style/js/bootstrap.bundle.min.js"></script>
    
    <script src="../Admin/style/js/mazer.js"></script>
</body>

</html>
