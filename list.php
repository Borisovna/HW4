<?php
require_once 'class/class_db.php';
$db = new my_db();
if(isset($_POST)){
    $mas=array_keys($_POST);
    $id=$mas[0];
    $db->del_all($id);
//    echo 'Удалились';
//    echo '<pre>';
//    print_r ($mas[0]);
//    echo '</pre>';
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
                <li><a href="reg.php">Регистрация</a></li>
                <li class="active"><a href="list.html">Список пользователей</a></li>
                <li><a href="filelist.html">Список файлов</a></li>
                <li><a href="private_office.php">Личный кабинет</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
    <h2>Информация выводится из базы данных</h2>
    <table class="table table-bordered">
        <tr>
            <th>Пользователь(логин)</th>
            <th>Имя</th>
            <th>возраст</th>
            <th>описание</th>
            <th>Кол-во фотографий</th>
            <th>Действия</th>
        </tr>
        
            <?php
            $query_all_id = 'SELECT id_user FROM table_reg;';
            $sel_id = $db->select_db ($query_all_id);
            for ($i = 0; $i < count ($sel_id); $i++) {
                $sel_id[$i] = $sel_id[$i][0];
            }
//            echo '<pre>';
//            print_r ($sel_id);
            for ($j = 0; $j < count ($sel_id); $j++) {
                echo '<tr>';
                $query_user = 'SELECT r.id_user,r.login,i.name,i.age,i.description,count(p.path_photo) FROM table_reg as r
        LEFT JOIN table_info_user as i on r.id_user=i.id_user_reg
        LEFT JOIN table_phpto as p  on r.id_user=p.id_user
        WHERE r.id_user=' . $sel_id[$j] . ';';
                $sel_user = $db->select_db ($query_user);
//                echo '<pre>';
//                print_r ($sel_user);
                echo '<td>' . $sel_user[0][1] . '</td>';
                echo '<td>' . $sel_user[0][2] . '</td>';
                echo '<td>' . $sel_user[0][3] . '</td>';
                echo '<td>' . $sel_user[0][4] . '</td>';
                echo '<td>' . $sel_user[0][5] . '</td>';
                echo "<td>
                        <form action='' method='post'>
                            <button type='submit' class='btn btn-default' name='" . $sel_user[0][0] . "'>Удалить пользователя</button>
                        </form>
                   </td>";
                echo '</tr>';
            }
            ?>
        
    </table>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
