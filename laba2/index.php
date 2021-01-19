<html>
 <head>
	<meta charset="utf-8" />
	<meta name="author" content="Буйко Виктория">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
  <title>HTML5</title>
 </head>
 <body>
	<form action="index.php" method="POST">
	<p>Введите произвольную строку: <input type="text" name="string" /></p>
	<p><input type="submit" /></p>
 <aside>
	<?php
	$str = $_POST['string'];//забираем из глобального массива POST
 
foreach (explode(' ', $str) as $key => $word) { //explode разбивает строку на слова as $key => $word
    $chars = preg_split('~~u', $word, -1, 1);//разбить на буквы слово
    ! isset($chars[2]) ?: $chars[2] = "<span style='color:#800080;'>$chars[2]</span>";//2ой индекс = 3-я буква в слове. Добавляем этой букве стиль с фиолетовым цветом
    $word = join($chars);
	$tmp[] = ++$key % 3 ? $word : mb_strtoupper($word);// если 3-е слово перевести в верхний регистр 
}
 
	$str = join(' ', $tmp);//склеить массив слов пробелами
	$all = preg_match_all('~о~iu', $str);//найти О и о во всём
	
	echo $all . '<br>'; // Количество Букв "О"  и "о"
	echo $str;//вывод отредактированной строки
	?>
 </aside>
 </body>
 </html>