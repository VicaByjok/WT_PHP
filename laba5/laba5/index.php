<html>  
  <head> 
    <title>MyBD</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
	html {
		background-image: url(fon.jpg) ;
		font-size:18pt;
	}
	img {
		height:300px;
		width:600px;
	}
	a{font-size:18pt;}

    </style>
  </head>  
  <body>


<?php
$Months=array('1'=>"Январь",'2'=>"Февраль",'3'=>"Март",'4'=>"Апрель",'5'=>"Май",'6'=>"Июнь",'7'=>"Июль",'8'=>"Август",'9'=>"Сентябрь",'10'=>"Октябрь",'11'=>"Ноябрь",'12'=>"Декабрь");
$db = mysqli_connect('localhost', 'root', '12345','','3306');
    mysqli_select_db($db,'vicabd');
	$db->set_charset("utf8");
//Проверяем, пришел ли запрос на конкретную дату. Если нет, берем текущую дату.
if (isset($_GET['ID'])&&!empty($_GET['ID']))
{	
	$query = "SELECT * FROM sobytia WHERE ID=".$_GET['ID'];
	$res_db = $db->query($query);
	while ($a = mysqli_fetch_row($res_db))
	{
		echo "Дата: ".$a[4].'.'.$a[3].'('.intval($a[4]).' '.$Months[intval($a[3])].')'."</br>";
		echo "В данную дату произошло следующее событие:"."</br>".$a[1]."</br>";
		if (!empty($a[5])){
		echo "Картинка для данного события:"."</br>";
		echo '<img  src="http://127.0.0.1/laba5'.$a[5].'"/>'."</br>";
		}
	}
}

//Готовим запрос к БД

	
$query = "SELECT * FROM sobytia";
$res_db = $db->query($query);
echo "<table>";
echo "Календарь праздников:";
while ($a = mysqli_fetch_row($res_db))
{
	echo "<tr><td>";
	echo "<a href=\"index.php?ID=$a[0]\">$a[4].$a[3]".'('.intval($a[4]).' '.$Months[intval($a[3])].')'."</a>";
	echo "</td></tr>";
	
}

echo  "</table>";
?>
</body>
