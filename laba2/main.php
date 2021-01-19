<html>
 <head>
	<meta charset="utf-8" />
	<meta name="author" content="Буйко Виктория">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
  <title>HTML5</title>
 </head>
 <body>
 <nav>
	<?php
		$buttons = array('Главная', 'Услуги', 'Товары', 'Контакты');
		if(isset($_GET['id']))
			$id = $_GET['id'];
		else $id = 0;
	?>    
<nav>
	<?php	foreach($buttons as $key => $nav):?> 	                          
		<a href="main.php?id=<?=$key?>"  
		<?php 
		if($key == $id) echo 'class="activated"';
		else 
			echo 'class="def"'
		?>><?=$nav?></a>      
	<?php 	endforeach;?>
	
</nav>
  <form action="index.php" method="POST">
 <p>Введите произвольную строку: <input type="text" name="string" /></p>
 <p><input type="submit" /></p>
</form>
 </body>
</html>