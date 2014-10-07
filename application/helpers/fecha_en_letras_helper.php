<?php
function getFechaEnLetras(){
 date_default_timezone_set("America/Bogota");
 setlocale(LC_TIME, "spanish");
 return "<p>" . ucwords(strftime("%A, %d de %B de %Y")) . "</p>\n";
}
?>