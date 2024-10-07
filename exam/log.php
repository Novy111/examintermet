<html>

<head>

<style>
div.error{
background-color: red;
color: white;

}

</style>

</head>
<body style="text-align: center;">


<html>

<head>

</head>

<?php
$mesage1 = ""; $mesage2 = ""; 
if (isset($_POST['log'])){

include 'conn.php';
$name =$_POST['name'];
$pass =$_POST['pass'];


if (empty($name)){
    $mesage1 = "name is empty <br>";
}


if (empty($pass)){
    $mesage2 = "pass is empty <br>";
}


if ($mesage1 == "" && $mesage2 == "" ){


$select ="select * from test where name='$name' and pass='$pass'";
 $query = mysqli_query($conn,$select);

if (mysqli_num_rows($query)==1) {

session_start();
$_SESSION['name'] =$name;
header("location:Homepage.php");
exit;

}else {

  echo " error in pass or name ";

}


}


}


?>

<body style="text-align: center;">


<form action="" method="post" enctype="multipart/form-data">

<div class="error">
<?php echo $mesage1; ?>
<?php echo $mesage2; ?>

</div>

name:
<input type="text" name="name" >
<br><br>


pass:
<input type="password" name="pass" >
<br><br>


<input type="submit" name="log" >


</form>


</body>
</html>






</body>
</html>