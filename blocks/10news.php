<?php
require_once(__DIR__ . '/../config/login.php');
require_once(__DIR__ . '/../config/functions.php');
require_once(__DIR__ . '/../config/db_connect.php');
require_once(__DIR__ . '/../Model/NewsList.php');

$newsPerPage = 10;

$db = db();
$allRows = NewsList::allNewsCount($db);

$pageNumber = 0;
if (isset($_GET['pageNumber'])) {
    $pageNumber = intval($_GET['pageNumber']);
}

$news = NewsList::allNews($db, isset($_GET['pageNumber']) ? intval($_GET['pageNumber']) : null, $newsPerPage);

?>

<div id="pg_news_shapka">
</div>
<div id="pg_news_content">
    <?php

    for ($row = count($news); $row >= 1; $row--) {

        /** @var $newsItem NewsItem */
        $newsItem = $news[$row - 1];

        $comments_count = $newsItem->commentsCount();

        if ($newsItem->getThumbnailLink()) {
            $thumbnail = ('images/temp_news_images/'.$newsItem->getThumbnailLink());
        } ?>
            <table id="pg_news_table">
              <tr>
                <td class="pg_news_td top">
                Опубликовано: <?php echo $newsItem->getCreationDate(); ?> | Автор: <?php echo $newsItem->getAuthor(); ?>
                </td>
              </tr>
              <tr>
                <td class="pg_news_td middle">
                  <a href="index.php?page=newswithcomments&id=<?php echo $newsItem->getId(); ?>" class="pg_news_name"><?php echo $newsItem->getTitle() ?></a>
                 <?php
                 if ($newsItem->getImageLink()) {
                 ?>
			<a href="images/news_images/ <?php echo $newsItem->getImageLink()?>">
			<img border="0" class="pg_news_image" src="<?php echo $thumbnail ?>" />
			</a>
        <?php } ?>
        <p class="pg_news_text"><?php echo $newsItem->getText() ?></p>
                </td>
              </tr>
              <tr>
                <td class="pg_news_td bottom">
                <a href="index.php?page=newswithcomments&id=<?php $newsItem->getId() ?>" class="pg_news_links">
                    Комментарии (<?php echo $comments_count ?>)
                </a> | <a href="index.php?page=newswithcomments&id=<?php $newsItem->getId() ?>" class="pg_news_links">Оставить комментарий</a>
                </td>
              </tr>
            </table>
    <?php }
    ?>
</div>
<table id="pg_news_pagecount_table">
    <tr>
        <td class="pg_news_pagecount_td">
            <?php
            $news_pages = intval(($allRows[0] - 1) / 10);
            $news_pages1 = $news_pages + 1;
            if (isset($_GET['pageNumber'])) {
                echo('<a href="index.php?page=newslist&pageNumber=' . ($pageNumber - 1) . '" class="pg_news_nextprev left">&lt Предыдущая</a>');
            }
            ?>
        </td>
        <td class="pg_news_pagecount_td links">
            <a class="pg_news_pagecountlink" href="index.php?page=newslist">1-10</a><?php
            for ($i = 1; $i <= $news_pages; $i++) {
                $id = $i + 1;
                echo('<a class="pg_news_pagecountlink" href="index.php?page=newslist&pageNumber=' . ($id) . '">' . ((10 + $i * 10) - 9) . '-' . (10 + 10 * $i) . '</a>');
            }
            ?>
        </td>
        <td class="pg_news_pagecount_td">
            <?php
            if (isset($_GET['pageNumber'])) {
                if ($_GET['pageNumber'] < $news_pages1) {
                    echo('<a href="index.php?page=newslist&pageNumber=' . ($pageNumber + 1) . '" class="pg_news_nextprev">Следующая &gt</a>');
                }
            } else {
                echo('<a href="index.php?page=newslist&pageNumber=2" class="pg_news_nextprev">Следующая &gt</a>');
            }
            ?>
        </td>
    </tr>
</table>
    