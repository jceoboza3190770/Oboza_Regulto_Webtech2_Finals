<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

  //-------------------------------------

  if($email AND $pass){
   $check_email = mysqli_query($conn, "SELECT * FROM user_form WHERE email='$email' ");
   $check_row = mysqli_num_rows($check_email);
   
       if($check_row > 0){
           $fetch = mysqli_fetch_assoc($check_email);
           $account_type = $fetch["account_type"];
           //ADMINS
                       if($account_type == "1"){
                           if($pass == $pass){
           
                                   $_SESSION["email"] = $email;
           
                               echo "<script>window.location.href='Admin.php'; </script>";
                           }
       }


  //-----------------------------------------


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
   <title>Login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="submit" name="submit" class="btn" value="login now">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>

</body>
</html>