<?php
$marks = array(
  array(
    'host' => 'https://cryptofeed.ru',
    'name' => 'CryptoFeed',
    'item' => '.ex2-content',
    'title' => '.article-title a',
    'link' => '.article-title a',
    'short_img' => '',
    'text' => '.p-first-letter p',
    'decode' => false,
    'full_img' => '.di-single-thumb img',
    'category' => 'Блокчейн'
  ),
  array(
    'host' => 'https://bitok.blog',
    'name' => 'Биток Блог',
    'item' => '.feed__item',
    'title' => '.b-article h2 span',
    'link' => '.entry_content--short a',
    'short_img' => 'img',
    'text' => '.b-article',
    'decode' => false,
    'full_img' => '.b-article img',
    'category' => 'Блокчейн'
  ),
  array(
    'host' => 'https://www.rbc.ru/crypto/',
    'name' => 'РБК',
    'item' => '.item',
    'title' => '.item__title',
    'link' => '.item__link',
    'short_img' => '.item__image-wrap img',
    'text' => '.article__content p',
    'decode' => false,
    'full_img' => '.article__main-image__link img',
    'category' => 'Блокчейн'
  ),
  array(
    'host' => 'https://bloomchain.ru/blockchain-fintech/',
    'name' => 'Bloomchain',
    'item' => '.td-block-span4',
    'title' => '.entry-title a',
    'link' => '.entry-title a',
    'short_img' => '.entry-thumb',
    'text' => '.td-post-content',
    'decode' => false,
    'full_img' => '.entry-thumb img',
    'category' => 'Блокчейн'
  ),
  array(
    'host' => 'https://www.vedomosti.ru',
    'name' => 'Ведомости',
    'item' => '.b-news__item',
    'title' => '.b-news__item__title a',
    'link' => '.b-news__item__title a',
    'short_img' => '',
    'text' => '.b-news-item__text_one',
    'decode' => false,
    'full_img' => '',
    'category' => ''
  ),
  array(
    'host' => 'https://www.vesti.ru',
    'name' => 'Вести',
    'item' => '.news-wrapper .b-item',
    'title' => '.b-item__title a',
    'link' => '.b-item__title a',
    'short_img' => '.b-item__pic',
    'text' => '.article__text',
    'decode' => false,
    'full_img' => '.article__img img',
    'category' => ''
  ),
  array(
    'host' => 'https://www.vesti.ru',
    'name' => 'Вести',
    'item' => '.short-news__item',
    'title' => '.short-news__item__title a',
    'link' => '.short-news__item__title a',
    'short_img' => '',
    'text' => '.article__text',
    'decode' => false,
    'full_img' => '.article__img img',
    'category' => ''
  ),
  array(
    'host' => 'https://kp.ru',
    'name' => 'Комсомольская правда',
    'item' => '.articles .digest',
    'title' => '.digestTitle',
    'link' => 'a',
    'short_img' => '',
    'text' => '.text',
    'decode' => false,
    'full_img' => '.fullimg img',
    'category' => ''
  ),
  array(
    'host' => 'https://ria.ru',
    'name' => 'РИА Новости',
    'item' => '.floor__cell-shape',
    'title' => '.cell-main-photo__title',
    'link' => '.share',
    'short_img' => '.cell-main-photo__image img',
    'text' => '.article__body',
    'decode' => true,
    'full_img' => '.photoview__open-info img',
    'category' => ''
  ),
  array(
    'host' => 'https://ria.ru',
    'name' => 'РИА Новости',
    'item' => '.cell-list__item',
    'title' => '.cell-list__item-title',
    'link' => '.cell-list__item-link',
    'short_img' => '',
    'text' => '.article__body',
    'decode' => true,
    'full_img' => '.photoview__open-info img',
    'category' => ''
  ),
  array(
      'host' => 'https://www.belnovosti.by',
      'name' => 'Белновости',
      'item' => '.h2-right',
      'title' => 'h2 a',
      'link' => 'h2 a',
      'short_img' => '',
      'text' => '.field-item p',
      'decode' => false,
      'full_img' => '#content_image_block img',
      'category' => ''
  ),
  array(
      'host' => 'https://www.belnovosti.by',
      'name' => 'Белновости',
      'item' => '.view-content div',
      'title' => 'h4 a',
      'link' => 'h4 a',
      'short_img' => '',
      'text' => '.field-item p',
      'decode' => false,
      'full_img' => '#content_image_block img',
      'category' => ''
  ),
  array(
      'host' => 'https://korrespondent.net',
      'name' => 'Корреспондент',
      'item' => '.time-articles .article',
      'title' => '.article__title a',
      'link' => '.article__title a',
      'short_img' => '',
      'text' => '.post-item__text',
      'decode' => false,
      'full_img' => '.post-item__photo img',
      'category' => ''
  ),
  array(
      'host' => 'https://iz.ru',
      'name' => 'Известия',
      'item' => '.short-last-news__inside__list__items li',
      'title' => '.short-last-news__inside__list__item__label',
      'link' => 'a.short-last-news__inside__list__item',
      'short_img' => '',
      'text' => 'article div[itemprop="articleBody"]',
      'decode' => false,
      'full_img' => '.big_photo__img img',
      'category' => ''
  ),
  array(
      'host' => 'https://www.rbc.ru',
      'name' => 'РБК',
      'item' => '.main__feed',
      'title' => '.main__feed__title',
      'link' => 'a.main__feed__link',
      'short_img' => '',
      'text' => '.article__content p',
      'decode' => false,
      'full_img' => '.article__main-image__image',
      'category' => ''
  ),
  array(
      'host' => 'http://www.aif.ru/news',
      'name' => 'Аргументы и Факты',
      'item' => '.list_item_cont_text',
      'title' => 'h2.data_title a',
      'link' => 'h2.data_title a',
      'short_img' => '',
      'text' => '.material_content',
      'decode' => false,
      'full_img' => '.article_img img',
      'category' => ''
  ),
  array(
      'host' => 'http://www.aif.ru',
      'name' => 'Аргументы и Факты',
      'item' => '.news_item',
      'title' => 'h3.box_title',
      'link' => '.box_gradient',
      'short_img' => '',
      'text' => '.material_content',
      'decode' => false,
      'full_img' => '.article_img img',
      'category' => ''
  ),
  array(
      'host' => 'https://tass.ru',
      'name' => 'ТАСС',
      'item' => '.news-list__item',
      'title' => '.news-preview__title',
      'link' => '.news-preview_default',
      'short_img' => '',
      'text' => '.text-content',
      'decode' => false,
      'full_img' => '',
      'category' => ''
  ),
  array(
      'host' => 'https://vz.ru',
      'name' => 'Взгляд',
      'item' => '.othnews',
      'title' => 'h4 a',
      'link' => 'h4 a',
      'short_img' => '',
      'text' => '.newtext',
      'decode' => true,
      'full_img' => '',
      'category' => ''
  ),
  array(
      'host' => 'http://wek.ru',
      'name' => 'Век',
      'item' => '.o-publist__item',
      'title' => '.c-module__title a',
      'link' => '.c-module__title a',
      'short_img' => '',
      'text' => 'div[itemprop="articleBody"]',
      'decode' => false,
      'full_img' => '.c-article__image img',
      'category' => ''
  ),
  array(
      'host' => 'https://ru.tsn.ua',
      'name' => 'ТСН',
      'item' => 'article.h-entry',
      'title' => '.u-url',
      'link' => '.u-url',
      'short_img' => '',
      'text' => '.e-content',
      'decode' => false,
      'full_img' => '',
      'category' => ''
  ),
  array(
      'host' => 'https://eadaily.com',
      'name' => 'EAD',
      'item' => 'li',
      'title' => 'a',
      'link' => 'a',
      'short_img' => '',
      'text' => '.news-text-body',
      'decode' => false,
      'full_img' => '',
      'category' => ''
  ),
  array(
      'host' => 'https://eadaily.com',
      'name' => 'EAD',
      'item' => 'li',
      'title' => 'a',
      'link' => 'a',
      'short_img' => '',
      'text' => '.news-text-body',
      'decode' => false,
      'full_img' => '',
      'category' => ''
  ),
  array(
      'host' => 'https://www.interfax.ru',
      'name' => 'Интерфакс',
      'item' => '.timeline__text',
      'title' => 'h3',
      'link' => 'a',
      'short_img' => '',
      'text' => 'article p',
      'decode' => true,
      'full_img' => 'figure.inner img',
      'category' => ''
  ),
  array(
      'host' => 'https://www.interfax.ru',
      'name' => 'Интерфакс',
      'item' => '.timeline__group',
      'title' => 'h3',
      'link' => 'a',
      'short_img' => '',
      'text' => 'article p',
      'decode' => true,
      'full_img' => 'figure.inner img',
      'category' => ''
  ),
  array(
      'host' => 'https://www.interfax.ru',
      'name' => 'Интерфакс',
      'item' => '.timeline__photo',
      'title' => 'h3',
      'link' => 'a',
      'short_img' => '',
      'text' => 'article p',
      'decode' => true,
      'full_img' => 'figure.inner img',
      'category' => ''
  ),
  array(
      'host' => 'http://www.rosbalt.ru',
      'name' => 'РосБалт',
      'item' => 'li',
      'title' => 'a',
      'link' => 'a',
      'short_img' => '',
      'text' => '.newstext',
      'decode' => false,
      'full_img' => '.image-photo img',
      'category' => '',
      'parent' => 'ul.topnews-main'
  )
);

$fonatka = array( //charset
    'host' => 'https://www.fontanka.ru',
    'name' => 'Фонтанка',
    'item' => '.sb-content__item',
    'title' => '.sb-item__title ',
    'link' => '.sb-item__title ',
    'short_img' => '',
    'text' => '.m-block__text-wrapper',
    'decode' => false,
    'full_img' => '',
    'category' => ''
);

?>
