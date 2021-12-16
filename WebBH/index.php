<?php
	session_start();
	include_once('db/connect.php');
 ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
        <title>Shop thú cưng - AnhKlee</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">
        <!-- Favicon -->
        <link href="Style/img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Nunito:600,700" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="Style/lib/animate/animate.min.css" rel="stylesheet">
        <link href="Style/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="Style/lib/flaticon/font/flaticon.css" rel="stylesheet">
        <link href="Style/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Template Stylesheet -->
        <link href="Style/css/style.css" rel="stylesheet">

</head>

<body>
	<?php
	include('include/topbar.php'); 
	include('include/menu.php');
	include('include/slider.php');
	if(isset($_GET['quanly'])){
		$tam = $_GET['quanly'];
	}else{
		$tam = '';
	}

	if($tam=='danhmuc'){
		include('include/danhmuc.php');
	}elseif($tam=='chitietsp'){
		include('include/chitietsp.php');
	}elseif($tam=='giohang') {
		include('include/giohang.php');
	}elseif ($tam=='timkiem') {
		include('include/timkiem.php');
	}elseif ($tam=='tintuc') {
		include('include/tintuc.php');
	}elseif ($tam=='chitiettin') {
		include('include/chitiettin.php');
	}elseif ($tam=='xemdonhang') {
		include('include/xemdonhang.php');
	}else{
		include('include/home.php'); 
	}
	 
	include('include/footer.php'); 
	?>
    
	<!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="Style/lib/easing/easing.min.js"></script>
        <script src="Style/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="Style/lib/tempusdominus/js/moment.min.js"></script>
        <script src="Style/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="Style/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="Style/mail/jqBootstrapValidation.min.js"></script>
        <script src="Style/mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="Style/js/main.js"></script>
</body>

</html>