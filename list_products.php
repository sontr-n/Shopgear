


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
<?php include_once("menu.php"); ?>
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
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<!-- End of carousel -->

<!-- Products -->
<div class="row">
   <div class="col-md-12" id="breadcrumb">
     <img src="img/autobot.png" class="breadcrumb-image" />
     <?php if(isset($_GET['subcateid'])) { echo(getSubcategoryName($_GET['subcateid'])); } ?>
    </div>
</div>
<div class="row" id="product-lists">
        <?php
        $page = 1;
        $pagecount = 1;
        if (isset($_GET['page'])) $page = $_GET['page'];
        if(isset($_GET['subcateid'])) {
          $products = getProductsBySubcateId($_GET['subcateid'], $page);
          $pagecount = countPageProductsBySubcateId($_GET['subcateid']);
        }
        if (isset($_GET["search"])) {
          $products = searchProductsByName($_GET["search"]);
        }
        if (count($products) == 0) {
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="product-list-item">Chưa có sản phẩm nào</div>
        </div>
        <?php
        } else {
          for($i = 0; $i < count($products); $i++) {
            $product = $products[$i]; ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="product-list-item">
                <a href="detail_product.php?id=<?php echo $product['id'] ?>">
                <div class="product-image">
                  <img src="img/p300_gearvn_large.jpg" >
                </div>
                <div class="product-name">
                  <?php echo $product['name']; ?>
                </div>
                <div class="product-price">
                  <i class="fa fa-gift"></i>
                  <?php
                  echo formatPrice($product['price']).' VNĐ'; ?>
                </div>
                </a>
              </div>
            </div>
    <?php
        }
      }
    ?>




</div>
<ul class="pagination">
   <?php
       for($i = 1; $i <= $pagecount; $i++) {
   ?>
       <li><a href="?<?php echo overrideParams($_SERVER['QUERY_STRING'], 'page', $i); ?>"><?php echo $i; ?></a></li>
   <?php
       }
   ?>
</ul> 
<!-- End of products -->
</div>
            <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.js"></script>
            <script type="text/javascript" src="js/site.js"></script>
</body>

</html>