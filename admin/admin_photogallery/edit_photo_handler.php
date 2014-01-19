<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/Photo.php');

if (isset($_GET['id'])){
    Photo::removeRecordAndFilesForPhotoWithId($_GET['id']);
    header('location:'.$_SERVER['HTTP_REFERER']);
}