<?php
session_start();
include("connection.php");
include("functions.php");
check_login($con);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Receipt</title>
</head>

<body>
    <div style="clear: both"></div>
    <h2 class="title2">Receipt</h2>
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
                        <td><?php echo $value["item_name"]; ?></td>
                        <td><?php echo $value["item_quantity"]; ?></td>
                        <td><?php echo $value["product_price"]; ?>$</td>
                        <td><?php echo number_format($value["item_quantity"] * $value["product_price"], decimals: 2); ?>$</td>
                    </tr>
                <?php $total = $total + ($value["item_quantity"] * $value["product_price"]);
                }

                ?>
                <tr>
                    <th colspan="3" align="left">Total</th>
                    <th align="left"><?php echo number_format($total, decimals: 1); ?>$</th>
                </tr>
            <?php } ?>
        </table>

    </div>
    </div>

    <a href="store.php">Go back to the shop<?php unset($_SESSION["cart"]); ?></a>
</body>

</html>