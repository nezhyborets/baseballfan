<?php
require_once ('../config/login.php');
require_once ('../config/functions.php');
require_once ('../config/db_connect.php');

if ($_POST['admin_edit_new_name'] and $_POST['admin_edit_new_text'])
{
	$new_name = htmlspecialchars ($_POST['admin_edit_new_name'], ENT_QUOTES);
	$new_text = $_POST['admin_edit_new_text'];

    if (empty($_POST['admin_edit_new_shorttext'])) {
		$new_shorttext = (substr($new_text,0,252).'...');
	} else {
		$new_shorttext = htmlspecialchars ($_POST['admin_edit_new_shorttext'], ENT_QUOTES);
	}

	$id = $_POST['news_id'];

	if ($_FILES['admin_new_img']['name'])
	{
		$picture = $_FILES['admin_new_img'];
	}

	$upload_dir = ($_SERVER['DOCUMENT_ROOT'].'/images/news_images/');

	if ($picture)
	{
		$query="SELECT image_link,thumbnail_link from tbl_news WHERE id=$id";
		$query_result = mysql_query($query);

		$array = mysql_fetch_array ($query_result);
		$old_img_link = $array['image_link'];
		$old_thumb_link = $array['thumbnail_link'];
		unlink ($_SERVER['DOCUMENT_ROOT'].'/images/news_images/'.$old_img_link);
		unlink ($_SERVER['DOCUMENT_ROOT'].'/images/temp_news_images/'.$old_thumb_link);

        $new_imagename = image_upload($picture['name'],$picture['tmp_name'],'news_images',$picture['name']);
		$thumbnail = thumbnail($new_imagename);

		$query = "UPDATE tbl_news
		          SET name='$new_name',
				      short_text='$new_shorttext',
					  text='$new_text',
					  image_link='$new_imagename',
					  thumbnail_link='$thumbnail'
				  WHERE id='$id'";
		$query_result = mysql_query ($query) or die(mysql_error());
	}
	else
	{
		$query = "UPDATE tbl_news SET name='$new_name', short_text='$new_shorttext', text='$new_text' WHERE id='$id'";
		$query_result = mysql_query ($query) or die(mysql_error());
	}
	echo <<<HERE
    <p id="admin_addedit_result">Новость успешно изменена!</p>
	<a href="index.php?admin_page=admin_add_new" class="admin_addedit_result_1more">Добавить новость</a>
	<a href="index.php?admin_page=admin_news" class="admin_addedit_result_1more">Вернуться к списку новостей</a>
HERE;
} else {
	$id=$_GET['id'];
	$query = "SELECT * from tbl_news WHERE id=$id";
    $query_result = mysql_query ($query);

    $novost = zapros_novosti($query_result);

	echo <<<HERE
	<form enctype="multipart/form-data" method="post">
   <table id="admin_newsadd_table" cellpadding="0" cellspacing="0">
     <tr>
       <td class="admin_newsadd_td header">
         <p class="admin_newsadd_input_name header">Редактирование новости</p>
       </td>
     </tr>
     <tr>
       <td class="admin_newsadd_td">
         <p class="admin_newsadd_input_name">Название статьи</p>
         <input type="text" value="$novost[tbl_name]" size="100" name="admin_edit_new_name" maxlength="255">
       </td>
     </tr>
     <tr>
       <td class="admin_newsadd_td">
         <p class="admin_newsadd_input_name">Краткий текст</p>
         <textarea cols="50" rows="6" name="admin_edit_new_shorttext" maxlenght="255">$novost[tbl_short_text]</textarea>
       </td>
     </tr>
     <tr>
       <td class="admin_newsadd_td">
         <p class="admin_newsadd_input_name">Основной текст</p>
         <textarea id="admin_edit_new_text" cols="100" rows="20" name="admin_edit_new_text" maxlenght="3000">$novost[tbl_text]</textarea>
         <script type="text/javascript">CKEDITOR.replace('admin_edit_new_text');</script>
       </td>
     </tr>
     <tr>
       <td class="admin_newsadd_td">
HERE;
if ($novost['tbl_thumbnail_link']) {
		   echo ('<img class="pg_news_image edit" src="/images/temp_news_images/'.$novost[tbl_thumbnail_link].'" />
         <p class="admin_newsadd_input_name">Изменение фотографии новости</p>
         <input type="file" name="admin_new_img">');
	   } else {
		   echo ('<p class="admin_newsadd_input_name">Прикрепление фотографии новости</p>
         <input type="file" name="admin_new_img">');}
echo <<<HERE
       </td>
     </tr>
     <tr>
       <td class="admin_newsadd_td">
         <button type="submit" id="admin_news_add_button">Изменить новость</button>
       </td>
     </tr>
   </table>
   <input type="hidden" name="news_id" value="$id" />
 </form>
HERE;

$nomer_novosti = $_GET['id'];
require_once ('admin_edit_comments.php');
}
?>