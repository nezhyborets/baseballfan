<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/Photo.php');

if (isset($_GET['id'])) {
    $photo = Photo::photoObjectById($_GET['id']);
    $album_id = $photo->getAlbumId();
    $photo->removeRecordAndFiles();

    header('location:/admin/index.php?admin_page=admin_albumPhotosList&id='.$album_id);
}