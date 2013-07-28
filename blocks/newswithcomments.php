<?php
require_once './config/login.php';
require_once './config/functions.php';
require_once './config/db_connect.php';

$nomer_novosti = intval($_GET['id']);
$query = "SELECT * FROM tbl_news WHERE id=$nomer_novosti";
$query_result = mysql_query ($query);

$novost = zapros_novosti($query_result);

if ($novost['tbl_thumbnail_link']) {
$thumbnail = ('/images/temp_news_images/'.$novost[tbl_thumbnail_link]);
}

if ($_POST['comment_username'] and $_POST['comment_text']) {
		 $username = htmlspecialchars ($_POST['comment_username'], ENT_QUOTES);
		 $comment_text = htmlspecialchars ($_POST['comment_text'], ENT_QUOTES);
		 comment_save($nomer_novosti,$username,$comment_text);
	 }
?>

<div id="pg_news_shapka">
        </div>
          <div id="pg_news_content">
              <table id="novost_table" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="novost_td name">
                  <?php echo ($novost['tbl_name']);?>
                  <p class="novost_data">21:11, <?php echo ($novost['tbl_date']);?></p>
                  </td>
                </tr>
                <tr>
                  <td class="novost_td text">
                  <?php if ($novost['tbl_thumbnail_link']) {
					  echo ('
					  <a href="images/news_images/'.$novost['tbl_image_link'].'">
					  <img src="'.$thumbnail.'" class="novost_image"/>
					  </a>');
				  }
				  echo ($novost[tbl_text]);
				  ?>
                  </td>
                </tr>
              </table>

              <?php require_once ("./blocks/comments.php");?>

              <form method="post">
                <table id="comment_form_table" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                      <p class="comment_form">Введите свое имя</p>
                      <input type="text" name="comment_username" />
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="comment_form">Введите текст комментария</p>
                      <textarea cols="60" rows="5" name="comment_text"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <button type="submit" id="comment_form_button">
                      Добавить комментарий
                      </button>
                </table>
              </form>
           </div>