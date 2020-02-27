<html>

<head>
    <title>Trang chủ - GAMING GEARS</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
<div id="header">
    <?php
        include('header.php');
      ?>
</div>
<div class="container" id="wrapper">
<!-- List products -->
<nav class="navbar navbar-inverse">
  <div class="container">
    <ul class="nav navbar-nav">
    <?php
        require_once('products.php');
        $categories = getCategories();
        for($i = 0; $i < count($categories); $i++) {
            $category = $categories[$i];
    ?>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $category['name']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
        <?php
            $subcategories = $category['subcategories'];
            for($j = 0; $j < count($subcategories); $j++) {
                $subcategory = $subcategories[$j];
        ?>
          <li><a href="list_products.php?subcateid=<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></a></li>
            <?php } ?>
        </ul>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav> 
<!-- End of list products -->
<!-- Carousel -->

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/slideshow_1.png" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="img/slideshow_2.png" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="img/slideshow_3.png" alt="New york" style="width:100%;">
      </div>

      <div class="item">
        <img src="img/slideshow_4.png" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="sr-only">Next</span>
    </a>
  </div>

<!-- End of carousel -->

<!-- Product Detail -->
<div class="row">
   <div class="col-md-12" id="breadcrumb">
     <img src="img/autobot.png" class="breadcrumb-image" />
     <?php
        $product = NULL;
        if(isset($_GET['id'])) { $product = getProductDetailById($_GET['id']); }
      ?>
      Sản phẩm: <?php echo $product['name']; ?>
    </div>

    
</div>
<div class="row" id="product-detail">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="product-image">
      <img src="img/p300_gearvn_large.jpg" class="">
      </div>
    </div>
    <div class="col-md-8 col-sm-6 col-xs-12">
      <div class="product-name">
        <?php echo $product['name']; ?>
      </div>
      <div class="product-name">
        <?php echo $product['producer']; ?>
      </div>
      <div class="product-price">
      <i class="fa fa-gift"></i> 
        <?php echo formatPrice($product['price']).' VNĐ'; ?>
      </div>
      <div class="product-remaining">
        <table style="height:50px;">
          <td>Tình trạng: <br></td>
          <?php if($product['remaining']==0) {?>
            <td style="color:red;">Hết hàng</td>
          </table>
          <?php }?>
          <?php if($product['remaining']!=0) {?>
            <td style="color:green;">Còn hàng</td>
            </table>
            <div class="product-purchase">
              <form method="post" action="?action=add&id=<?php echo $product["id"]; ?>">
              <div><b>Số lượng</b>: <input type="number" min=1 max=10 value=1 name="quantity" />
              <input type="submit" value="Thêm vào giỏ hàng" class="btn btn-sm" /></div>
            </div>
            </form>
          <?php }?>
      </div>      
      <div class="product-warranty">
        <table style="height:50px; color:red;">
          <td>Bảo hành: <br></td>
          <td><?php echo $product['warranty'];?> <br></td>
          <td> tháng</td>
        </table>
      </div>      
    </div>
</div>
<div class="row" id="spectable">
  <h3>Thông số kĩ thuật</h3>
</div>
<div class="row" id="spectable">
    <table>
      <tr>
        <td>Thương hiệu</td>
        <td><?php echo $product['producer'];?></td>
      </tr>
      <tr>
        <td>Năm sản xuất</td>
        <td><?php echo $product['date'];?></td>
      </tr>      
      <tr>
        <td>Mô tả</td>
        <td><?php echo $product['description'];?></td>
      </tr>
      <tr>
        <td>Xuất xứ</td>
        <td><?php echo $product['origin'];?></td>
      </tr>
    </table>
  </div>  
</div>
<div class="row" id="product-detail">
 <?php
    if($product == NULL) {
 ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="product-list-item">Không tìm thấy thông tin sản phẩm</div>
        </div>
 <?php
    }
 ?>
</div>
<!-- End of products -->
</div>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/site.js"></script>
  <?php include_once("footer.php"); ?>
</body>

</html>