<?php
include_once('products.php');
include_once("mail.php");
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$product = array(getProductById($_GET["id"]));
			$itemArray = array($product[0]["id"]=>array('name'=>$product[0]["name"], 'id'=>$product[0]["id"], 'quantity'=>$_POST["quantity"], 'price'=>$product[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($product[0]["id"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($product[0]["id"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v)  {
					if($_GET["id"] == $v["id"]) 
            unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>


<div id="cart" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Giỏ hàng của bạn</h4>
      </div>
      <div class="modal-body">
        
      <div id="shopping-cart">
    <div class="txt-heading"><a id="btnEmpty" href="?action=empty">Làm trống giỏ hàng</a></div>
    <?php
    if(isset($_SESSION["cart_item"])){
        $item_total = 0;
    ?>	
    <table class="table table-bordered">
    <tbody>
    <tr>
    <th><strong>Sản phẩm</strong></th>
    <th><strong>Số lượng</strong></th>
    <th><strong>Giá</strong></th>
    <th><strong>Xóa</strong></th>
    </tr>	
    <?php		
        foreach ($_SESSION["cart_item"] as $item){
            ?>
                    <tr>
                    <td><strong><?php echo $item["name"]; ?></strong></td>
                    <td><?php echo $item["quantity"]; ?></td>
                    <td><?php echo formatPrice($item["price"])." VND"; ?></td>
                    <td>
                    <a href="?action=remove&id=<?php echo $item["id"]; ?>" class="btn btn-danger">&times;</a>
                    </td>                    
                    </tr>
                    <?php
            $item_total += ($item["price"]*$item["quantity"]);
            }
            ?>

    <tr>
    <td colspan="5" align=right><strong>Thành tiền:</strong> <?php echo formatPrice($item_total)." VND"; ?></td>
    </tr>
    </tbody>
    </table>		
    <?php
    }
    ?>
    </div>
      </div>
      <div class="modal-footer">
        <?php if (isset($_SESSION["cart_item"])) { ?>
          <a class="btn btn-success" href="<?php if (isset($_SESSION["login_user"])) echo "payment.php";
                                                  else echo "login.php?url=payment.php"; ?>">Thanh toán</a>
        <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>

  </div>
</div>


