<?php
$Data = array();
$f = fopen("news.txt", "r");
for ($i=1; !feof($f) && $i<=5; $i++) {
  $n = trim(fgets($f, 1024));
  if (!$n) continue;
  $Data[] = $n;
}
?>