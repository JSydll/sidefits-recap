<?php
$sprache = $_SERVER["HTTP_ACCEPT_LANGUAGE"];

if($sprache[0].$sprache[1] == 'de') {
    header ("location: index-de.php");
} else {
    header ("location: index-en.php");
}



?>