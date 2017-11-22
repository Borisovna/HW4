<?php
setcookie('login', $_COOKIE['login'], time()-3600,'/');
header('Location: reg.php');