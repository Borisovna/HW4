<?php
require_once 'class/class_db.php';
$db = new my_db();
if(!empty($_POST)) {
    $mas = array_keys ($_POST);
    print_r ($_POST);
    $id = $mas[0];
    echo $id;
    $db->del_img ($id);//удаление пользователей  фото
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
                    <li><a href="list.php">Список пользователей</a></li>
                    <li class="active"><a href="filelist.php">Список файлов</a></li>
                    <li><a href="private_office.php">Личный кабинет</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <h1>Запретная зона, доступ только авторизированному пользователю</h1>
        <h2>Информация выводится из списка файлов</h2>
        <table class="table table-bordered">
            <tr>
                <th>Название файла</th>
                <th>Фотография</th>
                <th>Действия</th>
            </tr>
<?php
$all_path = $db->select_db ('SELECT id_photo,path_photo FROM table_phpto;');
//echo '<pre>';
//print_r ($all_path);
//echo $all_path[3][0];
for ($i=0; $i < count ($all_path); $i++) {
    $name_img = substr ((strrchr ($all_path[$i][1], "/")), 1);
    echo "<tr>
              <td>$name_img</td>
              <td><img style=' max-height: 100px; border-radius: 50%' src='".$all_path[$i][1]."'></td>
              <td>
                   <form action='' method='post'>
                       <button type='submit' class='btn btn-default' name='" . $all_path[$i][0] . "'> Удалить фоточку </button>
               </form>
              </td>
        </tr>";
          }
 ?>
      
      </table>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src = "js/main.js" ></script >
    <script src = "js/bootstrap.min.js" ></script >

  </body >
</html >
