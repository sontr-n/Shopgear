<html>

<head>
    <title>Trang chủ - GAMING GEARS</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>


<?php
session_start();
require_once('locations.php');
require_once('products.php');
require_once("mail.php");
require_once('users.php');

$error = '';
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"]*$item["quantity"]);
    }
}

$user = getUserById($_SESSION["id"]);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = getConnection();
    $to = $_POST['to'];
    $address = $_POST['address']; 
    $phone = $_POST['phone']; 
    $total = $_POST['total']; 
    $info = array("name" => $to, "address" => $address, "phone" => $phone);
    send_mail("occho@yopmail.com", $info);
    if (insertPayment($to, $address, $phone,$total)) {
        unset($_SESSION["cart_item"]);
        header("Location: purchase_success.php");
    } else {
        $error = 'Có lỗi xảy ra! Xin thử lại.';
        echo $error;
    }
}

?>

<div class="container" id="wrapper">

<div><h2>Thanh toán</h2>
<form action="" method="POST">
    <table class="table table-bordered">
    <tbody>
    <tr>
    <th><strong>Sản phẩm</strong></th>
    <th><strong>Số lượng</strong></th>
    <th><strong>Giá</strong></th>
    </tr>	
    <?php		
        foreach ($_SESSION["cart_item"] as $item){
            ?>
                    <tr>
                    <td><strong><?php echo $item["name"]; ?></strong></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td><?php echo formatPrice($item["price"])." VND"; ?></td>
                    </tr>
                    <?php
            
            }
            ?>

    <tr>
    <td colspan="5" align=right><strong>Thành tiền:</strong> <?php echo formatPrice($item_total)." VND"; ?></td>
    </tr>
    </tbody>
    </table>
    <input type="hidden" name="total" value="<?php echo $item_total; ?>">
    <div class="row">
        <div class="col-md-12">
            <label>Người nhận</label>
            <input class="form-control" id="name" name="name" required type="text" placeholder="Tên người nhận" value="<?php echo $user['username'] ?>">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <label>Email</label>
            <input class="form-control" id="email" name="email" required type="email" placeholder="Email" value="<?php echo $user['email'] ?>">
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <label>Sđt người nhận</label>
            <input class="form-control" id="phone" name="phone" required type="tel" pattern="[0-9]{10}" placeholder="Số điện thoại" value="<?php echo $user['phone'] ?>">
        </div>
    </div><br>
    
    <div class="row">
        <div class="col-md-12">
            <label> Tỉnh / Thành Phố</label>
            <select class="form-control" id="province" required>
            <?php
                $provinces = getProvinces();
                for($i=0; $i<count($provinces);$i++){
            ?>       
                <option data-provinceid="<?php echo $provinces[$i]['provinceid'];?>" value="<?php echo $provinces[$i]['provinceid'];?>"><?php echo $provinces[$i]['name'];?></option>
            <?php
                }
            ?>
            </select>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <label>Quận / Huyện</label>
            <select class="form-control" id="district" required>
            </select>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <label>Địa chỉ nhận</label>
            <textarea class="form-control" id="address" name="address" required type="text" placeholder="Địa chỉ"></textarea>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $error; ?>
        </div>
        <div class="col-md-6 text-center">
            <button class="btn btn-success" type="submit">Xong</button>
        </div>
        <div class="col-md-6 text-center">
            <a href="index.php" class="btn btn-primary">Tiếp tục mua hàng</a>
        </div>
    </div>

</form>

</div>
<!-- End -->

</div>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/site.js"></script>
</body>

</html>

