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
        $id = mysqli_real_escape_string($connection,$_POST['id']);
        $cateid = mysqli_real_escape_string($connection,$_POST['cateid']);
        $subcateid = mysqli_real_escape_string($connection,$_POST['subcateid']);
        $name = mysqli_real_escape_string($connection,$_POST['name']);
        $producer = mysqli_real_escape_string($connection,$_POST['producer']);
        $remaining = $_POST['remaining'];
        $price = $_POST['price'];

        if (updateProduct($id, $cateid, $subcateid, $name, $producer, $remaining, $price, $description)) {
            header("Location:products.php?subcateid=".$subcateid);
        }
    }
    if(isset($_GET['id'])) { $product = getProductDetailById($_GET['id']); }
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
        <li class="breadcrumb-item active">Sửa thông tin</li>
      </ol>
      <!-- Example DataTables Card-->
      
      <div class="card mb-3">
        <div class="card-header">
        <?php echo $description; ?>
          <i class="fa fa-plus"></i> Sửa thông tin sản phẩm</div>
        <div class="card-body">
         <form action="" method="POST">
        <div class="form-group">
        <label for="usr">Nhóm sản phẩm</label>
        <input type="hidden" id="id" name="id" value="<?php echo $product['id']; ?>">
        <select class="form-control" id="categoriesSelection" name="cateid">
        <?php
            $categories = getCategories();
            for($i = 0; $i < count($categories); $i++) {
        ?>
            <option <?php if ($categories[$i]['id'] == $product['cateid']) { echo 'selected'; }?> data-id="<?php echo $categories[$i]['id']; ?>" value="<?php echo $categories[$i]['id']; ?>"><?php echo $categories[$i]['name']; ?></option>
        <?php
            }
        ?>
        </select>
        </div>
        <div class="form-group">
        <label for="usr">Nhóm sản phẩm con</label>
        <select class="form-control" id="subCategoriesSelection" name="subcateid">
        <?php
            $subcategories = array();
            $subcategories = getSubcategories();
            for($i = 0; $i < count($subcategories); $i++) {
        ?>
            <option <?php if ($subcategories[$i]['id'] == $product['subcateid']) { echo 'selected'; }?> data-cateid="<?php echo  $subcategories[$i]['cateid'];?>" value="<?php echo $subcategories[$i]['id']; ?>"><?php echo $subcategories[$i]['name']; ?></option>
        <?php
            }
        ?>
        </select>

        </div>
        <div class="form-group">
        <label for="usr">Tên:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
        </div>
        <div class="form-group">
        <label for="pwd">Hãng sản xuất:</label>
        <input type="text" class="form-control" id="producer" name="producer" value="<?php echo $product['producer']; ?>">
        </div> 
        <div class="form-group">
        <label for="pwd">Giá:</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
        </div>
        <div class="form-group">
        <label for="pwd">Số lượng:</label>
        <input type="number" class="form-control" id="remaining" name="remaining" value="<?php echo $product['remaining']; ?>">
        </div> 
        <div class="form-group">
        <label for="pwd">Mô tả sản phẩm:</label>
        <textarea id="description" name="description">
            <?php echo $product['description']; ?>
        </textarea>
        </div> 
        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Lưu</button>
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