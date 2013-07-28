<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/Photo.php');

$error = null;

if (isset($_POST)) {
    if (isset($_POST['image_description']) && isset($_POST['id'])) {
        $photo = Photo::photoObjectById($_POST['id']);

        $description = htmlspecialchars($_POST['image_description']);
        $photo->setDescription($description);
        if(!$photo->save()){
            $error = 'database save error';
        };
    } else {
        $error = 'Post data not set';
    }
} else {
    $error = 'No post at all';
}

$response = $error ? $error : 'success';
echo json_encode($response);
