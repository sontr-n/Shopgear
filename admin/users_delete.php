<?php 
    include_once('../users.php');
    session_start();
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
        header("Location:../login.php?url=".urlencode('admin/index.php'));
    }
    $user['userid'] = 0;

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $user = getUserbyId($_GET['userid']);
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = getConnection();
        $userid = $_POST['userid'];
        deleteUser($userid);
        header("Location:accounts.php");
        
    }
    if(isset($_GET['userid'])) { $product = getUserbyId($_GET['userid']); }
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
          <a href="accounts.php">Người dùng</a>
        </li>
        <li class="breadcrumb-item active">Xóa thông tin</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-edit"></i> Xóa thông tin người dùng</div>
        <div class="card-body">
            <form action="" method="POST">
        <div class="form-group">
        <input type="hidden" id="userid" name="userid" value="<?php echo $user['userid']; ?>">
        <label for="usr">Bạn có chắc chắn muốn xóa tài khoản <?php echo $user['username']?>?</label>
       
        </div>
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Xóa</button>
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