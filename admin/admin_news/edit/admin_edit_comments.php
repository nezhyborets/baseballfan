<?php
if ($_GET['comment_del_id']) {
	$comment_del_id = $_GET['comment_del_id'];
	$query = "DELETE FROM tbl_news_comments WHERE comment_id=$comment_del_id";
	$query_result = mysql_query ($query) or die (mysql_error());
}

$query = "SELECT * FROM tbl_news_comments WHERE news_id=$nomer_novosti";
$query_result = mysql_query ($query) or die (mysql_error());

$rows = mysql_num_rows ($query_result);

if ($rows>0) {
	echo ('    <table id="comments_table" cellpadding="0" cellspacing="0">
				<tr>
				  <td id="comments_td_shapka" colspan="2">
				  Комментарии
				  </td>
				</tr>');
  }

while ($array = mysql_fetch_array ($query_result)) {
	$comment_id = $array['comment_id'];
	$comment_username = $array['comment_username'];
	$comment_text = $array['comment_text'];
	$comment_date = $array['comment_date'];
	$comment_time = $array['comment_time'];
         
echo <<<HERE
                <tr>
				  <td class="comments_td">
				    <a href="index.php?admin_page=admin_edit_new&id=$novost[tbl_key]&comment_del_id=$comment_id" class="comment_delete">DEL</a>
				  </td>
                  <td class="comments_td">
                    <p class="comment_username">$comment_username</p>
					<p class="comment_datetime">$comment_date, $comment_time</p>
                    <p class="comment_text">$comment_text</p>
                  </td>				 
                </tr>
HERE;
}

if ($rows>0) {
	echo ('</table>');
}
?>