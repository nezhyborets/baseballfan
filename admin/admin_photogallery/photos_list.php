<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./config/main_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/PhotoAlbum.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/Photo.php');

$albumId = intval($_GET['id']);
$photoAlbumObject = PhotoAlbum::getPhotoAlbumById($albumId);
$photosArray = $photoAlbumObject->getAllPhotoObjects();
$albumCoverPhoto = $photoAlbumObject->getCoverPhoto();
?>

<form action="./admin_photogallery/photo_upload_handler.php" method="post" enctype="multipart/form-data">
    <div class="files_adding_form" id="container">
        <div id="title" class="files_adding_form">
            Добавление фотографий:
        </div>
        <div class="files_adding_form">
            <input type="file" name="photos[]" multiple>
            <br>
            <input type="hidden" name="album_id" value="<?php echo($photoAlbumObject->getId())?>">
            <input type="submit" value="Отправить">
        </div>
    </div>
</form>

<script>
    $(function() {
        var coverAlbumId = <?php echo $albumCoverPhoto->getId();?>;
        $('#cover_check'+coverAlbumId).attr('checked',true);

        $('.cover_checkbox').click()
    });
</script>

<table border="1" id="admin_common_list_table">
    <tr>
        <td colspan="3" class="admin_table table_name_td">
            Список фотографий альбома: <?php echo($photoAlbumObject->getTitle()); ?>
        </td>
    </tr>

    <?php
    $photosCount = count($photosArray);
    for ($i = 0; $i<$photosCount; $i++) {
        $photoObject = $photosArray[$i];
        $photoId = $photoObject->getId();
        ?>
        <tr>
            <td class="admin_table image_td">
                <!--    <a class="album_list_link" href="index.php?page=photoAlbum&id=--><?php //echo($photoAlbumObject->getId());?><!--">-->
                <img style="width:100%;" src="<?php echo(Photo::PHOTOS_FOLDER_PATH.$photoObject->getThumbnailImageName());?>" alt="<?php echo($photoAlbumObject->getTitle())?>">
                <!--    </a>-->
            </td>
            <td class="admin_table">
                <?php echo($photoObject->getDescription())?>
            </td>
            <td class="admin_table buttons_td">
                <a href="?admin_page=admin_photo_details&id=<?php echo $photoId;?>" class="admin_table_buttons edit">
                </a>
                <a href="./admin_photogallery/photoDeleteHandler.php?id=<?php echo $photoId;?>" class="admin_table_buttons delete needs_confirmation">
                </a>
                <input type="checkbox" class="cover_checkbox" id="cover_check<?php echo $photoId;?>">
            </td>
        </tr>
    <?php
    };
    ?>
</table>



