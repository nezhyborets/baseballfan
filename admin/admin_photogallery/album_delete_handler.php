<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/PhotoAlbum.php');

if (isset($_GET['id'])){
    PhotoAlbum::deletePhotoAlbumAndItPhotosById($_GET['id']);
    header('location:'.$_SERVER['HTTP_REFERER']);
}