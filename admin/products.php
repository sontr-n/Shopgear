<?php 
    include_once('../users.php');
    include_once('../products.php');
    session_start();
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
        header("Location:../login.php?url=".urlencode('admin/index.php'));
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include_once('navigation.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Quản trị</a>
        </li>
        <li class="breadcrumb-item active">Sản phẩm</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách sản phẩm</div>
        <div class="card-body">
            <a href="products_add.php" class="btn btn-info">Thêm mới</a>
            <br><br>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nhóm</th>
                  <th>Nhóm con</th>
                  <th>Tên</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
<?php
    $products = array();
    $page = 1;
    $limit = 20;
    $pagecount = 1;
    if (isset($_GET['page'])) $page = $_GET['page'];
    if (isset($_GET['limit'])) $limit = $_GET['limit'];
    if(isset($_GET['subcateid'])) {
        $products = getProductsBySubcateId($_GET['subcateid'], $page, $limit);
        $pagecount = countPageProductsBySubcateId($_GET['subcateid'], $limit);
    } else if(isset($_GET['cateid'])) {
        $products = getProductsByCateId($_GET['cateid'], $page, $limit);
        $pagecount = countPageProductsByCateId($_GET['cateid'], $limit);
    } else {
        $products = getProducts($page, $limit);
        $pagecount = countPageProducts($limit);
    }
    
    for($i = 0; $i < count($products); $i++) {
?>
                <tr>
                  <td><?php echo (($page-1) * $limit + $i+1);?></td>
                  <td><a href="products.php?cateid=<?php echo $products[$i]['cateid'];?>"><?php echo $products[$i]['catename']; ?></a></td>
                  <td><a href="products.php?subcateid=<?php echo $products[$i]['subcateid'];?>"><?php echo $products[$i]['subcatename']; ?></a></td>
                  <td><?php echo $products[$i]['name']; ?></td>
                  <td><?php echo formatPrice($products[$i]['price']); ?></td>
                  <td><?php echo $products[$i]['remaining']; ?></td>
                  <td><a class="btn btn-sm btn-info" href="products_edit.php?id=<?php echo $products[$i]['id']; ?>"><i class="fa fa-edit"></i> Sửa</a>
                  | <a class="btn btn-sm btn-danger" href="products_delete.php?id=<?php echo $products[$i]['id']; ?>"><i class="fa fa-trash"></i> Xóa</a></td>
                </tr>
<?php
    }
?>                  
              </tbody>
            </table>
            <div class="btn btn-group">

            <?php
                for($i = 1; $i <= $pagecount; $i++) {
            ?>
                <button class="btn btn-default"><a href="?<?php echo overrideParams($_SERVER['QUERY_STRING'], 'page', $i); ?>"><?php echo $i; ?></a></button>
            <?php
                }
            ?>
            </div> 
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include_once('footer.php') ?>
  </div>
</body>

</html>