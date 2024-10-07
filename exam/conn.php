<?php

$conn = mysqli_connect("localhost","root","","exam");

if ($conn==false){

 echo " not connect";

}else {

  echo " connect";
}



?>