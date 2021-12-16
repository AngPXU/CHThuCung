<?php
 if(isset($_POST['themgiohang'])){
 	$tensanpham = $_POST['tensanpham'];
 	$sanpham_id = $_POST['sanpham_id'];
 	$hinhanh = $_POST['hinhanh'];
 	$gia = $_POST['giasanpham'];
 	$soluong = $_POST['soluong'];	
 	$sql_select_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 	$count = mysqli_num_rows($sql_select_giohang);
 	if($count>0){
 		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
 		$soluong = $row_sanpham['soluong'] + 1;
 		$sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'";
 	}else{
 		$soluong = $soluong;
 		$sql_giohang = "INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) values ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')";

 	}
 	$insert_row = mysqli_query($con,$sql_giohang);
 	// if($insert_row==0){
 	// 	header('Location:index.php?quanly=chitietsp&id='.$sanpham_id);	
 	// }

 }elseif(isset($_POST['capnhatsoluong'])){
 	
 	for($i=0;$i<count($_POST['product_id']);$i++){
 		$sanpham_id = $_POST['product_id'][$i];
 		$soluong = $_POST['soluong'][$i];
 		if($soluong<=0){
 			$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}else{
 			$sql_update = mysqli_query($con,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
 		}
 	}

 }elseif(isset($_GET['xoa'])){
 	$id = $_GET['xoa'];
 	$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE giohang_id='$id'");

 }elseif(isset($_GET['dangxuat'])){
 	$id = $_GET['dangxuat'];
 	if($id==1){
 		unset($_SESSION['dangnhap_home']);
 	}

 
 }elseif(isset($_POST['thanhtoan'])){
 	$name = $_POST['name'];
 	$phone = $_POST['phone'];
 	$email = $_POST['email'];
 	$password = md5($_POST['password']);
 	$note = $_POST['note'];
 	$address = $_POST['address'];
 	$giaohang = $_POST['giaohang'];
 
 	$sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,email,address,note,giaohang,password) values ('$name','$phone','$email','$address','$note','$giaohang','$password')");
 	if($sql_khachhang){
 		$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
 		$mahang = rand(0,9999);
 		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
 		$khachhang_id = $row_khachhang['khachhang_id'];
 		$_SESSION['dangnhap_home'] = $row_khachhang['name'];
 		$_SESSION['khachhang_id'] = $khachhang_id;
 		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
	 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}

 	}
 }elseif(isset($_POST['thanhtoandangnhap'])){

 	$khachhang_id = $_SESSION['khachhang_id'];
 	$mahang = rand(0,9999);	
 	for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
	 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}

 	
 }
?>
<!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-header">
                        <?php 
				if(isset($_SESSION['dangnhap_home'])){
					echo '<h1 class="section-header" align="center">Giỏ hàng của '.$_SESSION['dangnhap_home'].'<a href="index.php?quanly=giohang&dangxuat=1">Đăng xuất</a></h1>';
				}else{
					echo '<h1 class="section-header" align="center">Giỏ hàng</h1>';
				}
			?>
                    </div>
                    <?php
                        $sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");   
                    ?>
                    <div class="table-main table-responsive">
                        <form action="" method="POST">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                    <th>Xóa bỏ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    $total = 0;
                                    while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)){ 
                                    $subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
                                    $total+=$subtotal;
                                    $i++;
				?>
                                <tr>
                                    <td class="total-pr">
                                        <p align="center"><b><?php echo $i ?></b></p>
                                    </td>
                                    <td class="thumbnail-img">
                                        <a href="#"><img class="img-fluid" src="uploads/<?php echo $row_fetch_giohang['hinhanh'] ?>" alt="" /></a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#"><?php echo $row_fetch_giohang['tensanpham'] ?></a>
                                    </td>
                                    <td class="quantity-box">
                                        <input type="hidden" name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
					<input type="number" min="1" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
                                    </td>
                                    <td class="total-pr">
                                        <p><?php echo number_format($row_fetch_giohang['giasanpham']).' đ' ?></p>
                                    </td>
                                    <td class="name-pr">
                                        <p><?php echo number_format($subtotal).' đ' ?></p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                                
                            </tbody>
                            <tr>
                                <td colspan="1"><input class="btn btn-warning" value="Cập nhật" type="submit" name="capnhatsoluong" ></td>
                                <td class="name-pr" colspan="7"><h5 align="right"><i class="fas fa-hand-holding-usd"></i>&ensp;Tổng tiền:&ensp;<?php echo number_format($total).' đ' ?></h5></td>
                                <?php 
                                    $sql_giohang_select = mysqli_query($con,"SELECT * FROM tbl_giohang");
                                    $count_giohang_select = mysqli_num_rows($sql_giohang_select);
                                        if(isset($_SESSION['dangnhap_home']) && $count_giohang_select>0){
                                        while($row_1 = mysqli_fetch_array($sql_giohang_select)){
                                ?>			
                                    <input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">
                                    <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
				<?php 
                                    }
				?>
                                    <input type="submit" class="btn btn-primary" value="Thanh toán giỏ hàng" name="thanhtoandangnhap">
				<?php
                                    } 
				?>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
    
    
    <?php
	if(!isset($_SESSION['dangnhap_home'])){ 
    ?>
    <!-- Start Cart  -->
    
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Thêm địa chỉ giao hàng</h3>
                        </div>
                        <form action="" method="post" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Tên của bạn *</label>
                                    <input type="text" class="form-control" name="name" id="firstName" placeholder="Tên bạn là.." value="" required>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Email *</label>
                                    <input type="text" class="form-control" name="email" id="lastName" placeholder="Email là.." value="" required>
                                    <div class="invalid-feedback"> Valid last name is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Số điện thoại *</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="phone" id="username" placeholder="" required>
                                    <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Địa chỉ *</label>
                                <input type="email" class="form-control" name="address" id="email" placeholder="">
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Mật khẩu *</label>
                                <input type="text" class="form-control" name="password" id="address" placeholder="" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address2">Ghi chú *</label>
                                <input type="text" class="form-control" name="note" id="address2" placeholder=""> </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" name="giaohang" id="country">
					<option value="1" data-display="Select">Thanh toán ATM</option>
					<option value="2">Nhận tiền tại nhà</option>
                                    </select>
                                    <div class="invalid-feedback"> Please select a valid country. </div>
                                </div>
                            </div>
                            <?php
				$sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
				while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){ 
                            ?>
				<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
				<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
                            <?php
				} 
                            ?>
                                <br>
                            <input type="submit" name="thanhtoan" class="btn btn-warning" style="width: 100%" value="Thanh toán">
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Giỏ hàng thanh toán</h3>
                                </div>
                            </div>
                        </div>
                        <?php
                            $sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");   
                        ?>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                
                                <div class="d-flex">
                                    <div class="font-weight-bold">Sản phẩm</div>
                                    <div class="ml-auto font-weight-bold">Tổng</div>
                                </div>
                                
                                <hr class="my-1">
                                <?php
                                    $total = 0;
                                    while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)){ 
                                    $subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
                                    $total+=$subtotal;
				?>
                                <div class="d-flex">
                                    <h4><?php echo $row_fetch_giohang['tensanpham'] ?></h4>
                                    <div class="ml-auto font-weight-bold"><?php echo number_format($subtotal).' đ' ?></div>
                                </div>
                                <?php
                                    }
                                ?>
                                <hr class="my-1">
                                <div class="d-flex gr-total">
                                    <h5>Tổng thanh toán</h5>
                                    <div class="ml-auto h5"><?php echo number_format($total).' đ' ?></div>
                                </div>
                                <hr> </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <?php
        }
    ?>
                                