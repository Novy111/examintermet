<?php

include 'conn.php';

$id = $_GET['id'];

$delete = "delete from test where id='$id'";
if (mysqli_query($conn,$delete)){

 echo " delete ";
 header("location:Homepage.php");

}else{

 echo " not delete";

}


?>