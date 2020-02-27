<?php
    include_once('config.php');
    session_start();
    $error = '';
    

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = getConnection();
        $myusername = mysqli_real_escape_string($connection,$_POST['username']);
        $mypassword = mysqli_real_escape_string($connection,$_POST['password']); 
        
        $sql = "SELECT isadmin, userid FROM users WHERE username = '$myusername' and password = '$mypassword' and active=1";
        $result = select($connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);        
        $count = mysqli_num_rows($result);
        $isadmin = $row['isadmin'];
        $id = $row['userid'];
        closeConnection($connection);


        if ($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $_SESSION['is_admin'] = $isadmin;
            $_SESSION['id'] = $id;
            if(isset($_GET['url'])) {
                $targetUrl = $_GET['url'];
                header("location: $targetUrl");
            } else {
                header("location: index.php");
            }
        } else {
            $error = "Sai tên đăng nhập hoặc mật khẩu";
        }
     }    
?>
<html>   
<head>
   <title>Đăng nhập - GAMING GEARS</title>
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
                <h2 class="form-signin-heading">Vui lòng đăng nhập</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only label" for="username">username</label>
                <input class="form-control" id="username" name="username" autofocus required type="text" placeholder="Tên đăng nhập">    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="sr-only label" for="password">Password</label>
                <input class="form-control" id="password" name="password" required type="password" placeholder="Mật khẩu">
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12">
                &nbsp;<?php echo $error;?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input class="btn btn-lg btn-primary" type="submit" value="Đăng nhập"></button>
            </div>
            <div class="col-md-6">
                <a class="btn btn-lg btn-primary" href="signup.php">Đăng Kí</a>
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
            </div>
        </div>
      </form>
    </div>
   </body>
</html>