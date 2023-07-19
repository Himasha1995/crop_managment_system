<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles.css">
   <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/services.css" rel="stylesheet">
    <!-- Fontawesome Link for Icons -->
  </head>
  <body>
    <header>
      <nav class="navbar">
        <h2 class="logo"><a href="#">LOGO</a></h2>
        <input type="checkbox" id="menu-toggler">
        <label for="menu-toggler" id="hamburger-btn">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 18h18v-2H3v2zm0-5h18V11H3v2zm0-7v2h18V6H3z"/>
          </svg>
        </label>
        <ul class="all-links">
          <li><a href="admin_page.php">Home</a></li>
          <li><a href="product_form.php">Product Form</a></li>
          <li><a href="view_product.php">View Product</a></li>
          <li><a href="products.php">Shop</a></li>

      <section class="profile-container">
   <?php
      $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_profile->bind_param("i", $admin_id);
      $select_profile->execute();
      $result_profile = $select_profile->get_result();
      $fetch_profile = $result_profile->fetch_assoc();
   ?>
   <div class="profile">
      <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
      <div class="profile-options">
         <span class="profile-name"><?= $fetch_profile['name']; ?></span>
         <ul class="options-dropdown">
            <li><a href="admin_profile_update.php">Update Profile</a></li>
            <li><a href="logout.php" class="delete">Logout</a></li>
         </ul>
      </div>
   </div>
</section>
<script>
   // Hide dropdown when clicking outside
window.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.options-dropdown');
    const profileOptions = document.querySelector('.profile-options');
    
    if (event.target !== dropdown && event.target !== profileOptions) {
      dropdown.style.display = 'none';
    }
  });
  
</script>
        </ul>
      </nav>
    </header>
<body>
  
    <section class="homepage" id="home">
      <div class="content">
        <div class="text">
          <h1>Camping Gear and Essentials</h1>
          <p>
            Discover top-quality camping gear for unforgettable outdoor adventures. <br> Gear up and make lasting memories.</p>
        </div>
        <a href="#services">Our Services</a>
      </div>
    </section>

</body> 
</html>