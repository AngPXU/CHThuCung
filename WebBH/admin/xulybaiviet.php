<?php
	include('../db/connect.php');
?>
<?php
	if(isset($_POST['thembaiviet'])){
		$tenbaiviet = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
                $nguoidang = $_POST['nguoidang'];
		$path = '../uploads/';
		
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$sql_insert_product = mysqli_query($con,"INSERT INTO tbl_baiviet(tenbaiviet,tomtat,noidung,danhmuctin_id,baiviet_image,nguoidang) values ('$tenbaiviet','$mota','$chitiet','$danhmuc','$hinhanh','$nguoidang')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
	}elseif(isset($_POST['capnhatbaiviet'])) {
		$id_update = $_POST['id_update'];
		$tenbaiviet = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
	
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
                $nguoidang = $_POST['nguoidang'];
		$path = '../uploads/';
		if($hinhanh==''){
			$sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',noidung='$chitiet',tomtat='$mota',danhmuctin_id='$danhmuc',nguoidang='$nguoidang' WHERE baiviet_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',noidung='$chitiet',tomtat='$mota',danhmuctin_id='$danhmuc',nguoidang='$nguoidang',baiviet_image='$hinhanh' WHERE baiviet_id='$id_update'";
		}
		mysqli_query($con,$sql_update_image);
	}
	
?> 
<?php
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_baiviet WHERE baiviet_id='$id'");
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài viết - Admin</title>
    
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
				$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_baiviet WHERE baiviet_id='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				$id_category_1 = $row_capnhat['danhmuctin_id'];
				?>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Cập nhật Bài viết</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">

                                                        <form action="" method="POST" enctype="multipart/form-data">    
                                                            <div class="modal-body">
                                                                <label>Tên bài viết: </label>
                                                                <textarea type="text" name="tenbaiviet" class="form-control" value="<?php echo $row_capnhat['tenbaiviet'] ?>"></textarea>
                                                                <input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['baiviet_id'] ?>">
                                                                <label>Ảnh: </label>
                                                                <input type="file" name="hinhanh" class="form-control">
                                                                <img src="../uploads/<?php echo $row_capnhat['baiviet_image'] ?>" style="width:60px;height:70px;"><br>    
                                                                
                                                                <label>Mô tả: </label>
                                                                <textarea type="text" name="mota" class="form-control" value="<?php echo $row_capnhat['tomtat'] ?>"></textarea>
                                                                <label>Chi tiết: </label>
                                                                <input type="text" name="chitiet" class="form-control" value="<?php echo $row_capnhat['noidung'] ?>">
                                                                <label>Tác giả: </label>
                                                                <input type="text" name="nguoidang" class="form-control" value="<?php echo $row_capnhat['nguoidang'] ?>">
                                                                <label>Danh mục bài viết: </label>
                                                                <?php
                                                                $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC"); 
                                                                ?>
                                                                <select class="choices form-select" name="danhmuc">
                                                                    <option value="0">---------------------- Chọn danh mục ----------------------</option>
                                                                    <?php
                                                                    while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                                                            if($id_category_1==$row_danhmuc['danhmuctin_id']){
                                                                    ?>
                                                                        <option selected value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                                                    <?php
                                                                        } else {
                                                                        ?>
                                                                        <option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="capnhatbaiviet" class="btn btn-primary ml-1">Sửa</button>
                                                            </div>
                                                        </form>
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
                                                    <h4 class="card-title">Thêm bài viết</h4>
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
                                                                    <h4 class="modal-title" id="myModalLabel33">Thêm bài viết </h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <form action="" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <label>Tên bài viết: </label>
                                                                        <input type="text" name="tenbaiviet" class="form-control" placeholder="Điền tên bài viết..">
                                                                        <label>Ảnh: </label>
                                                                        <input type="file" name="hinhanh" class="form-control">
                                                                        
                                                                        <label>Mô tả: </label>
                                                                        <input type="text" name="mota" class="form-control" placeholder="Điền thông tin mô tả sản phẩm..">
                                                                        <label>Chi tiết: </label>
                                                                        <input type="text" name="chitiet" class="form-control" placeholder="Điền chi tiết sản phẩm..">
                                                                        <label>Người đăng: </label>
                                                                        <input type="text" name="nguoidang" class="form-control" placeholder="Điền thông tin tác giả..">
                                                                        
                                                                        <label>Danh mục sản phẩm: </label>
                                                                        <?php
                                                                        $sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC"); 
                                                                        ?>
                                                                        <select class="choices form-select" name="danhmuc">
                                                                            <option value="0">---------------------- Chọn danh mục ----------------------</option>
                                                                            <?php
                                                                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                                                            ?>
                                                                            <option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select> 
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" name="thembaiviet" class="btn btn-primary ml-1">Thêm</button>
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
                        <h4 class="card-title">Danh sách bài viết</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <?php
				$sql_select_bv = mysqli_query($con,"SELECT * FROM tbl_baiviet,tbl_danhmuc_tin WHERE tbl_baiviet.danhmuctin_id=tbl_danhmuc_tin.danhmuctin_id ORDER BY tbl_baiviet.baiviet_id DESC"); 
				?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>HÌNH ẢNH</th>
                                        <th>TÊN BÀI VIẾT</th>
                                        <th>DANH MỤC</th>
                                        <th>TÁC GIẢ</th>
                                        <th>NGÀY ĐĂNG</th>
                                        <th>QUẢN LÝ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					$i = 0;
					while($row_bv = mysqli_fetch_array($sql_select_bv)){ 
						$i++;
					?> 
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><img src="../uploads/<?php echo $row_bv['baiviet_image'] ?>" style="width:60px;height:70px;"></td>
                                        <td><?php echo $row_bv['tenbaiviet'] ?></td>
                                        <td><?php echo $row_bv['tendanhmuc'] ?></td>
                                        <td><?php echo $row_bv['nguoidang'] ?></td>
                                        <td><?php echo $row_bv['ngaydang'] ?></td>
                                        <td>
                                            <a href="xulybaiviet.php?quanly=capnhat&capnhat_id=<?php echo $row_bv['baiviet_id'] ?>" class="btn btn-warning">Sửa</a> |
                                            <a href="?xoa=<?php echo $row_bv['baiviet_id'] ?>" class="btn btn-danger">Xóa</a>
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