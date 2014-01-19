<?php

require_once(__DIR__.'/../Model/DatabaseRecord.php');
require_once(__DIR__.'/../Model/NewsItem.php');

class NewsList extends NewsItem {
    public function fiveLatestNews() {
        return static::objectsForSqlStatement($this->db, 'SELECT * FROM '.NewsItem::TABLE_NAME.' ORDER BY id DESC LIMIT 5');
    }

    public static function allNewsCount($db) {
        return static::resultForSqlStatement($db,'SELECT COUNT(*) FROM '.NewsItem::TABLE_NAME);
    }

    public static function allNews($db, $pageNumber, $newsPerPage) {
        $offset = 0;
        if (isset($pageNumber)) {
            $offset = $pageNumber*10-10;
        }
        return static::objectsForSqlStatement($db, "SELECT * FROM tbl_news ORDER BY id DESC LIMIT $offset, $newsPerPage");
    }
}