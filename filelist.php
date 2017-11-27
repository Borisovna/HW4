<?php
session_start();
require_once ('header.php');
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

    <div class="container" style="margin-top: 100px;">
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
