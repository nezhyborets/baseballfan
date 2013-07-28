<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/login.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/db_connect.php');

$id = $_POST['news_id'];
$tbl_name = htmlspecialchars ($_POST['admin_edit_new_name'],ENT_QUOTES);
$tbl_shorttext = htmlspecialchars ($_POST['admin_edit_new_shorttext'],ENT_QUOTES);
$tbl_text = $_POST['admin_edit_new_text'];


$query = "UPDATE tbl_news SET name='$tbl_name', short_text='$tbl_shorttext', text='$tbl_text' WHERE id='$id'";
$query_result = mysql_query ($query) or die(mysql_error());