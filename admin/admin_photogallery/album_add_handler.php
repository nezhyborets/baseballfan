<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/PhotoAlbum.php');

if (isset($_POST['album_name'])){
    PhotoAlbum::addAlbumWithNameAndDescription($_POST['album_name'], $_POST['album_description']);
    header('location:'.$_SERVER['HTTP_REFERER']);
}