<?php

session_start();

session_unset();

session_destroy();
header("location:log.php");
exit;


?>

onclick="javascript:return confirm (\'are you sure to delete this \');"
