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
    'text' => '.b-news-item__text',
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
    'short_img' => 'img',
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
    'text' => '.article__text',
    'decode' => true,
    'full_img' => '.photoview__open-info img',
    'category' => ''
  )
);


$ria_zalupa = array(
  'host' => 'https://ria.ru',
  'item' => '.cell-list__item',
  'title' => '.cell-list__item-title',
  'link' => '.cell-list__item a',
  'short_img' => '',
  'text' => '.article__text',
  'decode' => true,
  'full_img' => '.photoview__open-info img',
  'category' => ''
);



?>
