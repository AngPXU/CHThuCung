<?php
	include('../db/connect.php');
?>
<?php
	if(isset($_POST['themdanhmuc'])){
		$tendanhmuc = $_POST['danhmuc'];
		$sql_insert = mysqli_query($con,"INSERT INTO tbl_category(category_name) values ('$tendanhmuc')");
	}elseif(isset($_POST['capnhatdanhmuc'])){
		$id_post = $_POST['id_danhmuc'];
		$tendanhmuc = $_POST['danhmuc'];
		$sql_update = mysqli_query($con,"UPDATE tbl_category SET category_name='$tendanhmuc' WHERE category_id='$id_post'");
		header('Location:xulydanhmuc.php');
	}
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_category WHERE category_id='$id'");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục - Admin</title>
    
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
                <h2>Danh mục sản phẩm</h2>
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
				$id_capnhat = $_GET['id'];
				$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_id='$id_capnhat'");
				$row_capnhat = mysqli_fetch_array($sql_capnhat);
				?>
                                <div class="card-header">
                                    <h3 class="card-title">Cập nhật danh mục</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <form action="" method="POST">
                                            <div class="col-sm-6">
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?>">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="buttons">
                                                    <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>">
                                                    <input type="submit" class="btn btn-outline-primary" name="capnhatdanhmuc" value="Sửa">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                        } else {
                            ?>
                                <div class="card-header">
                                    <h3 class="card-title">Thêm danh mục</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <form action="" method="POST">
                                            <div class="col-sm-6">
                                                <div class="form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" name="danhmuc" placeholder="Mời thêm danh mục mới..">
                                                    <div class="form-control-icon">
                                                        <i class="bi bi-list-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="buttons">
                                                    <input type="submit" class="btn btn-outline-primary" name="themdanhmuc" value="Thêm">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                    
                    
                    
                    
                    
                    <div class="card-header">
                        <h4 class="card-title">Danh sách danh mục</h4>
                    </div>
                    <div class="card-content">
                        <!-- table hover -->
                        <?php
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
				?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÊN DANH MỤC</th>
                                        <th>QUẢN LÝ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
					$i = 0;
					while($row_category = mysqli_fetch_array($sql_select)){ 
						$i++;
					?>
                                    <tr>
                                        <td width="150px"><?php echo $i ?></td>
                                        <td width="850px"><?php echo $row_category['category_name'] ?></td>
                                        <td>
                                            <a href="?quanly=capnhat&id=<?php echo $row_category['category_id'] ?>" class="btn btn-warning">Sửa</a> |
                                            <a href="?xoa=<?php echo $row_category['category_id'] ?>" class="btn btn-danger">Xóa</a>
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
