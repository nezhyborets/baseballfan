<?php
$dbconnect = mysql_connect ("$db_hostname","$db_username","$db_password")
  or die ('Ошибка соединения с сервером'.mysql_error());

$db = mysql_select_db ("$db_database",$dbconnect)
  or die ('Невозможно выбрать базу данных'.mysql_error());
mysql_set_charset ("utf8");
?>