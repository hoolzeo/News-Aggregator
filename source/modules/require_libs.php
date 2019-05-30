<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/RedBeanPHP/db.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/templates.php';

function GetRootUrl($link) {
  return str_replace('www.', '', parse_url($link, PHP_URL_HOST));
}

function isHaveText($str, $substr)
{
	$result = strpos($str, $substr);
	if ($result === FALSE) // если это действительно FALSE, а не ноль, например
	return false;
	else return true;
}

function downloadFile ($URL, $PATH) {
    $ReadFile = fopen ($URL, "rb");

    if ($ReadFile) {
        $WriteFile = fopen ($PATH, "wb");
        if ($WriteFile){
            while(!feof($ReadFile)) {
                fwrite($WriteFile, fread($ReadFile, 4096 ));
            }
            fclose($WriteFile);
        }
        fclose($ReadFile);
    }
}

function ShowMessage($text, $type) {
  echo '<script>alert("' . $text . '")</script>';
}

?>
