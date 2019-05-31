<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/RedBeanPHP/db.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/stuff/templates.php';

if ( isset ($_SESSION['logged_user']) ) {
  $userlogin = $_SESSION['logged_user']->login;
  $userID = R::exec('SELECT `id` FROM `users` WHERE `login` = "'.$userlogin.'"');

  $getStopWords = R::getAll( 'SELECT `stop_words` FROM `users` WHERE `login` = "'.$userlogin.'" LIMIT 1' );
  $stop_words_string = $getStopWords[0]['stop_words'];
  
  $stop_words = explode(",", $getStopWords[0]['stop_words']);

  // Обрезаем окончания у стоп-слов
  for ($i = 0; $i<count($stop_words);$i++) $stop_words[$i] = DeleteEndings($stop_words[$i]);
}

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

// Обрезаем окончания у слов для более эффективного поиска
function DeleteEndings($word) {
    $word = preg_replace("/("."ых|ый|ы|ой|ое|ые|ому|ом|ами|ам|ая|ат|ать|а|овый|ов|ого|ох|о|у|ему|ей|е|ство|ия|ий|и|ять|ь|я|он|ют|".")$/i", "", $word); //удаляем окончания
    return $word;
}

?>
