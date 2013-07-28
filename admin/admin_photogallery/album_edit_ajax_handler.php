<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/PhotoAlbum.php');

$error = null;
$action = null;

if (isset($_POST['id'])) {
    $album = PhotoAlbum::getPhotoAlbumById($_POST['id']);

    if (isset($_POST['album_title'])) {
        $album->setTitle($_POST['album_title']);
        $action = 'Имя альбома обновлено.';
    }

    if (isset($_POST['album_description'])) {
        $album->setTitle($_POST['album_title']);
        $action = $action.' Описание альбома обновлено.';
    }

    if (!$album->save()) {
        $error = 'Save error';
    }
} else {
    $error = 'No id passed';
}

$response = $error ? $error : array('successKey' => $action);
echo json_encode($response);