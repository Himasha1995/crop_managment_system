<?php
include 'header.php';
include 'config.php';
if(isset($_POST['add_to_cart'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = 1;

    $select_cart = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE name = ?");
    mysqli_stmt_bind_param($select_cart, "s", $name);
    mysqli_stmt_execute($select_cart);
    mysqli_stmt_store_result($select_cart);

    if(mysqli_stmt_num_rows($select_cart) > 0){
        $message[] = 'Product already added to your cart';
    } else {
        $insert_query = mysqli_prepare($conn, "INSERT INTO `cart`(`name`, `price`, `image`, `quantity`) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_query, "sssi", $name, $price, $image, $quantity);
        mysqli_stmt_execute($insert_query);
        $message[] = 'Product added to your cart';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" href="../admin/admin_header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
<?php
    if (isset($message)) {
        foreach($message as $message) {
            echo '
                <div class="message">
                    <span>'.$message.'<i class="bi bi-x" onclick="this.parentElement.style.display=\'none\'"></i></span>
                </div>
            ';
        }
    }
?>
    <div class="product-container">
            <h1>latest product</h1>
           <div class="product-item-container">
            <?php
               $select_products = mysqli_query($conn, "SELECT * FROM `products`");
               if (mysqli_num_rows($select_products) > 0) {
                   while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                   
             ?>
                    
                    <form method="post">
                        <div class="box">
                            <img src="../image/<?php echo $fetch_products['image'];?>"> 
                            <h3><?php echo $fetch_products['name']; ?></h3>
                            <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                            <input type="hidden" name="name" value="<?php echo $fetch_products['name'];?>">
                            <input type="hidden" name="price" value="<?php echo $fetch_products['price'];?>">
                            <input type="hidden" name="image" value="<?php echo $fetch_products['image'];?>">
                            <input type="submit" name="add_to_cart" value="add_to_cart" class="btn">
                        </div>
                    </form>
                    <?php
                    }
                }
            ?>
           </div>        
    </div>
</body>
</html>