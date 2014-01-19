<?php

require_once (__DIR__.'/../config/main_config.php');
require_once (__DIR__.'/../Model/DatabaseRecord.php');

/**
 * Created by JetBrains PhpStorm.
 * User: Алексей
 * Date: 19.01.13
 * Time: 23:17
 * To change this template use File | Settings | File Templates.
 */

class Photo extends DatabaseRecord
{
    //overriding
    const TABLE_NAME = 'tbl_photos';
    const CREATION_DATE_KEY = 'date_added';

    const PHOTOS_FOLDER_NAME = 'photoGallery_images';
    const PHOTOS_FOLDER_PATH = '/images/photoGallery_images/';

    const DESCRIPTION_KEY = 'description';
    const IMAGE_LINK_KEY = 'image_link';
    const THUMBNAIL_LINK_KEY = 'thumbnail_link';
    const ALBUM_ID_KEY = 'photo_album_id';

    private $description;
    public  $image_link;
    private $thumbnail_link;
    private $album_id;

    protected static function objectUsingPdoStatementRow($db, $row) {
        $photoObject = new Photo($db);
        $photoObject->id = $row[self::ID_KEY];
        $photoObject->creation_date = $row[self::CREATION_DATE_KEY];
        $photoObject->description = $row[self::DESCRIPTION_KEY];
        $photoObject->image_link = $row[self::IMAGE_LINK_KEY];
        $photoObject->thumbnail_link = $row[self::THUMBNAIL_LINK_KEY];
        $photoObject->album_id = $row[self::ALBUM_ID_KEY];
        return $photoObject;
    }

    public static function photosArrayForAlbumId($db, $id) {
        return static::objectsForSqlStatement($db, "SELECT * FROM tbl_photos WHERE ".self::ALBUM_ID_KEY."=$id");
    }

    public static function photosFolderPath() {
        return imagesFolder().self::PHOTOS_FOLDER_NAME.'/';
    }

    public static function removeRecordAndFilesForPhotoWithId($id) {
        $photoObject = static::photoObjectById($id);
        $photoObject->removeRecordAndFiles();
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getThumbnailImageName() {
        return $this->thumbnail_link;
    }

    public function getImageName() {
        return $this->image_link;
    }

    public function setImageLink($image_link) {
        $this->image_link = $image_link;
    }

    public function getAlbumId() {
        return $this->album_id;
    }

    public function setAlbumId($album_id) {
        $this->album_id = $album_id;
    }

    public function setThumbnailImageName($name) {
        $this->thumbnail_link = $name;
    }

    public static function createNewPhotoInDatabase() {
        $query = "INSERT INTO tbl_photos (".self::CREATION_DATE_KEY.") VALUES(".time().")";
        $query_result = mysql_query ($query) or die ("Невозможно сделать запрос". mysql_error());

        $id = mysql_insert_id();

        $photo = self::photoObjectById($id);
        return $photo;
    }

    public function updateLinkForCurrenId($link){
        $query = "UPDATE tbl_photos SET ".self::IMAGE_LINK_KEY."='$link' WHERE id=$this->id";
        $query_result = mysql_query($query) or die ("Невозможно сделать запрос". mysql_error());

        if ($query_result) {
            return true;
        }

        return false;
    }

    public function save(){
        $query = "UPDATE tbl_photos SET ".self::IMAGE_LINK_KEY."='$this->image_link',
                                        ".self::THUMBNAIL_LINK_KEY."='$this->thumbnail_link',
                                        ".self::DESCRIPTION_KEY."='$this->description',
                                        ".self::ALBUM_ID_KEY."='$this->album_id' WHERE id=$this->id";
        $query_result = mysql_query($query) or die ("Невозможно сделать запрос". mysql_error());

        if ($query_result) {
            return true;
        }

        return false;
    }

    public static function removeImageWithId($id) {
        $photoObject = self::photoObjectById($id);
        $photoObject->remove();
    }

////    public function
//
    public function removeRecordAndFiles() {
        if (file_exists(self::photosFolderPath().$this->getThumbnailImageName())) {
            deleteFileAtPath(self::photosFolderPath().$this->getThumbnailImageName());
        }

        if (file_exists(self::photosFolderPath().$this->getImageName())) {
            deleteFileAtPath(self::photosFolderPath().$this->getImageName());
        }

        $query = "DELETE FROM tbl_photos WHERE id = $this->id";
        $query_result = mysql_query($query) or die ("Невозможно сделать запрос". mysql_error());

        if ($query_result) {

        }
    }
}
