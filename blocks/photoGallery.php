<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./config/main_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/PhotoAlbum.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/Photo.php');

$allPhotoAlbums = PhotoAlbum::getAllPhotoAlbums();
echo('<table class="albums_list_table">');
$albumsCount = count($allPhotoAlbums);
for ($i = 0; $i<$albumsCount; $i++) {
    $photoAlbumObject = $allPhotoAlbums[$i];
    $photoObject = Photo::photoObjectById($photoAlbumObject->cover_photo_id);
    $beginningOfString = '';
    $endingOfString = '';

    if($i%3 == 0) {
        $beginningOfString = '<tr>';
    } else if (($i-2)%3 == 0){
        $endingOfString = '</tr>';
    } else {

    }
?>

<?php echo ($beginningOfString); ?>
<td class="albums_list_td">
    <a class="album_list_link" href="index.php?page=photoAlbum&id=<?php echo($photoAlbumObject->getId())?>">
        <div class="photo_album_containter">
            <div class="albums_list_imageContainer_div">
                <img style="width:100%;" src="<?php echo($photoObject->image_link);?>">
            </div>
            <div class="photo_album_description_td">
                <?php echo($photoAlbumObject->getTitle());?>
            </div>
        </div>
    </a>
</td>
<?php echo ($endingOfString); ?>

<?php
};
echo ('</table>');
?>



