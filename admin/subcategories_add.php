<?php 
    include_once('../users.php');
    include_once('../products.php');
    session_start();
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
        header("Location:../login.php?url=".urlencode('admin/index.php'));
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = getConnection();
        $cateid = mysqli_real_escape_string($connection,$_POST['cateid']);
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        if ($name == NULL) $name = "Chưa đặt tên";
        $description = mysqli_real_escape_string($connection,$_POST['description']); 
        if ($description == NULL) $description = "";
        if (addSubcategory($cateid, $name, $description)) {
            header("Location:subcategories.php?cateid=".$cateid);
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
          <a href="subcategories.php">Nhóm sản phẩm con</a>
        </li>
        <li class="breadcrumb-item active">Thêm mới</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-plus"></i> Thêm mới nhóm sản phẩm con</div>
        <div class="card-body">
            <form action="" method="POST">

        <div class="form-group">
        <label for="usr">Nhóm sản phẩm</label>
        <select class="form-control" id="cateid" name="cateid">
        <?php
            $categories = getCategories();
            for($i = 0; $i < count($categories); $i++) {
        ?>
            <option value="<?php echo $categories[$i]['id']; ?>"><?php echo $categories[$i]['name']; ?></option>
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
        <label for="pwd">Mô tả:</label>
        <input type="text" class="form-control" id="description" name="description">
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