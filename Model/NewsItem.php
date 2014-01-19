<?php

require_once (__DIR__.'/../config/main_config.php');
require_once(__DIR__.'/../Model/NewsComment.php');
/**
 * Created by JetBrains PhpStorm.
 * User: Алексей
 * Date: 19.01.13
 * Time: 23:17
 * To change this template use File | Settings | File Templates.
 */

class NewsItem extends DatabaseRecord
{
    const TABLE_NAME = 'tbl_news';

    //override
    const CREATION_DATE_KEY = 'date';

    //class constants
    const NAME_KEY = 'name';
    const SHORT_TEXT_KEY = 'short_text';
    const TEXT_KEY = 'text';
    const AUTHOR_KEY = 'author';
    const IMAGE_LINK_KEY = 'image_link';
    const THUMBNAIL_LINK_KEY = 'thumbnail_link';

    private $id;
    private $creation_date;
    private $title;
    private $short_text;
    private $text;
    private $author;
    private $image_link;
    private $thumbnail_link;

    protected static function objectUsingPdoStatementRow($db, $row) {
        $newItems = new self($db);
        $newItems->id = $row[self::ID_KEY];
        $newItems->creation_date = $row[self::CREATION_DATE_KEY];
        $newItems->title = $row[self::NAME_KEY];
        $newItems->short_text = $row[self::SHORT_TEXT_KEY];
        $newItems->text = $row[self::TEXT_KEY];
        $newItems->author = $row[self::AUTHOR_KEY];
        $newItems->image_link = $row[self::IMAGE_LINK_KEY];
        $newItems->thumbnail_link = $row[self::THUMBNAIL_LINK_KEY];
        return $newItems;
    }

    public function getCreationDate()
    {
        return $this->creation_date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getThumbnailLink()
    {
        return $this->thumbnail_link;
    }

    /**
     * @return mixed
     */
    public function getImageLink()
    {
        return $this->image_link;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function getShortText()
    {
        return $this->short_text;
    }

    public function commentsCount() {
        return static::resultForSqlStatement($this->db,'SELECT COUNT(*) FROM '.NewsComment::TABLE_NAME.' WHERE news_id='.$this->id);
    }
}
