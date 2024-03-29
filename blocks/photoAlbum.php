<?php
require_once (__DIR__.'/../config/main_config.php');
require_once (__DIR__.'/../Model/PhotoAlbum.php');
require_once (__DIR__.'/../Model/Photo.php');

$albumId = 0;

if (isset($_GET['id'])) {
    $albumId = intval($_GET['id']);
}

$db = db();
/** @var $album PhotoAlbum */
$album = PhotoAlbum::objectForId($db, $albumId);
$photosArray = $album->photos();

echo('<table class="albums_list_table">');
$photosCount = count($photosArray);

for ($i = 0; $i<$photosCount; $i++) {
    $photoObject = $photosArray[$i];
    $beginningOfString = '';
    $endingOfString = '';

    if($i%5 == 0) {
        $beginningOfString = '<tr>';
    } else if (($i-2)%5 == 0){
        $endingOfString = '</tr>';
    }
?>

<?php echo ($beginningOfString); ?>
<td class="albums_list_td">
<!--    <a class="album_list_link" href="index.php?page=photoAlbum&id=--><?php //echo($photoAlbumObject->getId());?><!--">-->
        <div class="photo_album_containter">
            <div class="albums_list_imageContainer_div">
                <img style="width:100%;" src="<?php echo($photoObject->image_link);?>">
            </div>
        </div>
<!--    </a>-->
</td>
<?php echo ($endingOfString); ?>

<?php
};
echo ('</table>');
?>



