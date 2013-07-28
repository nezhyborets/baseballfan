<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Документ без названия</title>
</head>
<?php
requre_once 'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("Невозможно подключться к MySQL:".mysql_error());

mysql_select_db($db_database,$db_server)
     or die ("Невозможно выбрать базу данных: ".mysql_error());
	 
if (isset($_POST['author']) &&
    isset($_POST['title']) &&
	isset($_POST['category']) &&
	isset($_POST['year']) &&
	isset($_POST['isbn']))
{
	$author = get_post('author');
	$title = get_post('title');
	$category = get_post('category');
	$year = get_post('year');
	$isbn = get_post('isbn');
<body>
</body>
</html>