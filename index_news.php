<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<title>Документ без названия</title>
<link rel="stylesheet" type="text/css" href="css/main.css"/>
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
        <a class="menu" href="index.php?page=main">Главная страница</a>
        <a class="menu" href="index.php?page=newslist">Новости</a>
        <a class="menu" href="http://google.ru">Результаты</a>
        <a class="menu" href="http://google.ru">Гостевая</a>
        <a class="menu" href="http://google.ru">Фотогалерея</a>
      </div>
      <div id="content"> <!--общая колонка контента с темным фоном-->
        <?php require_once ('/blocks/novost.php'); ?>
      </div> <!--конец content-->
    <div id="rasporka"></div> <!--вспомогательный элемент для футера-->
  </div> <!--конец container-->
  <div id="footer">Огромные возможности</div> <!--футер-->
</body>
</html>