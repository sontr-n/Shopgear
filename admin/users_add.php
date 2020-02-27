<?php 
    include_once('../users.php');

    session_start();
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']){
        header("Location:../login.php?url=".urlencode('admin/index.php'));
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = getConnection();
        $username = $_POST['username'];
        if ($username == NULL) $username = "Chưa đặt tên";
        $password = $_POST['password'];
        if ($password == NULL) $password = "1";
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


        addUser($username, $password, $firstname, $lastname, $email, $phone);
        header("Location:accounts.php");
        
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
          <a href="categories.php">Người dùng</a>
        </li>
        <li class="breadcrumb-item active">Thêm mới</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-plus"></i> Thêm người dùng</div>
        <div class="card-body">
            <form action="" method="POST">
        <div class="form-group">
        <label for="usr">Username:</label>
        <input type="text" class="form-control" id="username" name="username">
        </div>

        <div class="form-group">
        <label for="usr">Password:</label>
        <input type="text" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
        <label for="usr">First Name:</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
        </div>

        <div class="form-group">
        <label for="usr">Lastname:</label>
        <input type="text" class="form-control" id="lastname" name="lastname">
        </div>        
        
        <div class="form-group">
        <label for="pwd">email:</label>
        <input type="text" class="form-control" id="email" name="email">

        <div class="form-group">
        <label for="pwd">phone:</label>
        <input type="text" class="form-control" id="phone" name="phone">
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