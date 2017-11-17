<?php
//session_start ();
require_once 'class/class_db.php';

$db = new my_db();
$db->connect ();
$table_reg='table_reg';
$table_info='table_info_user';
$table_photo='table_phpto';
$id_info_user='id_user_reg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // получаем id пользвателя
    $id=$db->select_db ("SELECT id_user FROM {$table_reg} WHERE login ='{$_POST ['login']}';");
     // проверяем есть ли записи пользвателя в табл table_info_user, если есть обновляем данные, нет- добавляем.
    if (($db->ynik_user ($table_info,$id_info_user,$id[0][0]))==false){
//        echo $id[0][0].' по данному юзеру запись имеется  ';
        $param_update=[
            'name'=>$db->clean ($_POST['name']),
            'age'=>$db->clean ($_POST['age']),
            'description'=>$db->clean ($_POST['description'])
        ];
//        print_r ($param_update);
        $db->update ($table_info,$param_update,$id_info_user,$id[0][0]);
    }else{
//        echo 'Сначала пройдите регистрацию';
//        header("Location:/reg.php");
        echo $id[0][0].' информация о данном юзере НЕ записывалась';
        $param_insetr=[
        'id_user_reg'=>$id[0][0],
        'name'=>$db->clean ($_POST['name']),
        'age'=>$db->clean ($_POST['age']),
        'description'=>$db->clean ($_POST['description'])

    ];
        print_r ($param_insetr);
    $db->insert ($table_info,$param_insetr);
    
    }
    
   //    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    $uploaddir = 'photo';
    //новое имя изображения
    $apend = $_FILES['photo']['name'];
//    echo "<br>$apend загруж файла:. $apend <br>";
    $filename = strstr($apend, ".", true);//имя файла до расширения
//    echo "$filename  <br>";
    $ras= substr(strrchr($apend, "."), 1);//расширение
    $file=date('YmdHis').rand(100,1000).".$ras";
    $dir=$uploaddir.'\\'.$file;
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $dir)) {
        echo "Файл корректен и был успешно загружен.";
        $param_insetr_photo=[
         'id_user'=>$id[0][0],
         'path_photo'=>("$uploaddir/$file"),
        ];
        $db->insert ($table_photo,$param_insetr_photo);
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
    
//    echo 'Некоторая отладочная информация:';
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
<!--<a href="photo/%2020171115000833584.jpg"></a>-->

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
                <li><a href="reg.php">Регистрация</a></li>
                <li><a href="list.php">Список пользователей</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
                <li class="active"><a href="private_office.php">Личный кабинет</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="form-container">
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            <div class="cbp-mc-column">
                <div class="form-group">
                    <label for="login">
<!--                        --><?php //echo $_SESSION['login'] ?>
                    </label>
                    <input type="text" id="login" name="login" placeholder="Doe">
                </div>
                <div class="form-group">
                    <label for="pass">pass</label>
                    <input type="password" maxlength="25" id="pass" name="pass" placeholder="пароль"></div>
                <div class="form-group"><label for="name"> </label>
                    <input type="text" id="name" name="name" placeholder="Имя"><?php
//                    echo $r=$db->select_db ("SELECT 'name' FROM {$table_info} WHERE login ='{$_SESSION ['login']}';");
//echo $r[0][0];
                    ?></div>
                <div class="form-group"><label for="age">age</label>
                    <input type="text" id="age" name="age" placeholder="18"></div>
                <div class="form-group"><label for="bio">description</label>
                    <textarea id="bio" name="description"></textarea></div>
                <div class="form-group "><label for="file">Фото</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
                    <input id="file" type="file" name="photo" multiple ></div>

                <div class="form-group">
                    <div class="cbp-mc-submit-wrap">
                        <input class="cbp-mc-submit" type="submit" value="Сохранить изменения"/></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

