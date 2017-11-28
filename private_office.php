<?php
session_start();
require_once('header.php');
require_once 'class/class_db.php';
$db = new my_db();
$db->connect();
$table_reg = 'table_reg';
$table_info = 'table_info_user';
$table_photo = 'table_phpto';
$id_info_user = 'id_user_reg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // получаем id пользвателя
    $id = $db->select_db("SELECT id_user FROM {$table_reg} WHERE login ='{$_POST ['login']}';");
    // проверяем есть ли записи пользвателя в табл table_info_user, если есть обновляем данные, нет- добавляем.
    if (($db->ynik_user($table_info, $id_info_user, $id[0][0])) == false) {
//        echo $id[0][0].' по данному юзеру запись имеется  ';
        $param_update = [
            'name'        => $db->clean($_POST['name']),
            'age'         => $db->clean($_POST['age']),
            'description' => $db->clean($_POST['description'])
        ];
//        print_r ($param_update);
        $db->update($table_info, $param_update, $id_info_user, $id[0][0]);
    } else {
        echo $id[0][0] . ' информация о данном юзере НЕ записывалась';
        $param_insetr = [
            'id_user_reg' => $id[0][0],
            'name'        => $db->clean($_POST['name']),
            'age'         => $db->clean($_POST['age']),
            'description' => $db->clean($_POST['description'])
        
        ];
        print_r($param_insetr);
        $db->insert($table_info, $param_insetr);
        
    }
    $uploaddir = 'photo';
    //новое имя изображения
    $apend = $_FILES['photo']['name'];
//    echo "<br>$apend загруж файла:. $apend <br>";
    $filename = strstr($apend, ".", true);//имя файла до расширения
//    echo "$filename  <br>";
    $ras = substr(strrchr($apend, "."), 1);//расширение
    $file = date('YmdHis') . rand(100, 1000) . ".$ras";
    $dir = $uploaddir . '\\' . $file;
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $dir)) {
        echo "Файл корректен и был успешно загружен.";
        $param_insetr_photo = [
            'id_user'    => $id[0][0],
            'path_photo' => ("$uploaddir/$file"),
        ];
        $db->insert($table_photo, $param_insetr_photo);
        
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
    
}
echo '<div class="form-container" style="margin-top: 100px">';
if (isset($_SESSION['id_user'])){
    echo '
    <form class="form-horizontal" action method="post" enctype="multipart/form-data" target="_blank">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
            <div class="col-sm-10 col-lg-6">
                <input type="text" class="form-control" id="inputEmail3" name="login" placeholder="Логин">
            </div>
        </div>
    <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
            <div class="col-sm-10 col-lg-6">
                <input type="password" class="form-control" id="inputPassword3" name="pass" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Имя</label>
            <div class="col-sm-10 col-lg-6">
                <input type="text" class="form-control" id="name" name="name" placeholder="Имя">
            </div>
        </div>
        <div class="form-group">
            <label for="usr_age" class="col-sm-2 control-label">Дата Рождения</label>
            <div class="col-sm-10 col-lg-6">
                <input type="date" class="form-control" id="usr_age" name="age" placeholder="мм.дд.гггг">
            </div>
        </div>
        <div class="form-group">
            <label for="usr_info" class="col-sm-2 control-label">Описание:</label>
            <div class="col-sm-10 col-lg-6">
                <textarea class="form-control" id="usr_info" name="description"
                          placeholder="Немного о себе:"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="usr_foto" class="col-sm-2 control-label">Фото</label>
            <div class="col-sm-10 col-lg-6">
                <input type="file" class="form-control" id="usr_foto" name="photo" placeholder="Фото">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-lg-6 col-sm-10">
                <button type="submit" class="btn btn-default">Сохранить</button>
                <br><br>
                <!--                Зарегистрированы? <a href="index.html">Авторизируйтесь</a>-->
            </div>
        </div>
    </form>
</div>';
}else{
    echo '<h1>Запретная зона, доступ только авторизированному пользователю</h1>';
}
?>
</div>
<!-- /.container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

