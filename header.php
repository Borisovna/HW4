<?php
require_once 'class/class_db.php';
//$db = new my_db();
//$db->connect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Home work №4</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                
                print_r($_SESSION);
                if (empty($_SESSION['id_user'])) {
                    
                    echo '
                        <li><a href="index.php">Авторизация</a></li>
                        <li><a href="reg.php">Регистрация</a></li>
                    ';
                } else {
                    echo '
                        <li><a href="private_office.php">О себе</a></li>
                        <li><a href="list.php">Список пользователей</a></li>
                        <li><a href="filelist.php">Список файлов</a></li>
                    ';
                    $db = new my_db();
                    $db->connect();
                    $queri_foto=$db->select_db("SELECT path_photo FROM table_phpto WHERE id_user='".$_SESSION['id_user']."' LIMIT 1;");

                    if($queri_foto != null){
                        $path_foto=$queri_foto[0][0];
                    }else{
                        $path_foto='photo/1.png';
                    }
                }
                

//                $queri_name=$db->select_db("SELECT name FROM table_info_user WHERE id_user_reg='".$_SESSION['id_user']."';");
////                print_r($queri_name);
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                 <li>
                    <img src="
                <?php if(isset($path_foto)){echo $path_foto;} ?>
"   width="49" height="49" style="border-radius: 50%; ">
                </li>
                <li>
                    <form action="1.php" method='post'>
                        <button type='submit' class='btn btn-default' name="destroy">Выйти</button>
                    </form>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>