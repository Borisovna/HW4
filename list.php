<?php
require_once ('header.php');
require_once 'class/class_db.php';
$db = new my_db();
if(!empty($_POST)) {
    $mas = array_keys ($_POST);
    $id = $mas[0];
    echo $id;
    $db->del_all ($id);//удаление пользователей и всех его фото
}
?>


<div class="container" style="margin-top: 100px">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
    <h2>Информация выводится из базы данных</h2>
    <table class="table table-bordered">
        <tr>
            <th>Пользователь(логин)</th>
            <th>Имя</th>
            <th>возраст</th>
            <th>описание</th>
            <th>фото</th>
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
                $query_user = 'SELECT r.id_user,r.login,i.name,i.age,i.description,count(p.path_photo),p.path_photo FROM table_reg as r
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
                echo '<td><img style="max-width: 100px; max-height: 100px" src=" ' . $sel_user[0][6] . '" alt=""> <br> Всего у юзера фоток :' .$sel_user[0][5] . 'шт.</td>';
                echo "<td>
                        <form action method='post'>
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
