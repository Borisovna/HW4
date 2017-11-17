<?php
//session_start ();
require_once 'class/class_db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new my_db();
    $db->connect ();
    $login = $db->clean ($_POST['login']);
    $hash_pass = crypt ($db->clean ($_POST['pass']), '22/02/10');
//    setcookie ('login', $login, time () + 60 * 60 * 24 * 30, '/');
//    setcookie ('pass', $hash_pass, time () + 60 * 60 * 24 * 30, '/');
//    $_SESSION['login'] = $login;
//    $_SESSION['pass'] = $hash_pass;
    if ($_POST['pass'] == $_POST['pass2']) {
        $table = 'table_reg';
        $field = 'login';
        $value = $_POST[$field];
        if (($db->ynik_user ($table, $field, $value)) == true) {
            print_r ($_POST);
            foreach ($_POST as $key => $val) {
                switch ($key) {
                    case 'login':
                        $params[$key] = $db->clean ($val);
                        break;
                    case 'pass':
                        $params[$key] = crypt ($db->clean ($val), '22/02/10');
                        break;
                    case 'pass2':
                        break;
                }
            }
            $db->insert ($table, $params);
        } else {
            echo 'Вы у нас уже были!!!!';
        }
    } else {
        echo 'Пароли не соотвествуют друг другу!';
    };

//    header ('Location: list.php');
}

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
    <link href="css/starter-template.css" rel="stylesheet">


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
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Авторизация</a></li>
                <li class="active"><a href="reg.php">Регистрация</a></li>
                <li><a href="list.php">Список пользователей</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
                <li><a href="private_office.php">Личный кабинет</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="form-container">
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Логин" name="login">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Пароль" name="pass">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">Пароль (Повтор)</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Пароль" name="pass2">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Зарегистрироваться</button>
                    <br><br>
                    Зарегистрированы? <a href="index.php">Авторизируйтесь</a>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->

//<?php
//echo '<pre>';
//print_r ($_SESSION);
//?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
