<?php
include 'header.php';
include 'config.php';
 if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_temp_name = $_FILES['image']['tmp_name'];
    $image_folder ='../image/'.$image;

    $query = "INSERT INTO `products`(`name`, `price`, `image`) VALUES ('$name',' $price','$image')";
    $insert_query = mysqli_query($conn, $query);

    if($insert_query){
        move_uploaded_file($image_temp_name, $image_folder);
        $message[] = 'product added sucessfully';
        header('location:view_product.php');
    }else{
        $message[] = 'product not added sucessfully';
    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin_header.css">
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
    <div class="form">
        <form method="post" enctype="multipart/form-data">
            <h3>Add a new product</h3>
            <input type="text"name="name" placeholder="enter product name" required>
            <input type="number"name="price" placeholder="enter product price" required>
            <input type="file"name="image" accept="image/png, image/jpg" required>
            <input type="submit"name="add_product" value="add product" class="btn">
        </form>
    </div>
</body>
</html>