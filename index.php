<?php
session_start();
require_once 'class/class_db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new my_db();
    $login = $db->clean($_POST['login']);
    $pass = crypt($db->clean($_POST['pass']), '2202');
    //проверяем был ли ранее пользователь зарегистрирован
    if (($db->ynik_user('table_reg', 'login', $login)) == true) {
        header('Location:reg.php');
        //если нет, перенаправим на регистрацию
    } else {
        //если был зарегистрировал проверяем ввод пароля
        $queri_pass = $db->select_db("SELECT pass FROM table_reg WHERE login='" . $login . "';");
        $pass_basa = $queri_pass[0][0];
        if ($pass != $pass_basa) {
            echo 'пароль введен не верно!';
            exit();
        } else {
            //если пароль введен верно , записываем id в сессию
            $id_user = $db->select_db("SELECT id_user FROM table_reg WHERE login='" . $login . "';");
            print_r($id_user);
            $_SESSION['id_user'] = $id_user[0][0];
            echo 'Вы у нас уже были!!!!';
        }
    }
}
require('header.php');


?>

<div class="container">

    <div class="form-container" style="margin-top: 100px;">
        <form class="form-horizontal" action method="post">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Логин" name="login">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10 col-lg-6">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Пароль" name="pass">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="go">Войти</button>
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