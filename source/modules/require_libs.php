<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/RedBeanPHP/db.php';

error_reporting(0); // Проект в бете, не мазолим глаза юзерам
mb_internal_encoding("UTF-8");

// Если куков нет - добавляем все источники в куки
if ((!isset($_COOKIE['allow_sources'])) or (count(unserialize($_COOKIE['allow_sources'])) == 0)) {
  $ArrayUserSources = [];
  $sql_sources = R::getAll("SELECT * FROM sources GROUP BY name");
  foreach ($sql_sources as $current_site) array_push ($ArrayUserSources, $current_site['url']);
  Setcookie("allow_sources", serialize($ArrayUserSources));
  $emptyCookie = true;
}

// Если пользователь авторизован - получаем его логин и ID
if ( isset ($_SESSION['logged_user']) ) {
  $userlogin = $_SESSION['logged_user']->login;
  $userID = R::findOne('users', 'login = ?', [$userlogin])['id'];
  $getStopWords = R::getAll( 'SELECT `stop_words` FROM `users` WHERE `login` = "'.$userlogin.'" LIMIT 1' );
  $stop_words_string = $getStopWords[0]['stop_words'];

  $stop_words = explode(",", $getStopWords[0]['stop_words']);

  // Обрезаем окончания у стоп-слов
  for ($i = 0; $i<count($stop_words);$i++) $stop_words[$i] = DeleteEndings($stop_words[$i]);
}


function getSourceInfo($source, $column) {
	$sources = R::getAll( 'SELECT * FROM sources' );
  foreach ($sources as $item) {
    if (isHaveText($source, $item['url'])) {
			return $item[$column];
    }
  }
}

function outputLinksPost($id, $title, $source) {
  echo '<li id="'.$id.'"><a href="/pages/view.php?id='.$id.'">';
	echo '<div class="source-icon"><img src="/images/icons/sites/16/'.CutSubDomain(GetRootUrl($source)).'.ico"></div>';
  echo '    <div class="title">'.$title.'</div>';
  echo '  </a></li>';
}

function outputImagePost($id, $title, $image, $source) {
  echo '<div class="cart" id="'.$id.'">';
  echo '<div class="cart-image">';

	if(isset($image)) {
		echo '<a href="/pages/view.php?id='.$id.'"><img src="'.$image.'"></a>';
		echo '<div class="source">'.getSourceInfo($source, 'name').'</div>';
	} else {
		echo '<a href="/pages/view.php?id='.$id.'"><img src="/images/noimg.jpg"></a>';
		echo '<div class="source" style="color: gray">'.getSourceInfo($source, 'name').'</div>';
	}
  echo '   </div>';
  echo '   <div class="cart-title done"><a href="/pages/view.php?id='.$id.'">'.$title.'</a></div>';
  echo '   </div>';
}

function CutSubDomain($domain) {
  $words = explode('.', $domain);
  if (sizeof($words) < 2) throw new RuntimeException('Provided URL doesn\'t contain second-level domain');
  return implode('.', array_slice($words, -2));
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

function ShowMessage($text, $type = 'error') {
  echo '<script>alert("' . $text . '")</script>';
}

// Обрезаем окончания у слов для более эффективного поиска
function DeleteEndings($word) {
    $word = preg_replace("/("."ых|ый|ы|ой|ое|ые|ому|ом|ами|ам|ая|ат|ать|а|овый|ов|ого|ох|о|у|ему|ей|е|ство|ия|ий|и|ять|ь|я|он|ют|".")$/i", "", $word); //удаляем окончания
    return $word;
}

function PrintArray($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}

function str_replace_once($search, $replace, $text)
{
   $pos = strpos($text, $search);
   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
}
?>
