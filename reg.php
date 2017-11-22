<?php
require_once 'class/class_db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    session_start ();
    $db = new my_db();
    $db->connect ();
    $login = $db->clean ($_POST['login']);
    $hash_pass = crypt ($db->clean ($_POST['pass']), '22/02/10');
    setcookie ('login',$login,time ()+60*60);
    setcookie ('pass',$hash_pass,time ()+60*60);
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
            header('Location: list.php');
            echo 'Вы у нас уже были!!!!';
        }
    } else {
        echo 'Пароли не соотвествуют друг другу!';
        
    };
}
require_once ('header.php');
?>

<div class="container">
    <div class="form-container" style="margin-top: 100px">
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
