<?php

$query = "SELECT * FROM tbl_news_comments WHERE news_id=$nomer_novosti ORDER BY comment_id ASC";
$query_result = mysql_query ($query) or die (mysql_error());

$rows = mysql_num_rows ($query_result);

if ($rows>0) {
	echo ('    <table id="comments_table" cellpadding="0" cellspacing="0">
				<tr>
				  <td id="comments_td_shapka">
				  Комментарии
				  </td>
				</tr>');
  }

while ($array = mysql_fetch_array ($query_result)) {

	$comment_username = $array['comment_username'];
	$comment_text = $array['comment_text'];
	$comment_date = $array['comment_date'];
	$comment_time = $array['comment_time'];

echo <<<HERE
                <tr>
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