 <!-- Site footer -->
 <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
          <h6>Địa chỉ</h6>
          <iframe width="400" height="225" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJuSssds6sNTERhtfMg0bhZLs&key=AIzaSyDM1YpNzsByHaQNJ5uLKw5eeOWRjZS3Bbk" allowfullscreen></iframe>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Danh mục sản phẩm</h6>
            <ul class="footer-links">
              <?php
                require_once('products.php');
                $categories = getCategories();
                for($i=0; $i< count($categories); $i++){
                    $category = $categories[$i];
              ?>
                <li><a> <?php echo $category['name'];?> </a></li>
              <?php 
                }
              ?>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="index.php">Trang chủ</a></li>
              <li><a href="login.php?url=index.php">Đăng nhập</a></li>
              <li><a href="signup.php">Đăng kí</a></li>
            </ul>
          </div>
        </div>
      </div>
</footer>