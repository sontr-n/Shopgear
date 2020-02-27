<!-- <?php
    include_once('users.php');
    session_start();
?> -->

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php"><img class="logo" src="img/logo.png"></a>
                </li>
            </ul>
            <ul class="nav navbar-nav">                
                <li method = "GET" action = "list_products.php">
                    <a><input class="form-control" name="search" type="text" placeholder="Tìm Kiếm..." aria-label="Search"></a>
                </li>                
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                <a href="#" data-toggle="modal" data-target="#cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                </li>
                <?php
                    if(!isset($_SESSION['login_user'])) {
                ?>
                <li>
                    <a href="login.php?url=index.php"><i class="fa fa-sign-in"></i> Đăng nhập</a>
                </li>
                <li>
                    <a href="signup.php"><i class="fa fa-key"></i> Đăng ký</a>
                </li>

                <?php
                    } else {
                        $username = $_SESSION['login_user'];
                        $user_fullname = getUserFullName($username);
                ?>
                <li>
                    <a href="info.php"><i class="fa fa-edit"></i> <b><?php echo($user_fullname); ?></b></a>
     
                </li>
                <li class="pull-right">
                    <a href="logout.php"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                </li>
                <?php if (isset($_SESSION['is_admin'])) {
                            if ($_SESSION['is_admin']) {
                ?>
                <li>
                    <a href="admin/index.php"><i class="fa fa-external-link"></i> [Quản trị]</a>
                </li>
                <?php
                            }
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>
<br>
<?php
    include_once('cart.php');
?>