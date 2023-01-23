<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styleee.css">

</head>
<body>
   
<div class="container">

<?php @include 'header.php'; ?>

<section class="about">

   <img src="images/about.jpg" alt="">
   <h3>About Us! </h3>
   <p> We are a college student in Isabela State University and we decided to have a wedding online plan project to help the future couples in planning their wedding more easier.</p>
   <a href="contact.php" class="btn">Contact Us!</a>

</section>

<section class="team">

   <h1 class="heading">Our team</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/arjay.jpg" alt="">
         <h3>Arjay Louis S. Manzano</h3>
         <p>Wedding coordinator</p>
         <div class="share">
            <a href="https://www.facebook.com/profile.php?id=100006538291181" class="fab fa-facebook-f"></a>
            <a href="404_about.php" class="fab fa-twitter"></a>
            <a href="404_about.php" class="fab fa-linkedin"></a>
            <a href="404_about.php" class="fab fa-instagram"></a>
         </div>
      </div>

      <div class="box">
         <img src="images/alvin.jpg" alt="">
         <h3>Alvin S. Reolalas</h3>
         <p>Wedding coordinator</p>
         <div class="share">
            <a href="https://www.facebook.com/alvin.reolalas" class="fab fa-facebook-f"></a>
            <a href="404_about.php" class="fab fa-twitter"></a>
            <a href="404_about.php" class="fab fa-linkedin"></a>
            <a href="404_about.php" class="fab fa-instagram"></a>
         </div>
      </div>

      <div class="box">
         <img src="images/lemmor.jpg" alt="">
         <h3>Mark Lemmor Garcia </h3>
         <p>Wedding coordinator</p>
         <div class="share">
            <a href="https://www.facebook.com/kramrommel.garcia" class="fab fa-facebook-f"></a>
            <a href="404_about.php" class="fab fa-twitter"></a>
            <a href="404_about.php" class="fab fa-linkedin"></a>
            <a href="404_about.php" class="fab fa-instagram"></a>
         </div>
      </div>

   </div>

</section>

<?php @include 'footer.php'; ?>

</div>















<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>