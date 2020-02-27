<?php
include_once("products.php");
$item_total = 0;
$itemsA = array();
function send_mail($mailto, $info) {
    $itemsA = $items;
    $title = "Shopgear.com - Confirm Purchase";
    $msg = "
        <html>
            <body>
                <table>
                    <tr>    
                        <td><label><strong>Người nhận: </strong></label></td>
                        <td>".$info["name"]."</td>
                    </tr>
                    <tr>    
                        <td><label><strong>Số ĐT người nhận: </strong></label></td>
                        <td>".$info["phone"]."</td>
                    </tr>
                    <tr>    
                        <td><label><strong>Địa chỉ người nhận: </strong></label></td>
                        <td>".$info["address"]."</td>
                    </tr>
                </table>
            
        ";
    $msg .= "<table>
                <tr>
                <th><strong>Sản phẩm</strong></th>
                <th><strong>Số lượng</strong></th>
                <th><strong>Giá</strong></th>
                </tr>
            </table>";
    foreach ($_SESSION["cart_item"] as $item) {
        $msg .= "
        <tr>
        <td><strong>".$item["name"]."</strong></td>
        <td>".$item["quantity"]."</td>
        <td>".formatPrice($item["price"])." VND</td>
        </tr>";
        $item_total += ($item["price"]*$item["quantity"]);
    }
    $msg .= "<td align=right><strong>Thành tiền:</strong>".formatPrice($item_total)." VND</td>
        </table>
        </body>
    </html>
    "; 
    mail($mailto, $title, $msg);

}
?>  


<html>
    <body>
        <?php if (isset($_SESSION["cart-item"])) echo "test"; ?>
    </body>
</html>