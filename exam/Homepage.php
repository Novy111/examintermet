<html>

<head>

</head>

<?php

session_start();
if (!isset($_SESSION['name'])){

header("location:log.php");
exit;

}else {

 echo " welcome ".$_SESSION['name'];
 echo ' <button><a href="logout.php">logout</a></button>';

}


?>

<body style="text-align: center;">

<?php

include 'conn.php';

$select ="select * from test";
$query = mysqli_query($conn,$select);

echo '<table height= 30%  width=70% border="2px black">';
echo '<tr> <th>name</th> <th>email</th> <th>pass</th> <th>img</th> <th>delete</th> </tr>';

while ($row =mysqli_fetch_row($query)) {

echo '<tr> <td>'.$row[1].'</td> <td>'.$row[2].'</td> <td>'.$row[3].'</td> <td><img height="40px" width="75px"  src="'.$row[4].'" ></td> ';

echo '<td><button><a onclick="javascript:return confirm (\'are you sure to delete this \');" href="del.php?id='.$row[0].'">delete</a></button></td> </tr>';

}echo '</table>';


?>







</body>
</html>