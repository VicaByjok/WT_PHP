	<html>
 <head>
	<meta charset="utf-8" />
	<meta name="author" content="Buyko Victoriya">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
  <title>laba_8</title>
 </head>
 <body>


<?php

$operating_systems = array(    
	'Windows'     => '0',
	'Linux'      => '0',
    'Android'  => '0',
    'OS X'    => '0',
    'iOS'     => '0'
    );
	$operating_system = '';
    $operating_system_version = '';
	$fd = fopen("file.txt", 'r') or die("Could not open file.");
while(!feof($fd))
{		
	$keywords = preg_split("/[*]+/", fgets($fd));
	$operating_systems[$keywords[0]]=$keywords[1];
	
}
fclose($fd);

	foreach ($operating_systems as $key => $val) {	
        if (preg_match("|".preg_quote($key).".*?([a-zA-Z]?[0-9\.]+)|i", $_SERVER['HTTP_USER_AGENT'], $match)) {
           $operating_system = $key;
           $operating_system_version = $match[1];
        }
    }
echo $_SERVER['HTTP_USER_AGENT']."</br>";
echo 'Operating system: '.$operating_system.' '.$operating_system_version;
?>
<form action="a.php?do=GetOS" method="POST">
	<p><input type="submit" value="Show statistics"  style="height: 45px; margin-top:10px;background-color:#f0a3ec;"/></p>
<?php
if(!isset($_GET['do'])||empty($_GET['do'])||$_GET['do']<>'GetOS'){
$count=intval($operating_systems[$operating_system])+1;
$operating_systems[$operating_system]="$count".PHP_EOL;
	$fd = fopen("file.txt", 'w') or die("Could not open file.");
	$str='';
	foreach ($operating_systems as $key => $val) {
		$str.=$key.'*'.$val;
	}
	fwrite($fd, $str);	
	fclose($fd);
}else {
	arsort($operating_systems);
	$table='<table>';
	foreach ($operating_systems as $key => $val) {
	$table.='<tr><td>'.$key.'</td>'.'<td>'.$val.'</td></tr>';
	}
	$table.='</table>';
	echo $table;
}
?>

 </body>
 </html>