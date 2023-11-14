<?php
session_start();
include("connection.php");
include("check_login.php");
check_login($con);
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $k => $v) {
            if ($v["product_id"] == $_GET["id"]) {
                if ($_SESSION["cart"][$k]["item_quantity"] == 1) {
                    unset($_SESSION["cart"][$k]);
                } else {
                    $_SESSION["cart"][$k]["item_quantity"] -= 1;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
</head>

<body>
    <div class="container">
        <a href="store.php">Back to shopping</a>
        <h2>Shopping Cart</h2>

        <div style="clear: both"></div>
        <h3 class="title2">Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="20%" align="left">Product name</th>
                    <th width="10%" align="left">Quantity</th>
                    <th width="13%" align="left">Price details</th>
                    <th width="10%" align="left">Total price</th>


                </tr>
                <?php
                if (!empty($_SESSION["cart"])) {
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {


                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($value["item_name"]); ?></td>
                            <td><?php echo htmlspecialchars($value["item_quantity"]); ?></td>
                            <td><?php echo htmlspecialchars($value["product_price"]); ?>$</td>
                            <td><?php echo htmlspecialchars(number_format($value["item_quantity"] * $value["product_price"], decimals: 2)); ?>$</td>
                            <td><a href="cart.php?action=delete&id=<?php echo htmlspecialchars($value["product_id"]); ?>"><span class="text-danger">Remove Item</span></a></td>
                        </tr>
                    <?php htmlspecialchars($total = $total + ($value["item_quantity"] * $value["product_price"]));
                    }

                    ?>
                    <tr>
                        <th colspan="3" align="left">Total</th>
                        <th align="left"><?php echo htmlspecialchars(number_format($total, decimals: 2)); ?>$</th>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
    <?php if (!empty($_SESSION["cart"])) { ?>
        <a href="receipt.php">Finalize Payment</a>
    <?php } ?>

</body>

</html>