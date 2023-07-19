<?php
include 'config.php';
if(isset($_POST['order_btn'])){
    $name = $_POST['name'];
    $number = $_POST['number']; 
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pin = $_POST['pin'];
   
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
    $total_products = "";
    $total_price = 0;

    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name = $product_item['name'];
            $product_quantity = $product_item['quantity'];
            $product_price = $product_item['price'];
            $total_products .= $product_name . '(' . $product_quantity . '), ';
            $total_price += $product_price * $product_quantity;
        }
        $total_products = rtrim($total_products, ', ');

        $detail_query = mysqli_query($conn, "INSERT INTO `orders` (`name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin`, `total_products`, `total_price`) VALUES ('$name', '$number', '$email', '$method', '$flat', '$street', '$city', '$state', '$country', '$pin', '$total_products', '$total_price')");

        if ($detail_query) {
            echo "
            <div class='order-confirm-container'>
                <div class='message-container'>
                    <h3>Thank you for shopping</h3>
                    <div class='order-detail'>
                        <span>".$total_products."</span>
                        <span class='total'>Total: $".$total_price."/-</span>
                    </div>
                    <div class='customer-details'>
                        <p>Your name: <span>".$name."</span></p>
                        <p>Your number: <span>".$number."</span></p>
                        <p>Your email: <span>".$email."</span></p>
                        <p>Your address: <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country.", ".$pin."</span></p>
                        <p>Payment method: <span>".$method."</span></p>
                        <p class='pay'>(*Pay when product arrives*)</p>
                    </div>
                    <a href='products.php' class='btn'>Continue Shopping</a>
                </div>
            </div>
            ";
        } else {
            echo "Failed to insert order details.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <link rel="stylesheet" href="../admin/admin_header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <div class="checkout-form">
        <h1>Payment Process</h1>
        <div class="display-order">
            <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                $total = 0;
                $grand_total=0;
                if (mysqli_num_rows($select_cart) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total = $total += $total_price;
                
                        ?>
                        <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                        <?php
                    }
                }
                
            ?>
            <span class="grand-total">Total amount payable : $<?= $grand_total; ?>/-</span>
        </div>
        <form method="post">
            <div class="input-field">
                <span>your name</span>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="input-field">
                <span>your number</span>
                <input type="number" name="number" placeholder="Enter your number" required>
            </div>
            <div class="input-field">
                <span>your email</span>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-field">
                <span>payment method</span>
                <select name="method">
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paytm">paytm</option>
                    <option value="phone pay">phone pay</option>
                    <option value="pay pal">pay pal</option>
                </select>
            </div>
            <div class="input-field">
                <span>address line 1</span>
                <input type="text" name="flat" palaceholder="e.g flat no." required>
            </div>
            <div class="input-field">
                <span>address line 2</span>
                <input type="text" name="street" palaceholder="e.g street name" required>
            </div>
            <div class="input-field">
                <span>city</span>
                <input type="text" name="city" palaceholder="e.g Delhi" required>
            </div>
            <div class="input-field">
                <span>state</span>
                <input type="text" name="state" palaceholder="e.g new Delhi" required>
            </div>
            <div class="input-field">
                <span>country</span>
                <input type="text" name="country" palaceholder="e.g India" required>
            </div>
            <div class="input-field">
                <span>pin code</span>
                <input type="text" name="pin" palaceholder="e.g 12345678" required>
            </div>
            <input type="submit" name="order_btn" value="order now"class="btn" >
        </form>
    </div>
</body>
</html>