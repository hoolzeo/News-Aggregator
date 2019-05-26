<?php
// подсчет количество слов в utf строке
function str_word_count_utf8($str) {
   $a = preg_split('/\W+/u', $str, -1, PREG_SPLIT_NO_EMPTY);
   return count($a);
}

function read_time_estimate($content) {
   // очищаем содержимое от тегов
   // подсчитываем количество слов
   $word_count = str_word_count_utf8(strip_tags($content));

   // 200 - средняя скорость чтения слов в минуту
   $words_per_minute = 150;

   // время чтения статьи в минутах
   $minutes = floor($word_count / $words_per_minute);

   $seconds = floor($word_count % $words_per_minute / ($words_per_minute / 60));

   $str_minutes = ($minutes == 1) ? "мин." : "мин.";
   $str_seconds = ($seconds == 1) ? "сек." : "сек.";

   if ($minutes == 0) {
       return "{$seconds} {$str_seconds}";
   }
   else {
       return "{$minutes} {$str_minutes}";
   }
}

?>
