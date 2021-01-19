<html>  
  <head> 
    <title>MyMail</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
	html {
		background-image: url(fon.jpg) ;
		font-size:18pt;
	}
	a{font-size:18pt;}

    </style>
  </head>  
  <body>
  	<form action="lab7.php" method="POST">
	<p>Введите заголовок:<input type="text" name="subject" /></p>
	<p><textarea rows="20" cols="70" name="text"></textarea></p>
	
	<p><input type="submit" value="Отправить" /></p>
<?php
if(isset($_POST['subject'])&&isset($_POST['text'])&&!empty($_POST['subject'])&&!empty($_POST['text']))
{
$Link = mysqli_connect('localhost', 'root', '12345','','3306');
mysqli_select_db($Link,'vicabd');
	$Link->set_charset("utf8");
$query ="SELECT * FROM emails";
$res_db = $Link->query($query);

$a = mysqli_fetch_row($res_db);
$to=$a[1];
while ($a = mysqli_fetch_row($res_db))
{
	$to.=", ".$a[1];
}
echo $to;
$subject = $_POST['subject'] ; 
$subject = '=?utf-8?B?'.base64_encode($subject).'?='; 
$message = $_POST['text'];

$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
$headers .= "From: From my syte <vikulya.poddubnaya01@mail.ru> \r\n"; 
$headers .= "Reply-To: noreply-to@example.com\r\n"; 
$headers .= "MIME-Version: 1.0\r\n";
if (mail($to, $subject, $message,$headers))
{
	echo '<meta http-equiv="refresh" content="1; URL=lab7.php">'; 
	echo 'Успешно отправлено.';
} else
{
	echo 'Не отправлено.';
} 
}else echo "Заполните все поля.";
?>
  </body>