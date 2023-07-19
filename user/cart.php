<?php
include 'config.php';

if(isset($_POST['update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];

    $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity='$update_value' WHERE id='$update_id'") or die('query failed');
    if($update_query){
        header('location:cart.php');
    }
} 
 if(isset($_GET['remove'])){
    $remove_id= $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$remove_id'");
    header('location:cart.php');
 }
 if(isset($_GET['delete_all'])){

    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:cart.php');
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="../admin/admin_header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <div class="cart-container">
    <a class="btn btn-danger" href="user_page.php" role="button">Back</a>
        <h1>Shopping Cart</h1>
        <table>
            <thead>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th>quantity</th>
                <th>total price</th>
                <th>action</th>
            </thead>
            <tbody>
            <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $grand_total = 0;

            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
                 <tr>
                    <td><img src="../image/<?php echo $fetch_cart['image']; ?>" alt=""></td>
                    <td><?php echo $fetch_cart['name']; ?></td>
                    <td>$<?php echo $fetch_cart['price']; ?>/-</td>
                    <td class="quantity">
                <form method="post">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>"><br>
                    <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" name="update_btn" value="update">
                </form>
             </td>
                <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'], 2, '.', ''); ?></td>
                <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?');" class="delete-btn">remove</a></td>
            </tr>
        <?php
            if (is_numeric($sub_total)) {
                $grand_total += $sub_total;
        }
    }
}
?>

                         <tr class="table-bottom">
                            <td><a href="products.php" class="option-btn">continue shopping</a></td>
                            <td colspan="3"><h1>total amount payble</h1></td>
                            <td style="font-weight: bold;">$<?php echo $grand_total; ?>"</td>
                            <td><a href="cart.php?delete_all" onclick="return confirm(' are you sure you want delete all  item from cart'); " class="delete-btn">delete all</a></td>
                         </tr>
            </tbody>
        </table>
        <div class="checkout-btn">
            <a href="checkout.php" class="btn" <?=($grand_total>1)?'':'disabled'?>>proceed to checkout</a>
        </div>
    </div>
</body>
</html>