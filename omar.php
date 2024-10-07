<html>
<head><title>Caluclator</title></head>
<body>
<div align="center">
<fieldset align="center" style="width:50%">
<legend> <h1>Caluclator</h1></legend>

<form action="" method="post">
<input type="text" name="num1" value=""><br><br>
<input type="text" name="num2" value=""><br><br>

Operation:
<select name="op">
<option value="+">+</option>
<option value="-">-</option>
</select> <br><br>

<input type="submit" name="submit" value="Calculate"><br><br>
</form>
<?php

if (isset($_POST['submit'])){

    if ($_POST['op']==['+']) {
        echo $_POST ['num1'] + $_POST ['num2'];
    
    }

    

    elseif ($_POST['op']==['-']){
        echo $_POST ['num1'] - $_POST ['num2'];
    }




$filelocation ='img/';
$filename =basename($_FILES["myphoto"] ["name"]);
$filepath = $filelocation .$filename;



move_uploaded_file($_FILES["myphoto"] ["tmp_name"],$filepath )


}

?>
</fieldset>
</body>
</html>