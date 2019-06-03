<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/phpQuery/phpQuery.php';

function GetOpenGraphImage($page) {
  $dom_obj = new DOMDocument();
  $dom_obj->loadHTML($page);
  $meta_val = null;

  foreach($dom_obj->getElementsByTagName('meta') as $meta) {

  if($meta->getAttribute('property')=='og:image'){

      $meta_val = $meta->getAttribute('content');
  }
  }
  return $meta_val;
}

function GetJsonDate($html) {
  $dom = new DOMDocument();
  libxml_use_internal_errors( 1 );
  $dom->loadHTML( $html );
  $xpath = new DOMXpath( $dom );

  $script = $dom->getElementsByTagName( 'script' );
  $script = $xpath->query( '//script[@type="application/ld+json"]' );
  $json = $script->item(0)->nodeValue;

  $jsonArr = json_decode($json);
  $date = $jsonArr->datePublished;
  return $date;
}

function isUnix($timestamp)
{
    return ((string) (int) $timestamp === $timestamp) && ($timestamp <= PHP_INT_MAX) && ($timestamp >= ~PHP_INT_MAX);
}

function formatDate($date) {
  if (isUnix($date)) {
    return gmdate("Y-m-d", $date);
  } else {
    return date("Y-m-d", strtotime($date));
  }
}

