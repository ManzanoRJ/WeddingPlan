<?php

include 'connect.php';

if(isset($_COOKIE['id'])){
   $id = $_COOKIE['id'];
}else{
   $id = '';
}

if(isset($_POST['submit'])){
   
   $id = create_unique_id();
   $user_name = $_POST['name'];
   $user_name = filter_var($user_name, FILTER_SANITIZE_STRING); 
   $mobile = $_POST['number'];
   $mobile = filter_var($mobile, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $password = sha1($_POST['pass']);
   $password = filter_var($password, FILTER_SANITIZE_STRING); 
   $c_pass = sha1($_POST['c_pass']);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);   


   $select_users = $conn->prepare("SELECT * FROM `login_user` WHERE email = ?");
   $select_users->execute([$email]);

   if($select_users->rowCount() > 0){
      $warning_msg[] = 'email already taken!';
   }else{
      if($password != $c_pass){
         $warning_msg[] = 'Password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `login_user`(id, user_name, email, mobile, password) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $user_name, $email, $mobile, $password]);
         
         if($insert_user){
            $verify_users = $conn->prepare("SELECT * FROM `login_user` WHERE email = ? AND password = ? LIMIT 1");
            $verify_users->execute([$email, $password]);
            $row = $verify_users->fetch(PDO::FETCH_ASSOC);
         
            if($verify_users->rowCount() > 0){
               setcookie('id', $row['id'], time() + 60*60*24*30, '/');
               header('location:login.php');
            }else{
               $error_msg[] = 'something went wrong!';
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign in</title>

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


	<div class="boxx">
		<h2><span> Sign up! </span> </h2>
		<form method = "POST">
			<input type="text" name="name" placeholder="Username" required>
			<input type="email" name="email" placeholder="Email Address"required>
			<input type="number" name="number" placeholder="Phone Number"required>
			<input type="password" name="pass" placeholder="Password" required>
         <input type="password" name="c_pass" placeholder="Password" required>
         <input  type="checkbox" name="" value="yes" required><span></span>
         <a href="terms.php"><span>Terms And Conditions.</span></a>
			<p>Already Have An Account? <a href="login.php">Login now</a></p>
         <input type="submit" value="Sign In" name="submit" class="btn">>
			<br>  
		
		</form>
	</div>

	<div class="htext">
	<h2>Best Wedding <span>Planner</span></h2>
	<p>
      Experienced the stress free in planning your weding!
	</p>
	<br>
	<a href="home.php">Read more</a>

	</div>

</header>
</body>
</html>
