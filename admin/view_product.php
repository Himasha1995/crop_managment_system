<?php
include 'header.php';
include 'config.php';

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id=$delete_id") or die('query failed');
    if($delete_query){
        $message[]='product deleted sucessfully';
    }else{
        $message[]='product did not deleted sucesssfully';
    }
}
if (isset($_POST['update_product'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_folder = '../image/'.$update_image;

    $update_query = mysqli_query($conn, "UPDATE `products` SET id='$update_id',name='$update_name', price='$update_price',image='$update_image' WHERE id = '$update_id'") or die('query failed');
    if ($update_query) {
       move_uploaded_file($update_image_tmp_name,$update_folder);
       $message[]='product has been updated sucessfully';
       header('location:view_product.php');
    }else{
        $message[]='product could not updated sucessfully';
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
<a href="product_form.php" class="add">+</a>
<a class="btn btn-danger" href="admin_page.php" role="button">Back</a>
    <section class="show-product">
      <table>
        <thead>
          <th>product image</th>
          <th>product name</th>
          <th>product price</th>
          <th>action</th>
        </thead>
        <tbody>
        <?php
$select_products = mysqli_query($conn, "SELECT * FROM `products` ") or die('query failed');
if(mysqli_num_rows($select_products) > 0) {
    while ($row = mysqli_fetch_assoc($select_products)) {
        ?>
        <tr>
        <td><img src="../image/<?php echo $row['image']; ?>" width="100" height="100"></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['image']; ?></td>
            <td>
                <a href="view_product.php?delete=<?php echo $row['id']; ?>" class="delete-btn"><i class="bi bi-trash" onclick="return confirm('Are you sure you want to delete this item?')"></i>delete</a>
                <a href="view_product.php?edit=<?php echo $row['id']; ?>" class="option-btn"><i class="bi bi-pencil"></i>update</a>
            </td>
        </tr>
    <?php
    }
}
?>
       </tbody>
      </table>
    </section>
    <section class="edit-form">
        <?php
          if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id=$edit_id") or die('query failed');
            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <h3>Update product</h3>
                        <img src="../image/<?php echo $fetch_edit['image']; ?>" width="100" height="100">
                        <input type="hidden"name="update_id" value="<?php echo $fetch_edit['id']; ?>">
                        <input type="text"name="update_name"  value="<?php echo $fetch_edit['name']; ?>"  required>
                        <input type="number"name="update_price"  min="0" value="<?php echo $fetch_edit['price']; ?>" required>
                        <input type="file"name="update_image" accept="image/png, image/jpg" required>
                        <input type="submit"name="update_product" value="update product" class="btn update">
                        <input type="reset" value="cancel" class="btn cancel" id="close-edit">
                    </form>
                    <?php
                }
            }
            echo "<script>document.querySelector('.edit-form').style.display = 'block'</script>";
          }
        ?>
    </section>
    <script type="text/javascript">
        const closeBtn = document.querySelector('#close-edit');

        closeBtn.addEventListener('click',()=>{
            document.querySelector('.edit-form').style.display = 'none'
        })
    </script>

</body> 