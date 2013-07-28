<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/login.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/db_connect.php');

if ($_POST['admin_add_new_name'] and $_POST['admin_add_new_shorttext'] and $_POST['admin_add_new_text']) {
	$new_name = htmlspecialchars ($_POST['admin_add_new_name'], ENT_QUOTES);
	$new_shorttext = htmlspecialchars ($_POST['admin_add_new_shorttext'], ENT_QUOTES);
	$new_text = htmlspecialchars ($_POST['admin_add_new_text'], ENT_QUOTES);
} else {
	echo 'Заданы не все параметры';
}

$new_imagename = "DEFAULT";
$thumbnail = "DEFAULT";

if ($_FILES['admin_add_new_img']['name']) {
$picture['admin_add_new_img'] = $_FILES['admin_add_new_img'];
}

$upload_dir = ($_SERVER['DOCUMENT_ROOT'].'/images/news_images/');

if ($picture) {
	$new_imagename = image_upload($picture,$upload_dir,$picture['name']);
	$thumbnail = thumbnail($new_imagename);
}

$query = "INSERT INTO tbl_news (date,name,short_text,text,image_link,thumbnail_link)
          VALUES (CURDATE(),'$new_name','$new_shorttext','$new_text','$new_imagename','$thumbnail')";
$query_result = mysql_query ($query) or die (mysql_error());
?>