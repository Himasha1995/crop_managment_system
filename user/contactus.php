<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Contact Us </title>
    <link rel="stylesheet" href="../css/contactus.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Surkhet, NP12</div>
          <div class="text-two">Birendranagar 06</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+0098 9893 5647</div>
          <div class="text-two">+0096 3434 5678</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">codinglab@gmail.com</div>
          <div class="text-two">info.codinglab@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
      <form action="" method="POST">
        <div class="input-box">
          <input type="text" name="name"  placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" name="subject" placeholder="Enter your subject">
        </div>
        <div class="input-box">
          <input type="text" name="email" placeholder="Enter your email">
        </div>
        <div class="input-box">
          <input type="text" name="phone" placeholder="Enter your phone">
        </div>
        <div class="input-box message-box">
        <input type="text" name="message" placeholder="Enter your massege">
        </div>
        <div class="button">
        <input type="submit" value="Send" name="submit">
        </div>
      </form>
    </div>
    </div>
  </div>
   <!-- map-->
    <div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63371.8151251542!2d79.85620549999999!3d6.921838650000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1685380900352!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>


</body>
<?php
if(isset($_POST["submit"]))
{
  $name  =$_POST['name'];
  $subject =$_POST['subject'];
  $email=$_POST['email'];
  $phone =$_POST['phone'];
  $message =$_POST['message'];

  require_once   'config.php';


    $sql = "INSERT INTO `contactus`( `name`, `subject`, `email`, `phone`, `message`) VALUES ('$name','$subject','$email',' $phone',' $message')";

    $result = mysqli_query($conn,$sql);

    if($result){
      //header ("Location: ../inquiry_details.php?msg=Inquiry Record Inserted Successfully");
    }
    else{
      echo "Failed: ". mysqli_error($conn);
    }
      
}


?>

</html>