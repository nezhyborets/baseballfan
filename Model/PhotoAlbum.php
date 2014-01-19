<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Алексей
 * Date: 19.01.13
 * Time: 14:33
 * To change this template use File | Settings | File Templates.
 */
require_once (__DIR__.'/../config/main_config.php');
require_once (__DIR__.'/../config/main_config.php');
require_once (__DIR__.'/../Model/Photo.php');
require_once (__DIR__.'/../Model/DatabaseRecord.php');

class PhotoAlbum extends DatabaseRecord
{
    //Overriding
    const TABLE_NAME = 'tbl_photoAlbums';

    const COVER_PHOTO_ID_KEY = 'cover_photo_id';
    const TITLE_KEY = 'title';
    const DESCRIPTION_KEY = 'description';

    public $cover_photo_id;
    private $title;
    private $description;

    public function getTitle(){
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function cover() {
        return Photo::objectForId($this->db, $this->cover_photo_id);
    }

    public static function allPhotoAlbums($db) {
        return static::objectsForSqlStatement($db, 'SELECT * FROM '.static::TABLE_NAME.' ORDER BY '.static::ID_KEY.' DESC');
    }

    protected static function objectUsingPdoStatementRow($db, $row) {
        $photoAlbumObject = new PhotoAlbum($db);
        $photoAlbumObject->id = $row[self::ID_KEY];
        $dateTime = strtotime($row[self::CREATION_DATE_KEY]);
        $photoAlbumObject->creation_date = date("Y-m-d H:i:s", $dateTime);
        $photoAlbumObject->cover_photo_id = $row[self::COVER_PHOTO_ID_KEY];
        $photoAlbumObject->title = $row[self::TITLE_KEY];
        $photoAlbumObject->description = $row[self::DESCRIPTION_KEY];
        return $photoAlbumObject;
    }

    public static function addAlbumWithNameAndDescription($name, $description) {
        $name = trim($name);
        $query = "INSERT INTO tbl_photoAlbums (title, description, creation_date) VALUES ('$name', '$description', NOW())";
        $query_result = mysql_query ($query)
        or die ("Невозможно сделать запрос". mysql_error());
    }

    public static function deletePhotoAlbumAndItPhotosById($id) {
        $photoAlbum = self::getPhotoAlbumById($id);
        $photoAlbum->removeAlbumAndAllPhotos();
    }

    private static function photoAlbumByDbResultRow($albumFromDbArray) {
        $photoAlbumObject = new PhotoAlbum();
        $photoAlbumObject->id = $albumFromDbArray[self::ID_KEY];

        $dateTime = strtotime($albumFromDbArray[self::CREATION_DATE_KEY]);
        $photoAlbumObject->creation_date = date("Y-m-d H:i:s", $dateTime);

        $photoAlbumObject->cover_photo_id = $albumFromDbArray[self::COVER_PHOTO_ID_KEY];
        $photoAlbumObject->title = $albumFromDbArray[self::TITLE_KEY];
        $photoAlbumObject->description = $albumFromDbArray[self::DESCRIPTION_KEY];
        return $photoAlbumObject;
    }

    public static function getPhotoAlbumById($id) {
        $query = "SELECT * FROM tbl_photoAlbums WHERE id=$id";
        $query_result = mysql_query ($query)
            or die ("Невозможно сделать запрос". mysql_error());
        $photoAlbumObject = self::photoAlbumByDbResultRow(mysql_fetch_array($query_result));
        return $photoAlbumObject;
    }

    public function getCoverPhoto () {
        $coverPhoto = Photo::photoObjectById($this->cover_photo_id);
        return $coverPhoto;
    }

    public function getId(){
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function save(){
        $query = "UPDATE tbl_photoAlbums SET ".self::ID_KEY."='$this->id',
                                        ".self::CREATION_DATE_KEY."='$this->creation_date',
                                        ".self::COVER_PHOTO_ID_KEY."='$this->cover_photo_id',
                                        ".self::TITLE_KEY."='$this->title',
                                        ".self::DESCRIPTION_KEY."='$this->description' WHERE id=$this->id";
        
        $query_result = mysql_query($query) or die ("Невозможно сделать запрос". mysql_error());

        if ($query_result) {
            return true;
        }

        return false;
    }

    public function photos() {
        return Photo::photosArrayForAlbumId($this->db, $this->id);
    }

    private function removeAlbumAndAllPhotos() {
        $photosArray = $this->photos();

        foreach ($photosArray as $photo) {
            $photo->removeRecordAndFiles();
        }

        $query = "DELETE FROM tbl_photoAlbums WHERE id = $this->id";
        $query_result = mysql_query($query) or die ("Невозможно сделать запрос". mysql_error());

        if ($query_result) {
            return TRUE;
        }

        return FALSE;
    }
}
