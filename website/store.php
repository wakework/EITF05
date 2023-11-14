<?php
session_start();
include("connection.php");
include("check_login.php");

check_login($con);
if (empty($_SESSION['key'])) {
    $_SESSION['key'] = bin2hex(random_bytes(32));
}

$csrf = hash_hmac('sha256', 'store.php', $_SESSION['key']);
if (isset($_POST["add"])) {
    if (hash_equals($csrf, $_POST['csrf'])) {

        if (isset($_SESSION["cart"])) {
            $item_array_id = array_column($_SESSION['cart'], "product_id");

            $count = count($_SESSION["cart"]);
            if (!in_array($_GET['id'], $item_array_id)) {

                $item_array = array(
                    'product_id' => $_GET['id'],
                    'item_name' => $_POST['hidden_name'],
                    'product_price' => $_POST['hidden_price'],
                    'item_quantity' => $_POST['quantity'],
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="store.php"</script>';
            } else {
                foreach ($_SESSION["cart"] as $k => $v) {
                    if ($_SESSION["cart"][$k]["product_id"] == $_GET['id'])
                        $_SESSION["cart"][$k]["item_quantity"] += $_POST['quantity'];
                }
            }
        } else {
            $item_array = array(
                'product_id' => $_GET['id'],
                'item_name' => $_POST['hidden_name'],
                'product_price' => $_POST['hidden_price'],
                'item_quantity' => $_POST['quantity'],
            );
            $_SESSION["cart"][0] = $item_array;
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
        <a href="logout.php">Logout</a>
        <h2>Welcome to the Shop</h2>
        <?php
        $query = "SELECT * FROM products ORDER BY id ASC ";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {


        ?>
                <div class="row">
                    <form method="post" action="store.php?action=add&id=<?php echo $row['id']; ?>">
                        <div class="col-sm">
                            <h5 class="text-info"><?php echo $row["product_name"]; ?></h5>
                            <h5 class="text-danger"><?php echo $row["price"]; ?>$</h5>
                            <input type="number" min=0 name="quantity" class="form-control" value="1">
                            <input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                            <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
                            <input type="submit" name="add" style="margin-top: 2px" value="Add to Cart">
                        </div>
                    </form>
                </div>
        <?php
            }
        }
        ?>
        <br><br>
        <a href="cart.php">Checkout</a>

    </div>
</body>

</html>