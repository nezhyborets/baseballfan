<?php ## MVC. Ìîäåëü (ÿäðî) ãîñòåâîé êíèãè.
// Çàãðóæàåò ãîñòåâóþ êíèãó ñ äèñêà. Âîçâðàùàåò ñîäåðæàíèå êíèãè.
function LoadBook($fname) {
  if (!file_exists($fname)) return array();
  $Book = unserialize(file_get_contents($fname)); 
  return $Book;
}
// Ñîõðàíÿåò ñîäåðæèìîå êíèãè íà äèñêå.
function SaveBook($fname, $Book) {
  file_put_contents($fname, serialize($Book));
}
?>