<!DOCTYPE html>
<?php include('con.php'); ?>
<html>
<head>

<title>update password</title>

<link rel="stylesheet"  type="text/css"   href="stlye.css">

</head>
<body style="background: #128184 ">

<?php

  session_start();
  $email=$_SESSION['email'];
   echo $email;

if (isset ($_POST['updatepass'])) {


    include 'con.php'; 
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
   
   if (empty($password )) {array_push($errors, "Password is required");}
   if (empty($confirm)) {array_push($errors, " confirm Password is required");}






   if ($password!=$confirm){
   array_push($errors, "password not match");
   
   }
   //wwwwwww
 /* 

$maxpass_length =32;
$minpass_length =8;
$pass_length = Strlen(trim($password));

if ($pass_length < $minpass_length){

    array_push($errors, "The password must be at least 8 in length");

}
elseif ($pass_length > $maxpass_length ){

    array_push($errors, "The password must not be more than 32 in length");

}
else {

}

$patternpass = "/^[a-zA-Z0-9_]+$/";
    if (!preg_match($patternpass,$password)){

        array_push($errors, "The password must contain letters from A to Z, and it can be uppercase letters and numbers");
       
    }*/ ---------------

   $select = "select * from users where email='$email'";
   $query12 =mysqli_query($conn,$select); 
   $roww1 =mysqli_num_rows($query12);
   echo $roww1;

   if (count($errors)==0) {
   
  //  $password1 = md5($password);    
    
   $update = "update users set password='$password' where email='$email'";
  if  (mysqli_query($conn,$update)) {
   
  echo " update";
  }
  else{

    echo " not update";
  }
   
   }
   }
   
   // nasserrr




?>


<div class="header">
<h2>update password</h2>
</div>

<form  class="content" action="" method="post" enctype="multipart/form-data"  onsubmit="submitButton.disabled = true;">
<?php include('errors.php'); ?>



<div class="input">
<label for="password">Enter password</label>
<input type="password" name="password" id="password " value="<?php echo $password ?>"  >
</div>

<div class="input">
<label for="confirm">confirm password</label>
<input type="password" name="confirm" id="confirm" >
</div>

<div style="text-align: right;">
<button  type="submit" name="updatepass" class="btn">update</button>
</div>


 </form>  


</body>
</html>