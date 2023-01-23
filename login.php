
<?php

include 'connect.php';

if(isset($_COOKIE['id'])){
   $id = $_COOKIE['id'];
}else{
   $id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING); 
   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_SANITIZE_STRING); 

   $select_users = $conn->prepare("SELECT * FROM `login_user` WHERE email = ? AND password = ? LIMIT 1");
   $select_users->execute([$email, $password]);
   $row = $select_users->fetch(PDO::FETCH_ASSOC);

   if($select_users->rowCount() > 0){
      setcookie('id', $row['id'], time() + 60*60*24*30, '/');
      header('location:home.php');
   }else{
      $warning_msg[] = 'Incorrect username or password!';
   }

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Log in</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styleee.css">

</head>
<body>
<header>
<nav>
		<div class="logo">
        <a href="#" class="logo">WeddingPlanMoNaTo.</a>
		</div>
		<div class="menu">
			<a href="register.php">Sign Up</a>
			<a href="login.php">Sign In</a>

		</div>
	</nav>
</header>

<div class="containerr">
    <form action="" method = "POST" > 
         <div class="links">
            <h3 class="title">Sign in with</h3>
            <div class="button">
                <a href="404.php" class="btn" > <i class="fab fa-google"></i> Google </a>
                 <?php @include 'flogin.php'; ?>
            </div>
        </div>

    <div class="input-box">
        <h3 class="title">or Sign in with Email</h3>
        <div class= "input">
            <span class= "far fa-envelope"> </span>
            <input type="email" name="email" placeholder="Email" id="">
    </div>
    
    <div class= "input">
        <span class= "fas fa-lock"> </span>
        <input type="password" name="password" placeholder="Password" id="">
    </div>
    <div class="checkbox">
        <input type="checkbox" name="" id="remember" required>
        <label for="remember">remenber me</label>
    </div>

  <input  type="submit" value="Log in" class= "btn">
  
   
</div>

    </form>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>
</html>