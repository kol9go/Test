<?

if (!isset($_SESSION)) 
{
	session_start(); 
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<div class="container">
   	
<?php
    echo '<h1>Добро пожаловать - '.$_SESSION["login"].'</h1>';
?>
<form>
    <hr>
<a href="autorization.html">Выйти</a>
  </form>
  </div>
</body>
</html>