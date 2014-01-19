<?php
require_once (__DIR__.'/../../config/main_config.php');
require_once (__DIR__.'/../../Model/PhotoAlbum.php');
require_once (__DIR__.'/../../Model/Photo.php');

$db = db();
$allPhotoAlbums = PhotoAlbum::allPhotoAlbums($db);
$albumsCount = count($allPhotoAlbums);
?>

<script>
    $(function() {
        var name = $( "#album_name" ),
            dialogForm = $('#dialog-form');
        var description = $("#album_description"),
                allFields = $([]).add(name).add(description),
                isCreate = true,
                buttons = {},
                albumId = 0;

        var firstButtonAction = function() {
            allFields.removeClass( "ui-state-error" );

            if (name.val().trim().length > 0) {
                if (isCreate) {
                    $("#album_add_form").submit();
                    alert("Альбом добавлен");
                } else {
                    $.post('./admin_photogallery/album_edit_ajax_handler.php',
                        {id: albumId,
                            album_title: name.val(), album_description: description.val()},
                        function(data){
                            if (data['successKey']) {
                                alert(data['successKey']);
                            } else {
                                alert(data);
                            }
                            location.reload();
                        },"json")
                        .fail(function() { alert("error"); })
                }

                $( this ).dialog( "close" );
            } else {
                alert("Введите название альбома");
            }
        }

        function updateButtons() {
            buttons = {};

            if (isCreate) {
                buttons["Создать альбом"] = firstButtonAction;
            } else {
                buttons["Сохранить изменения"] = firstButtonAction;
            }

            buttons["Отмена"] = function() {
                $( this ).dialog( "close" );
            };

            dialogForm.dialog('option', 'buttons',buttons);
        }

        $( "#create_album" ).button().click(function() {
            isCreate = true;
            updateButtons();
            dialogForm.dialog('option','title','Добавить новый альбом');
            dialogForm.dialog( "open" );
        });

        $(".admin_table_buttons.edit").click(function(event) {
            event.preventDefault();
            albumId = parseInt($(this).attr('href'));
            isCreate = false;
            updateButtons();

            var albumTitle = $('#title_'+albumId).text().trim(),
                albumDescription = $('#description_'+albumId).text().trim();

            $("#album_name").val(albumTitle);
            $('#album_description').val(albumDescription);

            dialogForm.dialog('option','title','Редактирование альбома');
            dialogForm.dialog( "open" );
        });

        $("#dialog-form").dialog({
            autoOpen: false,
            height: 350,
            width: 500,
            modal: true,
            buttons: buttons,
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
    });
</script>

<div id="dialog-form">
    <form action="./admin_photogallery/album_add_handler.php" id="album_add_form" method="post">
        <fieldset>
            <label for="album_name">Название альбома</label>
            <input type="text" name="album_name" id="album_name" class="text ui-widget-content ui-corner-all" />
            </br>
            <label for="album_description">Описание</label>
            <textarea name="album_description" id="album_description" class="text ui-widget-content ui-corner-all"
                      style="width: 98%; height: 100px; margin-top: 10px; vertical-align: top;"></textarea>
        </fieldset>
    </form>
</div>

<a style="width: 98%; font: bold 18pt sans-serif; margin: 10px; padding: 20px 0 20px 0;" id="create_album">Добавить альбом</a>
<table border="1" id="admin_common_list_table">
    <tr>
        <td class="admin_table table_name_td" colspan="4">
            Список альбомов
        </td>
    </tr>

    <?php

    $itemsCount = $albumsCount;
    $numberOfColumns = 4;

    if ($albumsCount % $numberOfColumns != 0) {
        $itemsCount += $numberOfColumns - ($albumsCount % $numberOfColumns);
    }

    for ($i = 0; $i<$itemsCount; $i++) {
        $album = null;

        if ($i < $albumsCount) {

            /** @var $album PhotoAlbum */
            $album = $allPhotoAlbums[$i];
            $photoAlbumId = $album->getId();
            $photoObject = $album->cover();;
        }

        if ($i % $numberOfColumns == 0) {
            echo '<tr>';
        }
        ?>
        <td style="width: 20%; text-align: center; vertical-align: top;">
            <?php if ($album) { ?>
                <a href="?admin_page=admin_albumPhotosList&id=<?php echo($album->getId())?>">
                    <img alt="<?php $album->getTitle();?>" style="width:100%;" src="
                    <?php
                    if ($photoObject->image_link) {
                        echo($photoObject->image_link);
                    } else {
                        echo 'http://catalog.bullmast.ru/img/nopic.jpg';
                    }
                    ?>">
                </a>

                <div class="admin_table buttons_td" style="width: 100%; overflow: hidden;">
                    <div style="width: 50%; float: left;">
                        <a href="<?php echo ($photoAlbumId);?>" class="admin_table_buttons edit">
                        </a>
                    </div>
                    <div style="width: 50%; float: right;">
                        <a href="./admin_photogallery/album_delete_handler.php?id=<?php echo ($album->getId());?>" class="admin_table_buttons delete needs_confirmation">
                        </a>
                    </div>
                </div>
                <a href="?admin_page=admin_albumPhotosList&id=<?php echo($album->getId())?>"
                   class="admin_table title_link"
                   id="title_<?php echo $photoAlbumId;?>">
                    <?php echo($album->getTitle());?>
                </a>

                </br>
                <p id="description_<?php echo $photoAlbumId;?>">
                    <?php echo($album->getDescription());?>
                </p>

            <?php } ?>
        </td>
        <?php
        if (($i - ($numberOfColumns - 1)) % $numberOfColumns == 0) {
            echo '</tr>';
        }
    };
    echo ('</table>');
    ?>



