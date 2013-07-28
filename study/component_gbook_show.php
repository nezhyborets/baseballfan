<?php ## Компонентный подход. Компонент показа гостевой книги.
define("GBook", "gbook.dat"); // имя файла с данными гостевой книги
require_once "model.php";     // подключаем Модель (ядро)
$Data = LoadBook(GBook);

?>