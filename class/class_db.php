<?php

class my_db
{
    private $databaseName = 'HW4';
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    
    //подключение к базе
    
    public function select_db ($query)
    {
        if (!$this->connect ())
            $this->connect ();//проверяем если нет соеденения создаем
        $mysqli = new mysqli($this->host, $this->user, $this->password, $this->databaseName);
        $result = $mysqli->query ($query);
//      var_dump ($result);
        return $result->fetch_all ();
        /* очищаем результирующий набор */
        $result->close ();
    }
    
    //выборка с базы согл.запросу
    
    public function connect ()
    {
        $mysqli = mysqli_init ();
        if (!$mysqli) {
            die('mysqli_init завершилась провалом');
        };
        if (!$mysqli->real_connect ($this->host, $this->user, $this->password, $this->databaseName)) {
            die('Ошибка подключения (' . mysqli_connect_errno () . ') '
                . mysqli_connect_error ());
        }
//        echo 'Выполнено... ' . $mysqli->host_info . "\n";
    }
    
    //добавление в базу значений, заполнение
    public function insert ($table, $param)
    {
        $mysqli = new mysqli($this->host, $this->user, $this->password, $this->databaseName);
        for ($i = 0; $i < count ($param); $i++) {
            $param_values[$i] = "'" . array_values ($param)[$i] . "'";
            echo '<br>'.$param_values[$i].'<br>';
        }
        $fields = implode (', ', array_keys ($param));//массив ключей массива
        $values = implode (', ', $param_values);//массив значений массива
        print_r ($fields);
        print_r ($values);
        $mysqli->query ("INSERT INTO {$table} ({$fields}) VALUES({$values});");
        mysqli_close ($mysqli);
    }
    
    // очистка вврдимых данных
    public function clean ($value = "")
    {
        $quotes = array ("\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">", "?", "!","\x2f","\x5c" );// кодировки не желат символов http://defindit.com/ascii.html
        $goodquotes = array ("-", "+", "#" );
        $repquotes = array ("\-", "\+", "\#" );
//        $value = htmlspecialchars ($value);//Преобразует специальные символы в HTML-сущности
        $value = trim( strip_tags( $value ) );//Удаляет пробелы (или другие символы) из начала и конца строки (Удаляет HTML и PHP-теги из строкиУдаляет пробелы (или другие символы) из начала и конца строки
        $value = str_replace (" ", "", $value);//Заменяет все вхождения строки поиска на строку замены
        $value = stripslashes ($value);// Удаляет экранирование символов
        $value = str_replace( $quotes, '', $value );
        $value = str_replace( $goodquotes, $repquotes, $value );
        
        
        return $value;
    }
    
    //метод обновления данных
    public function update ($table, $param,$field_where, $where = null)
    {
        $mysqli = new mysqli($this->host, $this->user, $this->password, $this->databaseName);
        for ($i = 0; $i < count ($param); $i++) {
            $values[$i] = "'" . $this->clean ((array_values ($param))[$i]) . "'";//массив значений массива
        }
        $fields =  array_keys ($param);//массив ключей массива
        print_r ($fields);
        print_r ($values);
        for ($i=0;$i<count ($fields);$i++){
            echo $i.' зашел в цикл !';
            $mysqli->query ("UPDATE {$table} SET {$fields[$i]}={$values[$i]} WHERE $field_where =('{$where}');");
        }
        
        mysqli_close ($mysqli);
        
    }
    
    //подсчет кол-во значений $value по полю $field в таблице $table
    public function ynik_user ($table, $field, $value)
    {
        $mysqli = new mysqli($this->host, $this->user, $this->password, $this->databaseName);
        $rez = $mysqli->query ("SELECT count(*) FROM {$table} WHERE {$field}=('{$value}');");
        $item = $rez->fetch_assoc ();
//        print_r ($rez->fetch_assoc ());
        if ($item['count(*)'] == 0) {
            return true;
        } else {
            return false;
        };
        mysqli_close ($mysqli);
    }
}
    