<?php
require('src/inc/pdo.php');
require('src/inc/functions.php');

session_start();

if (!empty($_POST['logout'])) logout();

print_r($_SESSION);
?>
<form action="" method="post"><input type="submit" name="logout" value="Se déconnecter"></form>