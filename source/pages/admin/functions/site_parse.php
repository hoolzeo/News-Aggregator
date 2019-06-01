<?php
require $_SERVER['DOCUMENT_ROOT'].'/modules/libs/phpQuery/phpQuery.php';

function SiteParse($host, $item, $prev_title, $prev_link, $prev_img, $post_text, $if_decode, $post_image = null, $category = null)
{
	$data_site = file_get_contents($host); // получаем страницу сайта-донора
	$document = phpQuery::newDocument($data_site);
	$content_prev = $document->find($item);

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

		$link = $pq->find($prev_link)->attr('href'); // парсим ссылку на статью
    if (empty($link)) $link = $pq->find($prev_link)->attr('data-url');
    if ($link[0] != 'h') $link = $host . $link; // Если путь относительный, добавляем хост

    // Парсим изображение, если есть
		if (!empty($prev_img)) {
      $img = $pq->find($prev_img)->attr('data-original');

      if (empty($img)) {
        $img = $pq->find($prev_img)->attr('src');
      }
    }

		if (!empty(trim($title)) && isHaveText($link, $host)) {

			$havePost = R::count("posts", "title like ?", [$title]);

			if (!(bool)$havePost) {

				// пробегаемся по всем ссылкам на посты и парсим контент из открытых статей
				if (!empty($link)) $data_link = file_get_contents($link);
				$document_с = phpQuery::newDocument($data_link);
				$content = $document_с->find('body');
				foreach($content as $element) {
					$pq2 = pq($element);

					$article_text = $pq2->find($post_text); // парсим контент часть статьи

					if (!empty($post_image) && (empty($img))) {
            // Если Lazy Load
            $img = $pq2->find($post_image)->attr('data-src');

            // Если не Lazy Load
            if (empty($img)) {
              $img = $pq2->find($post_image)->attr('src'); // парсим контент часть статьи
            }
					}

          if (($img[0] != 'h') && ($img[1] != '/')) $img = $host . $img; // Если путь относительный, добавляем хост

          // Вырезаем ссылки из текста
          //$article_text = strip_tag($article_text, 'a');

          if ($host == 'https://bitok.blog') {
            //$article_text = strip_tag($article_text, 'img');
          }

          if (($img == 'https://ria.ru') || ($img == 'https://www.rbc.ru/crypto/') || ($img == 'https://www.vedomosti.ru')) {
            $img = null;
          }

          if ($host == 'https://cryptofeed.ru') {
            //$article_text = strip_tag($article_text, 'h2');
            //$article_text = strip_tag($article_text, 'div');
            $article_text = str_replace("Простая форма подписки MailerLite!", "", $article_text);
            $article_text = str_replace("Вы успешно подписались на рассылку!", "", $article_text);
          }

          if ($host == 'https://www.rbc.ru/crypto/') {
            $article_text = str_replace("<p><strong>Больше новостей о криптовалютах вы найдете в нашем телеграм-канале  РБК-Крипто .</strong></p>", "", $article_text);
          }

          if ($host == 'https://kp.ru') {
            $article_text = str_replace("Поделиться видео &lt;/&gt;", "", $article_text);
            $article_text = str_replace("xHTML-код", "", $article_text);
          }

          if ($host == 'https://www.vesti.ru') {
            $article_text = str_replace('!function(e){function t(t,n){if(!(n in e)){for(var r,a=e.document,i=a.scripts,o=i.length;o--;)if(-1!==i[o].src.indexOf(t)){r=i[o];break}if(!r){r=a.createElement("script"),r.type="text/javascript",r.async=!0,r.defer=!0,r.src=t,r.charset="UTF-8";;var d=function(){var e=a.getElementsByTagName("script")[0];e.parentNode.insertBefore(r,e)};"[object Opera]"==e.opera?a.addEventListener?a.addEventListener("DOMContentLoaded",d,!1):e.attachEvent("onload",d):d()}}}t("https://top-fwz1.mail.ru/js/code.js","_tmr"),t("https://mediator.imgsmail.ru/2/mpf-mediator.min.js","_mediator")}(window);', '', $article_text);
            }

					if ($if_decode) {
            $title = utf8_decode($title);
            $article_text = utf8_decode($article_text);
          }

				}

        //echo $article_text;
        if  (!empty(trim($article_text))) {

          echo '<br /><b>Опубликована новость:</b> ' . $title . '<br />';

					// Записываем информацию о превьюшках в базу данных
					$posts = R::dispense('posts');
					if (!empty($link)) $posts->link = $link;
					if (!empty($img)) $posts->img = $img;
					if (!empty($title)) $posts->title = $title;
					if (!empty($article_text)) $posts->text = strip_tags($article_text, '<p>');;
          if (!empty($category)) $posts->category = $category;
					R::store($posts);
        }
			}
		}
	}
}
?>
