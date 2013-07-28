<div id="news"> <!--первый блок контента - новости-->
    <div id="newsshapka">
    </div>

    <table cellpadding="0" cellspacing="0"> <!--таблица для 3х новостей-->
        <tr>
            <td class="newstd">
                <p class="news">
                    <span class="newsdate"><?php echo ($novost1['tbl_date'])?></span>
                    <a class="newslink" href="<?php echo("index.php?page=newswithcomments&id=$novost1[tbl_key]")?>"><?php echo ($novost1['tbl_name'])?></a>
                    <?php echo ($novost1['tbl_short_text'])?>
                    <a class="newslink1" href="<?php echo("index.php?page=newswithcomments&id=$novost1[tbl_key]")?>">&raquo;читать полностью... </a>
                </p>
            </td>
        </tr>
        <tr>
            <td class="newstd middle">
                <p class="news">
                    <span class="newsdate"><?php echo ($novost2['tbl_date'])?></span>
                    <a class="newslink" href="<?php echo("index.php?page=newswithcomments&id=$novost2[tbl_key]")?>"><?php echo ($novost2['tbl_name'])?></a>
                    <?php echo ($novost2['tbl_short_text'])?>
                    <a class="newslink1" href="<?php echo("index.php?page=newswithcomments&id=$novost2[tbl_key]")?>">&raquo;читать полностью... </a>
                </p>
            </td>
        </tr>
        <tr>
            <td class="newstd">
                <p class="news">
                    <span class="newsdate"><?php echo ($novost3['tbl_date'])?></span>
                    <a class="newslink" href="<?php echo("index.php?page=newswithcomments&id=$novost3[tbl_key]")?>"><?php echo ($novost3['tbl_name'])?></a>
                    <?php echo ($novost3['tbl_short_text'])?>
                    <a class="newslink1" href="<?php echo("index.php?page=newswithcomments&id=$novost3[tbl_key]")?>">&raquo;читать полностью... </a>
                </p>
            </td>
        </tr>
        <tr>
            <td class="newstd middle">
                <p class="news">
                    <span class="newsdate"><?php echo ($novost4['tbl_date'])?></span>
                    <a class="newslink" href="<?php echo("index.php?page=newswithcomments&id=$novost4[tbl_key]")?>"><?php echo ($novost4['tbl_name'])?></a>
                    <?php echo ($novost4['tbl_short_text'])?>
                    <a class="newslink1" href="<?php echo("index.php?page=newswithcomments&id=$novost4[tbl_key]")?>">&raquo;читать полностью... </a>
                </p>
            </td>
        </tr>
        <tr>
            <td class="newstd">
                <p class="news">
                    <span class="newsdate"><?php echo ($novost5['tbl_date'])?></span>
                    <a class="newslink" href="<?php echo("index.php?page=newswithcomments&id=$novost5[tbl_key]")?>"><?php echo ($novost5['tbl_name'])?></a>
                    <?php echo ($novost5['tbl_short_text'])?>
                    <a class="newslink1" href="<?php echo("index.php?page=newswithcomments&id=$novost5[tbl_key]")?>">&raquo;читать полностью... </a>
                </p>
            </td>
        </tr>
    </table> <!--конец table-->
</div> <!--конец news-->