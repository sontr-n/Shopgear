<?php
    include_once('config.php');
    include_once('users.php');
    session_start();
    $error = '';
    if(isset($_SESSION['login_user'])){
        header("Location: index.php");
    } else {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $connection = getConnection();
            $myusername = mysqli_real_escape_string($connection,$_POST['username']);
            $mypassword = mysqli_real_escape_string($connection,$_POST['password']);
            $myfirstname = mysqli_real_escape_string($connection,$_POST['firstname']); 
            $mylastname = mysqli_real_escape_string($connection,$_POST['lastname']); 
            $myphone = mysqli_real_escape_string($connection,$_POST['phone']); 
            $email = $_POST["email"];

            if ($myusername == NULL || $mypassword == NULL || $myfirstname == NULL || $mylastname == NULL) {
                $error = "Bạn chưa điền đầy đủ thông tin đăng ký";
            } else {
                if (signup($myusername, $mypassword, $myfirstname, $mylastname, $myphone, $email)) {
                    $error = "Đăng ký thành công tài khoản ".$myusername;
                } else {
                    $error = "Đăng ký thất bại. Vui lòng thử lại sau chốc lát.";
                }
            }
         } 
?>

<html>   
<head>
   <title>Đăng ký - GAMING GEARS</title>
   <link rel="stylesheet" href="css/bootstrap.css" />
   <link rel="stylesheet" href="css/font-awesome.css" />
   <link rel="stylesheet" href="css/styles.css" />
   <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body>
    <div class="container">
    <form action = "" method = "post" id="loginForm">
        <div class="row">
            <div class="col-md-12">
                <h2 class="form-signin-heading">Đăng ký</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only" for="username">username</label>
                <input class="form-control" id="username" name="username" autofocus required type="text" placeholder="Tên Đăng nhập">    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only" for="password">Password</label>
                <input class="form-control" id="password" name="password" required type="password" placeholder="Mật khẩu">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only" for="email">email</label>
                <input class="form-control" id="email" name="email" required type="email" placeholder="Email">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only" for="firstname">Họ</label>
                <input class="form-control" id="firstname" name="firstname" required type="text" placeholder="Họ">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only" for="lastname">Tên</label>
                <input class="form-control" id="lastname" name="lastname" required type="text" placeholder="Tên">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only" for="phone">SĐT</label>
                <input class="form-control" id="phone" name="phone" type="tel" pattern="[0-9]{10}" requried placeholder="Số điện thoại">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp; <?php echo $error; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input class="btn btn-lg btn-primary btn-block" type="submit" value="Đăng ký"></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                &nbsp;
            </div>
        </div>
        <div class="row text-right">
            <div class="col-md-12">
                <a class="btn btn-info" href="index.php"><i class="fa fa-arrow-left"></i> Về trang chủ</a>
                <a class="btn btn-info" href="login.php"><i class="fa fa-key"></i> Tới trang Đăng nhập</a>
            </div>
        </div>
      </form>
    </div>
   </body>
</html>

<!-- <?php
    }
?> -->