<?php
require_once (__DIR__.'/../../config/login.php');
require_once (__DIR__.'/../../config/functions.php');
require_once (__DIR__.'/../../config/db_connect.php');
require_once (__DIR__.'/../../Model/NewsList.php');

$db = db();
$allNewsCount = NewsList::allNewsCount($db);

$deleteId = 0;

if (isset($_GET['deleteid'])) {
    $deleteId = $_GET['deleteid'];
}

if (isset($_GET['deleteid'])) {
//    $query = "DELETE FROM tbl_news WHERE id=$deleteId";
//    $query_result = mysql_query ($query) or die (mysql_error());
}

$pageNumber = 0;
if (isset($_GET['pageNumber'])) {
    $pageNumber = intval($_GET['pageNumber']);
}

$news = NewsList::allNews($db, isset($_GET['pageNumber']) ? intval($_GET['pageNumber']) : null, 10);

?>
<a href="index.php?admin_page=admin_add_new" class="admin_add_button"> Добавить новость </a>
<div id="pg_news_content">
    <?php

    for ($row=0; $row<count($news);$row++) {
        /** @var $newsItem NewsItem */
        $newsItem = $news[$row];

        if ($newsItem->getThumbnailLink()) {
            $thumbnail_name = $newsItem->getThumbnailLink();
            $thumbnail_link = ('../images/temp_news_images/'.$thumbnail_name);
        } ?>

        <table id="pg_news_table">
            <tr>
                <td class="pg_news_td top">
                    Опубликовано: <?php echo $newsItem->getCreationDate() ?> | Автор: <?php echo $newsItem->getAuthor() ?>
                </td>
                <td rowspan="2" class="admin_news_edit">
                    <a href="index.php?admin_page=admin_edit_new&id=<?php echo $newsItem->getId() ?>" class="admin_news_edit edit">
                    </a>
                    <a href="index.php?page=newslist&pageNumber=<?php echo $pageNumber ?> &deleteid=<?php echo $newsItem->getId() ?>" class="admin_news_edit delete">
                        DEL
                    </a>
                </td>
            </tr>
            <tr>
                <td class="pg_news_td middle">
                    <a href="index.php?admin_page=admin_edit_new&id=<?php echo $newsItem->getId() ?>" class="pg_news_name"><?php echo $newsItem->getTitle() ?></a>

                    <?php
                    if ($newsItem->getImageLink()) {
                        ?>
                        <img border="0" class="pg_news_image" src="<?php echo $thumbnail_link ?>" />
                    <?php
                    } ?>
                    <p class="pg_news_text"><?php echo $newsItem->getText() ?></p>
                </td>
            </tr>
        </table>
    <?php
    }
    ?>
</div>
<table id="pg_news_pagecount_table">
    <tr>
        <td class="pg_news_pagecount_td">
            <?php
            $news_pages=intval(($allNewsCount)/10);
            $news_pages1=$news_pages+1;
            if (isset($_GET['pageNumber'])) { ?>
                <a href="index.php?page=newslist&pageNumber=<?php echo ($pageNumber-1) ?>" class="pg_news_nextprev left">&lt Предыдущая</a>
            <?php } ?>
        </td>
        <td class="pg_news_pagecount_td links">
            <a class="pg_news_pagecountlink" href="index.php?page=newslist">1-10</a><?php
            for ($i=1; $i<=$news_pages; $i++) {
                $id=$i+1; ?>
                <a class="pg_news_pagecountlink" href="index.php?page=newslist&pageNumber=<?php echo $id ?>">
                    <?php echo ((10+$i*10)-9).'-'.(10+10*$i) ?>
                </a>
            <?php } ?>
        </td>
        <td class="pg_news_pagecount_td">
            <?php
            if (isset($_GET['pageNumber'])) {
                if ($_GET['pageNumber'] < $news_pages1) { ?>
                    <a href="index.php?page=newslist&pageNumber=<?php echo $pageNumber+1 ?>" class="pg_news_nextprev">Следующая &gt</a>
                <?php }
            } else { ?>
                <a href="index.php?page=newslist&pageNumber=2" class="pg_news_nextprev">Следующая &gt</a>
            <?php } ?>
        </td>
    </tr>
</table>
    