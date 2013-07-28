<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Бейсбол в Украине</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/photoGallery.css"/>

    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="jquery-1.9.1.js.js"></script>
    <script type="text/javascript" src="application.js"></script>
    <!--[if (lt IE 9)]>
    <style type="text/css">
        #container {
            background-color:#f6f6f6;}
        #menutable,#content,#leftmenu {
            border: 1px solid black;
        }
    </style>
    <![endif]-->
</head>
<body>
<div id="header"> <!--начало header-->
</div> <!--конец header-->

<div id="container">
    <div id="leftmenu">
        <a class="menu" href="index.php">Главная страница</a>
        <a class="menu" href="index.php?page=newslist">Новости</a>
        <a class="menu" href="index.php?page=photoGallery">Фотогалерея</a>
    </div>
    <div id="content"> <!--общая колонка контента с темным фоном-->
        <?php
        set_include_path($_SERVER['DOCUMENT_ROOT']);
        if (isset($_GET['page']))
        {
            $pg = $_GET['page'];
            switch ($pg)
            {
                case 'main': require_once './blocks/mainnews.php';
                    require_once './blocks/mainresults.php';
                    break;

                case 'newslist': require_once './blocks/10news.php';
                    break;

                case 'newswithcomments': require_once './blocks/newswithcomments.php';
                    break;

                case 'photoGallery': require_once'./blocks/photoGallery.php';
                    break;

                case 'photoAlbum' : require_once './blocks/photoAlbum.php';
                    break;
            }
        } else {
            require_once './blocks/mainnews.php';
            require_once './blocks/mainresults.php';
        }
        ?>
    </div> <!--конец content-->
    <div id="rasporka"></div> <!--вспомогательный элемент для футера-->
</div> <!--конец container-->
<div id="footer">
    <!-- MyCounter v.2.0 -->
    <script type="text/javascript">
        my_id = 116210;
        my_width = 88;
        my_height = 41;
        my_alt = "MyCounter - счётчик и статистика";
    </script>
    <script type="text/javascript"
            src="http://scripts.mycounter.ua/counter2.0.js">
    </script><noscript>
    <a target="_blank" href="http://mycounter.ua/"><img
            src="http://get.mycounter.ua/counter.php?id=116210"
            title="MyCounter - счётчик и статистика"
            alt="MyCounter - счётчик и статистика"
            width="88" height="41" border="0" /></a></noscript>
    <!--/ MyCounter -->
</div> <!--футер-->
</body>
</html>