function SiteParse($host, $item, $prev_title, $prev_link, $post_text, $if_decode, $post_image = null, $category = null, $date)
{

  $data_site = file_get_contents($host); // получаем страницу сайта-донора

	$document = phpQuery::newDocument($data_site);

  if (!empty($parent_elem)) {
    $content_prev = $document->find($parent_elem)->find($item);
  } else {
    $content_prev = $document->find($item);
  }

	// перебираем в цикле все посты
	foreach($content_prev as $el) {
    // Сбрасываем все значения на всякий случай
    $title = null;
    $img = null;
    $link = null;
    $article_text = null;

		// Парсим превьюшки статей
		$pq = pq($el); // pq это аналог $ в jQuery
		$title = trim(strip_tags($pq->find($prev_title))); // парсим заголовок статьи


		if ($if_decode) {
			//$title = utf8_decode($title);
      $title = iconv('windows-1251', 'utf-8', $title);
		}

		$link = $pq->find($prev_link)->attr('href'); // парсим ссылку на статью
    if (empty($link)) $link = $pq->find($prev_link)->attr('data-url');
    if ($link[0] != 'h') $link = $host . $link; // Если путь относительный, добавляем хост

    if ((isHaveText($link, 'https://ru.tsn.ua/vypusky')) or (isHaveText($link, 'https://ru.tsn.ua/foto'))) $link = null;

    // Парсим изображение, если есть
		if (!empty($prev_img)) {
      $img = $pq->find($prev_img)->attr('data-original');

      if (empty($img)) {
        $img = $pq->find($prev_img)->attr('src');
      }
    }

		if (!empty(trim($title))) {

			$havePost = R::count("posts", "title like ?", [$title]);

			if (!(bool)$havePost) {

				// пробегаемся по всем ссылкам на посты и парсим контент из открытых статей
				if (!empty($link)) $data_link = file_get_contents($link);
				$document_с = phpQuery::newDocument($data_link);
				$content = $document_с->find('body');

				foreach($content as $element) {
					$pq2 = pq($element);

          if (isset($date)) {
            // Разбиваем строку на массив
            $datePropsArray = explode("|", $date);
            $date_tag = $datePropsArray[0];
            $date_attr = $datePropsArray[1];
            $news_date = formatDate(trim($pq2->find($date_tag)->attr($date_attr)));
          }
            elseif (($host == 'https://www.vesti.ru'))  $news_date = formatDate(GetJsonDate($data_link));
            elseif ($host == 'https://cryptofeed.ru') $news_date = formatDate(trim(strip_tags($pq2->find('div.an-display-time')->html())));
          if (empty($news_date)) $news_date = date("Y-m-d");;

					if ($host == 'https://ria.ru') {
						$pq2->find('div.article__media')->replaceWith('');
						$pq2->find('div.article__article')->replaceWith('');
					}

          if ($host == 'https://ru.tsn.ua') {
						$pq2->find('aside.c-read-more')->replaceWith('');
            $pq2->find('div.c-video-embed')->replaceWith('');
					}

          if (isHaveText($host, 'aif.ru')) {
						$pq2->find('div.cont_inject')->replaceWith('');
            $pq2->find('div.adv_content')->replaceWith('');
					}

          if ($host == 'https://vz.ru') {
						$pq2->find('div#related')->replaceWith('');
					}

          if ($host == 'https://iz.ru') {
						$pq2->find('div.more_style_one')->replaceWith('');
            $pq2->find('div.more_style_three')->replaceWith('');
					}

          if ($host == 'https://tass.ru') {
						$pq2->find('div.text-include-aside__container')->replaceWith('');
					}

					if ($host == 'https://kp.ru') {
						$pq2->find('div.video')->replaceWith('');
					}

					$article_text = $pq2->find($post_text); // парсим контент часть статьи

					if (!empty($post_image) && (empty($img))) {
            // Если Lazy Load
            $img = $pq2->find($post_image)->attr('data-src');

            // Если не Lazy Load
            if (empty($img)) {
              $img = $pq2->find($post_image)->attr('src'); // парсим контент часть статьи
            }
					}

          if (!empty($img)) {
            if (($img[0] != 'h') and ($img[1] != '/')) $img = $host . $img; // Если путь относительный, добавляем хост
          }

          if ($host == 'https://life.ru') {
            $pq2->find('figure.figure')->replaceWith('');
          }

          if ($host == 'https://www.vedomosti.ru') {
						// В ведомостях идёт вывод нескольких новостей с одним и тем же тегом. Убираем первый, остальное вырезаем
						$article_text = str_replace_once('b-news-item__text_one', '', $article_text);
						$article_text = str_replace_once('b-news-item__text b-news-item__text_one ', '', $article_text);
						$article_text = strstr($article_text, '<div class="speech_kit__text-', true);

          }

          if (($img == 'https://ria.ru') || ($img == 'https://www.rbc.ru/crypto/') || ($img == 'https://www.vedomosti.ru')) {
            $img = null;
          }

          if ($host == 'https://cryptofeed.ru') {
            $article_text = str_replace("Простая форма подписки MailerLite!", "", $article_text);
            $article_text = str_replace("Вы успешно подписались на рассылку!", "", $article_text);
          }

          if ($host == 'https://www.rbc.ru/crypto/') {
						$article_text = str_replace("<p><strong>Больше новостей о криптовалютах вы найдете в нашем телеграм-канале РБК-Крипто.</strong></p>	", "", $article_text);
            $article_text = str_replace("<p><strong>Больше новостей о криптовалютах вы найдете в нашем телеграм-канале  РБК-Крипто .</strong></p>", "", $article_text);
          }

          if ($host == 'https://korrespondent.net') {
            $article_text = str_replace('<em>Новости от<span style="color:#ff0000;"><strong> Корреспондент.net </strong></span>в Telegram. Подписывайтесь на наш канал <a href="https://t.me/korrespondentnet">https://t.me/korrespondentnet</a></em>', '', $article_text);
          }

          if ($host == 'https://kp.ru') {
            $article_text = str_replace("Поделиться видео &lt;/&gt;", "", $article_text);
            $article_text = str_replace("xHTML-код", "", $article_text);
						$article_text = strstr($article_text, 'ЧИТАЙТЕ ТАКЖЕ', true);
          }

          if ($host == 'https://iz.ru') {
            $article_text = str_replace('src="/video/embed/', "http://iz.ru/video/embed/", $article_text);
          }

          if ($host == 'https://www.vesti.ru') {
            $article_text = str_replace('!function(e){function t(t,n){if(!(n in e)){for(var r,a=e.document,i=a.scripts,o=i.length;o--;)if(-1!==i[o].src.indexOf(t)){r=i[o];break}if(!r){r=a.createElement("script"),r.type="text/javascript",r.async=!0,r.defer=!0,r.src=t,r.charset="UTF-8";;var d=function(){var e=a.getElementsByTagName("script")[0];e.parentNode.insertBefore(r,e)};"[object Opera]"==e.opera?a.addEventListener?a.addEventListener("DOMContentLoaded",d,!1):e.attachEvent("onload",d):d()}}}t("https://top-fwz1.mail.ru/js/code.js","_tmr"),t("https://mediator.imgsmail.ru/2/mpf-mediator.min.js","_mediator")}(window);', '', $article_text);
          }

          if (($host == 'https://tass.ru') or ($host == 'https://vz.ru') or ($host == 'https://ru.tsn.ua') or ($host == 'https://eadaily.com')) {
            $img = GetOpenGraphImage($data_link);
          }

					if ($if_decode) {
            //$article_text = utf8_decode($article_text);
            $article_text = iconv('windows-1251', 'utf-8', $article_text);
          }
				}

        //echo $article_text;
        if  (!empty(trim($article_text))) {

          echo '<br /><b>Опубликована новость:</b> ' . $title . '<br />';

					// Фиксим протокол
					if (substr($img, 0, 2) == '//') {
						$img = str_replace('//', 'http://', $img);
					}

					$allow_html_tags = '<img><p><h1><td><iframe><video><picture><ol><ul><abbr><dd><code><dl><dt><kbd><s><sup><sub><strike><hr><table><th><li><h1><h2><h3><h4><h5><h6><div><form><pre><blockquote><script><span><b><i><u><strong><em>';

          // Записываем информацию о превьюшках в базу данных
          $posts = R::dispense('posts');
          if (!empty($link)) $posts->link = $link;
          if (!empty($img)) $posts->img = $img;
          if (!empty($title)) $posts->title = $title;
          if (!empty($article_text)) $posts->text = strip_tags($article_text, $allow_html_tags);
          if (!empty($category)) $posts->category = $category;
          if (!empty($news_date)) $posts->date = $news_date;
          R::store($posts);
        }
			}
		}
	}
}
?>
