<?php
    $sql_cate_home = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC");
    while($row_cate_home = mysqli_fetch_array($sql_cate_home)){
        $id_category = $row_cate_home['category_id'];
?>
        <div class="team">
            <div class="container">
                <div class="section-header text-center">
                    <h2><?php echo $row_cate_home['category_name'] ?></h2>
                </div>
                <div class="row">
                    <?php
                        $sql_product = mysqli_query($con,"SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC");
			while($row_sanpham = mysqli_fetch_array($sql_product)){ 
                            if($row_sanpham['category_id']==$id_category){
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="team-item">
                            <div class="team-img">
                                <img src="uploads/<?php echo $row_sanpham['sanpham_image'] ?>" alt="Image" style="height:300px;">
                                <div class="team-social">
                                    <a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>"><i class="fas fa-eye"></i></a>
                                    <a href=""><i class="fas fa-heart"></i></a>
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
                        }
                    ?>
                </div>
            </div>
        </div>
<?php
    }
?>
        <!-- Team End -->