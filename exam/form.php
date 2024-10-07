















<?php

$maseage1 =""; $maseage2 =""; $maseage =""; $maseage =""; $maseage =""; $maseage ="";
if (isset($_POST('sumbet'))){


$email = $_POST['email'];




if (empty($email)){
    $maseage1 =" email empty";

}

if ($pass1 != $pass2){

    $maseage2 ="pass1 != pass2";

}

$select = "select * from users where email='$email'";
$query =mysqli_query($conn,$select);

if (mysqli_num_rows($query) >0){

    $maseage3 =" email is taken";

}


if ($maseage1 =="" && $maseage2 =="" && $maseage3 =="" )


$insert ="insert into uesrs() values ('$email',,,,,)";
$query2 =mysqli_query($conn,$insert);


if ($query2){

echo "insert";

    
}else{

    echo "not insert";

}


$select2 = "select * from table "
$query3 =mysqli_query($conn,$select2);


while ($assoc =mysqli_fetch_assoc($query3)){


echo $assoc['email'];
echo $assoc[3];


echo '<button><a href="del.php?id='.$assoc[0].'"></a></button>';



}

$id = $_GET['id'];

$delete ="delect from table where id='$id'";
$querydel =mysqli_query($conn,$delete);

if ($querydel){


    
}

$selectlog ="select * from table where username='$user' and password='$pass'";
$querylog =mysqli_query($selectlog);

if (mysqli_num_rows($querylog) >0 ){


    session_start();
    $_SESSION['user'] =$user;
    header("location:home.php");


}

session_start();

if (!isset($_SESSION['user'])){
    header("location:login.php");


}

echo $_SESSION['user'];

session_unset();

session_destroy();
header("location:login.php");



}



?>