<?php
	include('../db/connect.php');
?>
<?php
	if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$sql_insert_product = mysqli_query($con,"INSERT INTO tbl_sanpham(sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image,category_id) values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh','$danhmuc')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
	}elseif(isset($_POST['capnhatsanpham'])) {
		$id_update = $_POST['id_update'];
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		if($hinhanh==''){
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong',sanpham_image='$hinhanh',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
		mysqli_query($con,$sql_update_image);
	}
	
?> 
<?php
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_sanpham WHERE sanpham_id='$id'");
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm - Admin</title>
    
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
                <h2>Sản phẩm</h2>
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
			if(isset($_GET['quanly'])=='capnhat'){
				$id_capnhat = $_GET['capnhat_id'];
				$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				$id_category_1 = $row_capnhat['category_id'];
				?>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Cập nhật sản phẩm</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <!-- Button trigger for scrolling content modal -->
                                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalScrollable">Sửa</button>
                                                <!--scrolling content Modal -->
                                                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Cập nhật sản phẩm</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <label>Tên sản phẩm: </label>
                                                                <input type="text" name="tensanpham" class="form-control" value="<?php echo $row_capnhat['sanpham_name'] ?>">
                                                                <input type="hidden" name="id_update" class="form-control" value="<?php echo $row_capnhat['sanpham_id'] ?>">
                                                                <label>Ảnh: </label>
                                                                <input type="file" name="hinhanh" class="form-control">
                                                                <img src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?>" style="width:60px;height:70px;"><br>    
                                                                <label>Giá: </label>
                                                                <input type="text" name="giasanpham" class="form-control" value="<?php echo $row_capnhat['sanpham_gia'] ?>">
                                                                <label>Giá khuyễn mãi: </label>
                                                                <input type="text" name="giakhuyenmai" class="form-control" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>">
                                                                <label>Số lượng: </label>
                                                                <input type="text" name="soluong" class="form-control" value="<?php echo $row_capnhat['sanpham_soluong'] ?>">
                                                                <label>Mô tả: </label>
                                                                <input type="text" name="mota" class="form-control" value="<?php echo $row_capnhat['sanpham_mota'] ?>">
                                                                <label>Chi tiết: </label>
                                                                <input type="text" name="chitiet" class="form-control" value="<?php echo $row_capnhat['sanpham_chitiet'] ?>">
                                                                
                                                                <label>Danh mục sản phẩm: </label>
                                                                <?php
                                                                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
                                                                ?>
                                                                <select class="choices form-select" name="danhmuc">
                                                                    <option value="0">---------------------- Chọn danh mục ----------------------</option>
                                                                    <?php
                                                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                                                            if($id_category_1==$row_danhmuc['category_id']){
                                                                    ?>
                                                                        <option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                                                    <?php
                                                                        } else {
                                                                        ?>
                                                                        <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="capnhatsanpham" class="btn btn-primary ml-1">Sửa</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        } else {
                            ?>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <h4 class="card-title">Thêm sản phẩm</h4>
                                                    <!-- Button trigger for login form modal -->
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                                        data-bs-target="#inlineForm">Thêm</button>

                                                    <!--login form Modal -->
                                                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                                                        aria-labelledby="myModalLabel33" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel33">Thêm sản phẩm </h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <label>Tên sản phẩm: </label>
                                                                        <input type="text" name="tensanpham" class="form-control" placeholder="Điền tên sản phẩm..">
                                                                        <label>Ảnh: </label>
                                                                        <input type="file" name="hinhanh" class="form-control">
                                                                        <label>Giá: </label>
                                                                        <input type="text" name="giasanpham" class="form-control" placeholder="Điền giá sản phẩm..">
                                                                        <label>Giá khuyễn mãi: </label>
                                                                        <input type="text" name="giakhuyenmai" class="form-control" placeholder="Điền giá khuyễn mãi">
                                                                        <label>Số lượng: </label>
                                                                        <input type="text" name="soluong" class="form-control" placeholder="Điền số lượng nhập">
                                                                        <label>Mô tả: </label>
                                                                        <input type="text" name="mota" class="form-control" placeholder="Điền thông tin mô tả sản phẩm..">
                                                                        <label>Chi tiết: </label>
                                                                        <input type="text" name="chitiet" class="form-control" placeholder="Điền chi tiết sản phẩm..">
                                                                        
                                                                        <label>Danh mục sản phẩm: </label>
                                                                        <?php
                                                                        $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
                                                                        ?>
                                                                        <select class="choices form-select" name="danhmuc">
                                                                            <option value="0">---------------------- Chọn danh mục ----------------------</option>
                                                                            <?php
                                                                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                                                            ?>
                                                                            <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select> 
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="themsanpham" class="btn btn-primary ml-1">Thêm</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                    
                    
                    
                    
                    
                    <div class="card-header">
                        <h4 class="card-title">Danh sách sản phẩm</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <?php
                            $sql_select_sp = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_category WHERE tbl_sanpham.category_id=tbl_category.category_id ORDER BY tbl_sanpham.sanpham_id DESC LIMIT 20"); 
			?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN SẢN PHẨM</th>
                                        <th>HÌNH ẢNH</th>
                                        <th>SỐ LƯỢNG</th>
                                        <th>GIÁ SẢN PHẨM</th>
                                        <th>GIÁ KHUYẾN MÃI</th>
                                        <th>DANH MỤC</th>
                                        <th>QUẢN LÝ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					$i = 0;
					while($row_sp = mysqli_fetch_array($sql_select_sp)){ 
						$i++;
					?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row_sp['sanpham_name'] ?></td>
                                        <td><img src="../uploads/<?php echo $row_sp['sanpham_image'] ?>" style="width:60px;height:70px;"></td>
                                        <td><?php echo $row_sp['sanpham_soluong'] ?></td>
                                        <td><?php echo number_format($row_sp['sanpham_gia']).' đ' ?></td>
                                        <td><?php echo number_format($row_sp['sanpham_giakhuyenmai']).' đ' ?></td>
                                        <td><?php echo $row_sp['category_name'] ?></td>
                                        <td>
                                            <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>" class="btn btn-warning">Sửa</a> |
                                            <a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>" class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <section class="section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-primary">
                                                    <li class="page-item"><a class="page-link" href="#">
                                                            <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                                                        </a></li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">
                                                            <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                                                        </a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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