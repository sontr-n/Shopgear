<?php 
    include_once('../users.php');
    include_once('../products.php');
    session_start();
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
        header("Location:../login.php?url=".urlencode('admin/index.php'));
    }

    $description = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $description = $_POST['description'];
        $connection = getConnection();
        $cateid = mysqli_real_escape_string($connection,$_POST['cateid']);
        $subcateid = mysqli_real_escape_string($connection,$_POST['subcateid']);
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $producer = mysqli_real_escape_string($connection,$_POST['producer']);
        $remaining = $_POST['remaining'];
        $origin = $_POST['origin'];
        $date = $_POST['date'];
        $warranty = $_POST['warranty'];
        $price = $_POST['price'];

        if (addProduct($cateid, $subcateid, $name, $producer, $remaining, $price, $description, $origin, $warranty, $date)) {
            header("Location:products.php?subcateid=".$subcateid);
        }
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
        <li class="breadcrumb-item">
          <a href="subcategories.php">Sản phẩm</a>
        </li>
        <li class="breadcrumb-item active">Thêm mới</li>
      </ol>
      <!-- Example DataTables Card-->
      
      <div class="card mb-3">
        <div class="card-header">
        <?php echo $description; ?>
          <i class="fa fa-plus"></i> Thêm mới sản phẩm</div>
        <div class="card-body">
         <form action="" method="POST">
        <div class="form-group">
        <label for="usr">Nhóm sản phẩm</label>
        <select class="form-control" id="categoriesSelection" name="cateid" value="">
        <?php
            $categories = getCategories();
            for($i = 0; $i < count($categories); $i++) {
        ?>
            <option data-id="<?php echo $categories[$i]['id']; ?>" value="<?php echo $categories[$i]['id']; ?>"><?php echo $categories[$i]['name']; ?></option>
        <?php
            }
        ?>
        </select>
        </div>
        <div class="form-group">
        <label for="usr">Nhóm sản phẩm con</label>
        <select class="form-control" id="subCategoriesSelection" name="subcateid"  value="">
        <?php
            $subcategories = getSubcategories();
            for($i = 0; $i < count($subcategories); $i++) {
        ?>
            <option data-cateid="<?php echo  $subcategories[$i]['cateid'];?>" value="<?php echo $subcategories[$i]['id']; ?>"><?php echo $subcategories[$i]['name']; ?></option>
        <?php
            }
        ?>
        </select>

        </div>
        <div class="form-group">
        <label for="usr">Tên:</label>
        <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
        <label for="pwd">Hãng sản xuất:</label>
        <input type="text" class="form-control" id="producer" name="producer">
        </div> 
        <div class="form-group">
        <label for="pwd">Giá:</label>
        <input type="number" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
        <label for="pwd">Số lượng:</label>
        <input type="number" class="form-control" id="remaining" name="remaining">
        </div>
        <div class="form-group">
        <label for="pwd">Xuất xứ:</label>
        <input type="text" class="form-control" id="origin" name="origin">
        </div>
        <div class="form-group">
        <label for="pwd">Thời hạn bảo hành (tháng):</label>
        <input type="number" class="form-control" id="warranty" name="warranty">
        </div> 
        <div class="form-group">                   
        <label for="pwd">Năm sản xuất:</label>
        <input type="number" class="form-control" id="date" name="date">        
        </div>  
        <div class="form-group">
        <label for="pwd">Mô tả sản phẩm:</label>
        <textarea id="description" name="description"></textarea>
        </div> 
            <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Thêm</button>
        </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include_once('footer.php') ?>
  </div>
</body>

</html>