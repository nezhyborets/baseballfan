<?php

//require_once './config/functions.php';
require_once(__DIR__ .'/../config/db_connect.php');
require_once(__DIR__.'/../Model/NewsList.php');

$db = db();

$newsList = new NewsList($db);
$news = $newsList->fiveLatestNews();
require_once (__DIR__ .'/../blocks/templates/tpl_mainnews.php');