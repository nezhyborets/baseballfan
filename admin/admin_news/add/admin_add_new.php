<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/login.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/functions.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/db_connect.php');

if ($_POST['admin_add_new_name'] and $_POST['admin_add_new_text']) {
    $new_name = htmlspecialchars ($_POST['admin_add_new_name'], ENT_QUOTES);
    $new_text = $_POST['admin_add_new_text'];

    if (empty($_POST['admin_add_new_shorttext'])) {
        $new_shorttext = (substr($new_text,0,252).'...');
    } else {
        $new_shorttext = htmlspecialchars ($_POST['admin_add_new_shorttext'], ENT_QUOTES);
    }

    $new_imagename = NULL;
    $thumbnail = NULL;

    if ($_FILES['admin_new_img']['name']) {
        $picture = $_FILES['admin_new_img'];
    }

    $upload_dir = ($_SERVER['DOCUMENT_ROOT'].'/images/news_images/');

    if ($picture) {
        $new_imagename = image_upload($picture['name'], $picture['tmp_name'],'news_images',$picture['name']);
        $thumbnail = thumbnail($new_imagename);
    }

    $query = "INSERT INTO tbl_news (date,name,short_text,text,image_link,thumbnail_link)
			  VALUES (CURDATE(),'$new_name','$new_shorttext','$new_text','$new_imagename','$thumbnail')";
    $query_result = mysql_query ($query) or die (mysql_error());
    echo <<<HERE
    <p id="admin_addedit_result">Новость успешно добавлена!</p>
	<a href="index.php?admin_page=admin_add_new" class="admin_addedit_result_1more">Добавить еще новость</a>
	<a href="index.php?admin_page=admin_news" class="admin_addedit_result_1more">Вернуться к списку новостей</a>
HERE;
} else {
    echo <<<HERE
		   <form enctype="multipart/form-data" method="post">
			 <table id="admin_newsadd_table" cellpadding="0" cellspacing="0">
			   <tr>
				 <td class="admin_newsadd_td header">
				   <p class="admin_newsadd_input_name header">Добавление новости</p>
				 </td>
			   </tr>
			   <tr>
				 <td class="admin_newsadd_td">
				   <p class="admin_newsadd_input_name">Название статьи</p>
				   <input type="text" size="100" maxlength="255" name="admin_add_new_name">
				 </td>
			   </tr>
			   <tr>
				 <td class="admin_newsadd_td">
				   <p class="admin_newsadd_input_name">Краткий текст</p>
				   <textarea cols="50" rows="6" name="admin_add_new_shorttext"></textarea>
				 </td>
			   </tr>
			   <tr>
				 <td class="admin_newsadd_td">
				   <p class="admin_newsadd_input_name">Основной текст</p>
				   <textarea id="admin_add_new_text" cols="100" rows="20" name="admin_add_new_text" maxlenght="3000"></textarea>
				   <script type="text/javascript">CKEDITOR.replace('admin_add_new_text');</script>
				 </td>
			   </tr>
			   <tr>
				 <td class="admin_newsadd_td">
				   <p class="admin_newsadd_input_name" style="display:inline">Прикрепление фотографии новости</p>
				   <input type="file" name="admin_new_img">
				 </td>
			   </tr>
			   <tr>
				 <td class="admin_newsadd_td">
				   <button type="submit" id="admin_news_add_button"> Добавить новость </button>
				 </td>
			   </tr>
			 </table>
		   </form>
HERE;
}
?>