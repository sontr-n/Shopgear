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
        <li class="breadcrumb-item active">Nhóm sản phẩm</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách nhóm sản phẩm</div>
        <div class="card-body">
            <a href="categories_add.php" class="btn btn-info">Thêm mới</a>
            <br><br>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tên</th>
                  <th>Mô tả</th>
                  <th>Thực hiện</th>
                </tr>
              </thead>
              <tbody>
<?php
    $categories = getCategories();
    for($i = 0; $i < count($categories); $i++) {
?>
                <tr>
                  <td><?php echo $categories[$i]['name']; ?></td>
                  <td><?php echo $categories[$i]['description']; ?></td>
                  <td><a class="btn btn-sm btn-info" href="categories_edit.php?id=<?php echo $categories[$i]['id']; ?>"><i class="fa fa-edit"></i> Sửa</a>
                  | <a class="btn btn-sm btn-danger" href="categories_delete.php?id=<?php echo $categories[$i]['id']; ?>"><i class="fa fa-trash"></i> Xóa</a>
                  | <a class="btn btn-sm btn-info" href="subcategories.php?cateid=<?php echo $categories[$i]['id']; ?>"><i class="fa fa-eye"></i> Chi tiết</a></td>
                </tr>
<?php
    }
?>                  
              </tbody>
            </table>
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