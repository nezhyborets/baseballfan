<div id="pg_news_shapka">
</div>
  <div id="pg_news_content">
	<?php
    for ($row=$rows;$row>=1;$row--) {
    $novost = three_news($query_result);
    echo ('
                <table cellpadding="0" cellspasing="0" id="pg_news_table">
              <tr>
                <td class="pg_news_td top">
                Опубликовано: '.$novost[tbl_date].' | Автор: '.$novost[tbl_author].'
                </td>
              </tr>
              <tr>
                <td class="pg_news_td middle">
                  <a href="google.ru" class="pg_news_name">'.$novost[tbl_name].'</a>');
        if ($novost[tbl_image_link]) {
            echo ('<img align="left" border="0" class="pg_news_image" src="'.$novost[tbl_image_link].'" />');
        }
    echo ('<p class="pg_news_text">'.$novost[tbl_text].'</p>
                </td>
              </tr>
              <tr>
                <td class="pg_news_td bottom">
                <a href="google.ru" class="pg_news_links">Комментарии (0)</a> | <a href="google.ru" class="pg_news_links">Оставить комментарий</a>
                </td>
              </tr>
            </table>
        ');}
   ?>
  </div>
      <table id="pg_news_pagecount_table" cellpaddin="0" cellspacing="0">
        <tr>
          <td class="pg_news_pagecount_td">
          <?php
		      $news_pages=intval(($allrows[0]-1)/10);
		      $news_pages1=$news_pages+1;
		      if ($_GET['pgnumber']) {
			  echo ('<a href="index.php?page=news&pgnumber='.($pgnumber-1).'" class="pg_news_nextprev left">&lt Предыдущая</a>');
		  }
			  ?>
          </td>
          <td class="pg_news_pagecount_td links">
            <a class="pg_news_pagecountlink" href="index.php?page=news">1-10</a><?php
			for ($i=1; $i<=$news_pages; $i++) {
				$id=$i+1;
				echo ('<a class="pg_news_pagecountlink" href="index.php?page=news&pgnumber='.($id).'">'.((10+$i*10)-9).'-'.(10+10*$i).'</a>');
			}
			?>
          </td>
          <td class="pg_news_pagecount_td">
          <?php
		  if (isset($_GET['pgnumber'])) {
		      if ($_GET['pgnumber'] < $news_pages1) {
			  echo ('<a href="index.php?page=news&pgnumber='.($pgnumber+1).'" class="pg_news_nextprev">Следующая &gt</a>');
			  }
		  } else {
			  echo ('<a href="index.php?page=news&pgnumber=2" class="pg_news_nextprev">Следующая &gt</a>');
		  }
		  ?>
          </td>
        </tr>
    </table>