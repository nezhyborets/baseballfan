<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'./Model/Photo.php');

if (isset($_GET['id'])){
    $photo = Photo::photoObjectById($_GET['id']);
    ?>

    <script>
        $(document).ready(function(){
            $('#edit_form').submit(function(event){
                event.preventDefault();
                var description = $('#image_description').val();

                $.post('./admin_photogallery/photo_edit_handler.php', {image_description: description, id: <?php echo($_GET['id']); ?>}, function(data){
                    if (data == 'success') {
                        alert('Сохранено');
                    } else {
                        alert(data);
                    }
                },"json")
                    .fail(function() { alert("error"); })
            })
        });
    </script>

    <div style="width: 100%; padding: 15px 0 15px 0; background-color: #d3d3d3; text-align: center; vertical-align: middle; font: 18pt Helvetica">Редактирование деталей фотографии:</div>
    <div style="width: 40%; float: left; padding: 10px; background-color: #f1f1f1;">
        <img style="width: 100%;" src="<?php echo(Photo::PHOTOS_FOLDER_PATH.'/'.$photo->image_link);?>">
    </div>
    <div style="float: right; width: 56%; padding: 10px;">
        <form action="" id="edit_form">
            <label for="image_description">
                Описание:
                <textarea style="width: 90%;" rows="10" name="image_description" id="image_description"><?php echo($photo->getDescription());?></textarea>
            </label>
            <button type="submit" class="admin_texted_button save" id="photo_details_submit_btn">Сохранить изменения</button>
            <a href="./admin_photogallery/photoDeleteHandler.php?id=<?php echo ($photo->getId());?>" class="admin_texted_button delete needs_confirmation">Удалить фотографию</a>
        </form>
    </div>
<?php
}?>