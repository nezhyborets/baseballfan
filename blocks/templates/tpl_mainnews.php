<div id="news"> <!--первый блок контента - новости-->
    <div id="newsshapka">
    </div>

    <table> <!--таблица для 3х новостей-->
        <?php
        /* @var $new NewsItem */
        foreach ($news as $new) { ?>
            <tr>
                <td class="newstd">
                    <p class="news">
                        <span class="newsdate"><?php echo ($new->getCreationDate())?></span>
                        <a class="newslink" href="<?php echo('index.php?page=newswithcomments&id='.$new->getId())?>"><?php echo ($new->getTitle())?></a>
                        <?php echo ($new->getShortText())?>
                        <a class="newslink1" href="<?php echo('index.php?page=newswithcomments&id='.$new->getId())?>">&raquo;читать полностью... </a>
                    </p>
                </td>
            </tr>
        <?php } ?>
    </table> <!--конец table-->
</div> <!--конец news-->