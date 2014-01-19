<?php
require_once (__DIR__.'/../config/main_config.php');
require_once (__DIR__.'/../Model/PhotoAlbum.php');
require_once (__DIR__.'/../Model/Photo.php');

$db = db();
$allPhotoAlbums = PhotoAlbum::allPhotoAlbums($db);

echo('<table class="albums_list_table">');
$albumsCount = count($allPhotoAlbums);

for ($i = 0; $i<$albumsCount; $i++) {

    /** @var $photoAlbumObject PhotoAlbum */
    $photoAlbumObject = $allPhotoAlbums[$i];
    $photoObject = $photoAlbumObject->cover();
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



