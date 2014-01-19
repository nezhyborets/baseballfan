<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./config/main_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/PhotoAlbum.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/Photo.php');

if (isset($_POST['album_id'])) {
    $photoAlbumObject = PhotoAlbum::getPhotoAlbumById($_POST['album_id']);

    if (isset($_FILES['photos'])) {
        $photos = $_FILES['photos'];

        for ($i = 0; $i < count($photos['name']); $i++) {
            $tempFileName = $photos['tmp_name'][$i];
            $fileName = $photos['name'][$i];

            $photoObject = Photo::createNewPhotoInDatabase();
            $savedId = $photoObject->getId();

            $targetName = 'album'.$photoAlbumObject->getId().'_photo'.$savedId;
            $savedImageName = image_upload($fileName,$tempFileName,Photo::PHOTOS_FOLDER_NAME,$targetName);

            $thumbnail_image_name = thumbnailImageToDir(
                Photo::photosFolderPath(),
                $savedImageName,
                Photo::photosFolderPath());

            $photoObject->setThumbnailImageName($thumbnail_image_name);
            $photoObject->setImageLink($savedImageName);
            $photoObject->setAlbumId($photoAlbumObject->getId());
            $photoObject->save();
        }
    }
}
header('location:'.$_SERVER['HTTP_REFERER']);