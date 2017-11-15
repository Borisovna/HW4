<?php
require_once 'class/class_db.php';
$db= new my_db();
$db->connect();
//if(!empty($_SESSION['login'] && $_SESSION['pass'])){
//    session_start ();
//    print_r ($_SESSION);
//}
$table='table_reg';
$field='login';
$value=$_POST[$field];
print_r ($_POST);
$db->update ($table,'login','Татьяна',8);
var_dump  ($db->ynik_user($table,$field,$value));
echo '<br><pre>';
if(($db->ynik_user($table,$field,$value)) == 1 ){
    $db->insert ($table,$_POST);
}else{
    echo 'А вы у нас уже были!<br>';

};
$all=$db->select_db ("SELECT * FROM $table;");
print_r ($all);