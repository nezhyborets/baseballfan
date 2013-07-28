<?php

require_once './config/login.php';
require_once './config/functions.php';
require_once './config/db_connect.php';


$query = "SELECT * FROM tbl_news ORDER BY id DESC";
$query_result = mysql_query ($query)
  or die ("Невозможно сделать запрос". mysql_error());
  
$rows = mysql_num_rows($query_result);

$novost1 = zapros_novosti($query_result);
$novost2 = zapros_novosti($query_result);
$novost3 = zapros_novosti($query_result);
$novost4 = zapros_novosti($query_result);
$novost5 = zapros_novosti($query_result);

require_once ('./blocks/templates/tpl_mainnews.php');
?>