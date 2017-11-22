<?php
require_once ('header.php');
require_once 'class/class_db.php';
$db = new my_db();
$db->connect ();
$table_reg = 'table_reg';
$table_info = 'table_info_user';
$table_photo = 'table_phpto';
$id_info_user = 'id_user_reg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // получаем id пользвателя
    $id = $db->select_db ("SELECT id_user FROM {$table_reg} WHERE login ='{$_POST ['login']}';");
    // проверяем есть ли записи пользвателя в табл table_info_user, если есть обновляем данные, нет- добавляем.
    if (($db->ynik_user ($table_info, $id_info_user, $id[0][0])) == false) {
//        echo $id[0][0].' по данному юзеру запись имеется  ';
        $param_update = [
            'name'        => $db->clean ($_POST['name']),
            'age'         => $db->clean ($_POST['age']),
            'description' => $db->clean ($_POST['description'])
        ];
//        print_r ($param_update);
        $db->update ($table_info, $param_update, $id_info_user, $id[0][0]);
    } else {
//        echo 'Сначала пройдите регистрацию';
//        header("Location:/reg.php");
        echo $id[0][0] . ' информация о данном юзере НЕ записывалась';
        $param_insetr = [
            'id_user_reg' => $id[0][0],
            'name'        => $db->clean ($_POST['name']),
            'age'         => $db->clean ($_POST['age']),
            'description' => $db->clean ($_POST['description'])
        
        ];
        print_r ($param_insetr);
        $db->insert ($table_info, $param_insetr);
        
    }
    
    //    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    $uploaddir = 'photo';
    //новое имя изображения
    $apend = $_FILES['photo']['name'];
//    echo "<br>$apend загруж файла:. $apend <br>";
    $filename = strstr ($apend, ".", true);//имя файла до расширения
//    echo "$filename  <br>";
    $ras = substr (strrchr ($apend, "."), 1);//расширение
    $file = date ('YmdHis') . rand (100, 1000) . ".$ras";
    $dir = $uploaddir . '\\' . $file;
    if (move_uploaded_file ($_FILES['photo']['tmp_name'], $dir)) {
        echo "Файл корректен и был успешно загружен.";
        $param_insetr_photo = [
            'id_user'    => $id[0][0],
            'path_photo' => ("$uploaddir/$file"),
        ];
        $db->insert ($table_photo, $param_insetr_photo);
        
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }

//    echo 'Некоторая отладочная информация:';
}

?>

<div class="form-container" style="margin-top: 100px">
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
                <input type="password" class="form-control" id="inputPassword3"  name="pass" placeholder="Пароль">
            </div>
        </div>
<!--        <div class="form-group">-->
<!--            <label for="inputPassword4" class="col-sm-2 control-label">Пароль (Повтор)</label>-->
<!--            <div class="col-sm-10">-->
<!--                <input type="password" class="form-control" id="inputPassword4" name="pass_2" placeholder="Пароль">-->
<!--            </div>-->
<!--        </div>-->
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
                <textarea class="form-control" id="usr_info" name="description" placeholder="Немного о себе:"></textarea>
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
</div>
</div>
<!-- /.container -->

<!--<div class="container">-->
<!--    <div class="form-container">-->
<!--        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">-->
<!--            <div class="cbp-mc-column">-->
<!--                <div class="form-group">-->
<!--                    <label for="login">-->
<!--                        <!--                        --><?php ////echo $_SESSION['login'] ?>
<!--                    </label>-->
<!--                    <input type="text" id="login" name="login" placeholder="Doe">-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="pass">pass</label>-->
<!--                    <div class="col-sm-10">-->
<!--                        <input type="password" maxlength="25" id="pass" name="pass" placeholder="пароль">-->
<!--                    </div>-->
<!--                    <div class="form-group"><label for="name"> </label>-->
<!--                        <div class="col-sm-10">-->
<!--                            <input class="form-control" type="text" id="name" name="name" placeholder="Имя">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <div class="form-group"><label  for="age">age</label>-->
<!--                            </div>-->
<!--                            <div class="col-sm-10">-->
<!--                                <input class="form-control" type="text" id="age" name="age" placeholder="18">-->
<!--                            </div>-->
<!--                            <div class="form-group"><label class="control-label" for="bio">описание</label>-->
<!--                                <div class="col-sm-10"><textarea class="form-control" id="bio" name="description"></textarea></div>-->
<!--                                <div class="form-group "><label class="col-sm-2 control-label" for="file">Фото</label>-->
<!--                                    <input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="100000"/>-->
<!--                                    <div class="col-sm-10"><input id="file" type="file" name="photo" multiple></div>-->
<!---->
<!--                                    <div class="form-group">-->
<!--                                        <div class="cbp-mc-submit-wrap col-sm-10">-->
<!--                                            <input class="form-control cbp-mc-submit" type="submit" value="Сохранить изменения"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

