<?php

// Language switcher. Depending on current language certain lang-file is loaded.

header ("Content-Type: text/html; charset=utf-8");

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

switch ($lang) {
  case 'en':
  	$lang_file = 'lang.en.php';
  break;

  default:
  	$lang_file = 'lang.ru.php';

}

include_once 'languages/'.$lang_file;

?>