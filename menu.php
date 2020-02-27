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