<?php
require_once 'class/class_db.php';
session_start();
$db = new my_db();
$db->connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params['login'] = $db->clean($_POST['login']);
    $params['pass'] = crypt($db->clean($_POST['pass']), '2202');
    $passwordconf = crypt($db->clean($_POST['pass2']), '2202');
    if ($params['pass'] != $passwordconf){
        echo "Пароли не совпадают";
        exit();
    }
    //регистрировался такой пользователь ранее
    if(($db->ynik_user('table_reg', 'login', $params['login'])) == true){
        //если нет записать его в таблицу регистрации
        $db->insert('table_reg', $params);
        //получаем его id и записываем его в сессию
        $id_user=$db->select_db("SELECT id_user FROM table_reg WHERE login='".$params['login']."';");
        $_SESSION['id_user']=$id_user[0][0];
        header('Location: private_office.php');
    }else{
        $id_user=$db->select_db("SELECT id_user FROM table_reg WHERE login='".$params['login']."';");
        $_SESSION['id_user']=$id_user[0][0];
        //перенаправить на просмотр таблицы
        header('Location: private_office.php');
     }
}
require_once('header.php');
?>

<div class="container">
    <div class="form-container" style="margin-top: 100px">
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  placeholder="Логин" name="login">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control"  placeholder="Пароль" name="pass">
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
