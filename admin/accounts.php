<?php 
    include_once('../users.php');
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
        <li class="breadcrumb-item active">Người dùng</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Danh sách người dùng</div>
        <div class="card-body">
            <a href="users_add.php" class="btn btn-info">Thêm mới</a>
            <br><br>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>

                  <th>username</th>
                  <th>Password</th>
                  <th>First Name</th>
                  <th>Last Name/th>
                  <th>phone</th>
                  <th>email</th>

                </tr>
              </thead>
              <tbody>
<?php
    // require_once('../users.php');
    $users = getUsers();
    for($i = 0; $i < count($users); $i++) {
?>
                <tr>
                  <td><?php echo $users[$i]['username']; ?></td>
                  <td><?php echo $users[$i]['password']; ?></td>
                  <td><?php echo $users[$i]['firstname']; ?></td>
                  <td><?php echo $users[$i]['lastname']; ?></td>
                  <td><?php echo $users[$i]['phone']; ?></td>
                  <td><?php echo $users[$i]['email']; ?></td>
                  <td><a class="btn btn-sm btn-info" href="users_edit.php?userid=<?php echo $users[$i]['userid']; ?>"><i class="fa fa-edit"></i> Sửa</a>
                  | <a class="btn btn-sm btn-danger" href="users_delete.php?userid=<?php echo $users[$i]['userid']; ?>"><i class="fa fa-trash"></i> Xóa</a></td>
                </tr>
<?php
    }
?>                  
              </tbody>
            </table>
            <div class="btn btn-group">

            <!-- <?php
                for($i = 1; $i <= $pagecount; $i++) {
            ?>
                <button class="btn btn-default"><a href="?<?php echo overrideParams($_SERVER['QUERY_STRING'], 'page', $i); ?>"><?php echo $i; ?></a></button>
            <?php
                }
            ?> -->
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