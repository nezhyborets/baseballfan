<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'./config/main_config.php');
/**
 * Created by JetBrains PhpStorm.
 * User: Алексей
 * Date: 19.01.13
 * Time: 23:17
 * To change this template use File | Settings | File Templates.
 */

class Photo
{
    const PHOTOS_FOLDER_NAME = 'photoGallery_images';
    const PHOTOS_FOLDER_PATH = '/images/photoGallery_images/';

    const ID_KEY = 'id';
    const DATE_ADDED_KEY = 'date_added';
    const DESCRIPTION_KEY = 'description';
    const IMAGE_LINK_KEY = 'image_link';
    const THUMBNAIL_LINK_KEY = 'thumbnail_link';
    const ALBUM_ID_KEY = 'photo_album_id';

    private $id;
    private $date_added;
    private $description;
    public  $image_link;
    private $thumbnail_link;
    private $album_id;

    public static function photoObjectById($id) {
        $query = "SELECT * FROM tbl_photos WHERE id=$id";
        $query_result = mysql_query ($query)
            or die ("Невозможно сделать запрос фотки". mysql_error());
        $photoFromDbResultArray = mysql_fetch_array($query_result);
        return self::photoObjectByFetchedDbArray($photoFromDbResultArray);
    }

    public static function photoObjectByFetchedDbArray($dbPhotoArray) {
        $photoObject = new Photo();
        $photoObject->id = $dbPhotoArray[self::ID_KEY];
        $photoObject->date_added = $dbPhotoArray[self::DATE_ADDED_KEY];
        $photoObject->description = $dbPhotoArray[self::DESCRIPTION_KEY];
        $photoObject->image_link = $dbPhotoArray[self::IMAGE_LINK_KEY];
        $photoObject->thumbnail_link = $dbPhotoArray[self::THUMBNAIL_LINK_KEY];
        $photoObject->album_id = $dbPhotoArray[self::ALBUM_ID_KEY];
        return $photoObject;
    }

    public static function photosArrayForAlbumId($id) {
        $query = "SELECT * FROM tbl_photos WHERE ".self::ALBUM_ID_KEY."=$id";
        $query_result = mysql_query ($query) or die ("Невозможно сделать запрос". mysql_error());
        $rows = mysql_num_rows($query_result);

        $photoObjectsArray = array();
        for ($i = 0; $i < $rows; $i++) {
            $photoFetchedDbResult = mysql_fetch_array($query_result);
            $photoObject = Photo::photoObjectByFetchedDbArray($photoFetchedDbResult);
            array_push($photoObjectsArray, $photoObject);
        }

        return $photoObjectsArray;
    }

    public static function photosFolderPath() {
        return imagesFolder().self::PHOTOS_FOLDER_NAME.'/';
    }

    public static function removeRecordAndFilesForPhotoWithId($id) {
        $photoObject = self::photoObjectById($id);
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
        $query = "INSERT INTO tbl_photos (".self::DATE_ADDED_KEY.") VALUES(".time().")";
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
