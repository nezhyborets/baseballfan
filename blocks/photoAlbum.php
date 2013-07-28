<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./config/main_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/PhotoAlbum.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'./Models/Photo.php');

$albumId = intval($_GET['id']);
$photosArray = Photo::photosArrayForAlbumId($albumId);

echo('<table class="albums_list_table">');
$photosCount = count($photosArray);

if ($i < 2) $i = 2;
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



