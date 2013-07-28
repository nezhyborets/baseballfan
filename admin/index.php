<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Документ без названия</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css"/>
    <link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui-1.10.3.custom.min.css"/>

    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../jquery-1.9.1.js"></script>
    <script type="text/javascript" src="../jquery-ui-1.10.2.custom.js"></script>
    <script type="text/javascript" src="../application.js"></script>
</head>
<body>
<div id="admin_container">
    <table id="admin_container_table">
        <tr>
            <td id="admin_menu">
                <a href="index.php?admin_page=admin_news" class="admin_menu_link">Редактирование новостей</a>
                <a href="index.php?admin_page=admin_photoGallery" class="admin_menu_link">Фотогалерея</a>
            </td>
            <td id="admin_content">
                <?php if ($_GET['admin_page'])
            {
                $pg = $_GET['admin_page'];
                switch ($pg)
                {
                    case 'admin_news': require_once ('./admin_news/admin_10news.php');
                        break;
                    case 'admin_add_new': require_once ('./admin_news/add/admin_add_new.php');
                        break;
                    case 'admin_edit_new': require_once ('./admin_news/edit/admin_edit_new.php');
                        break;
                    case 'admin_photoGallery' : require_once ('./admin_photogallery/albums_list.php');
                        break;
                    case 'admin_albumPhotosList' : require_once('./admin_photogallery/photos_list.php');
                        break;
                    case 'admin_photo_details' : require_once ('./admin_photogallery/photo_details.php');
                        break;
                }
            } else {
                require_once ('./admin_news/admin_10news.php');
            }
                ?>
            </td>
        </tr>
    </table>
</div>
</body>
</html>