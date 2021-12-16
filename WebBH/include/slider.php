<!-- Carousel Start -->
        <div class="carousel">
            <div class="container-fluid">
                <div class="owl-carousel">
                    <?php
			$sql_slider = mysqli_query($con,"SELECT * FROM tbl_slider WHERE slider_active='1' ORDER BY slider_id");
			while($row_slider = mysqli_fetch_array($sql_slider)){ 
                    ?>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="uploads/<?php echo $row_slider['slider_image'] ?>" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1><span><?php echo $row_slider['slider_caption'] ?></span></h1>
                            <p>...</p>
                            <div class="carousel-btn">
                                <a class="btn custom-btn" href="">Xem sản phẩm</a>
                                <a class="btn custom-btn" href="">Xem tin tức</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- Carousel End -->