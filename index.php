<?php
//session_start ();
require_once ('header.php');
require_once 'class/class_db.php';
//setcookie('login', $_COOKIE['login'], time()-3600);
if (!empty($_POST)) {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['pass'] = $_POST['pass'];
    $db = new my_db();
    $db->connect ();
    $param_insert=[
       'login'=>$db->clean ($_POST['login']),
        'pass'=>crypt ($db->clean ($_POST['pass']), '22/02/10'),
    ];
    setcookie ('login','',time ()-3600,'/');
//    setcookie ('login', $param_insert['login'], time () + 60 * 60 * 24 * 30, '/');
//    setcookie ('pass', $param_insert['pass'], time () + 60 * 60 * 24 * 30, '/');
    $table = 'table_reg';
    $field = 'login';
    $value = $_POST[$field];
    if (($db->ynik_user ($table, $field, $value)) == true) {
        $db->insert ($table, $param_insert);
        
    } else {
        echo 'Вы у нас уже были!!!!';
    }
}



?>

<div class="container">

    <div class="form-container" style="margin-top: 100px;">
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
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Войти</button>
                    <br><br>
                    Нет аккаунта? <a href="reg.php">Зарегистрируйтесь</a>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>