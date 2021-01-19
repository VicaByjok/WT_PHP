<html>  
  <head> 
    <title>MySession</title>
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
<?php
 session_start(); 
 $strout='';
 $loginmin=2;
 $passwordmin=5;
 if (isset($_GET['do'])&&!empty($_GET['do'])&&$_GET['do']=="LogOut"){
	 unset($_SESSION['login']);
	 echo '<meta http-equiv="refresh" content="0.1; URL=lab6.php">'; 
 }
  if (isset($_GET['do'])&&!empty($_GET['do'])&&$_GET['do']=="Reg"){
	if(isset($_POST['RegLogin'])&&!empty($_POST['RegLogin'])&&isset($_POST['RegPassword'])&&!empty($_POST['RegPassword'])){
		if(strlen($_POST['RegLogin'])>=$loginmin && strlen($_POST['RegPassword'])>=$passwordmin){
			$data=$_POST['RegLogin'].' '.md5($_POST['RegPassword']).PHP_EOL;
			file_put_contents("LoginsAndPasswords.txt", $data, FILE_APPEND);
		}else {echo "Логин или пароль недостаточной длинны.";}
	}else{echo "Не введены логин или пароль в поля регистрации.";}
 }
 if(isset($_SESSION['login'])&&!empty($_SESSION['login'])){
	 $strout='<form action="lab6.php?do=LogOut	" method="POST">'.PHP_EOL;
	 $strout.='<p>Приветствую, '.$_SESSION['login'].PHP_EOL;
	 $strout.='<p><input type="submit" value="Выйти"/></p>'.PHP_EOL;
 }else
{
	
$strout.='<form action="lab6.php?do=LogIn" method="POST">'.PHP_EOL;
$strout.='<p>Авторизация:</p>'.PHP_EOL;
$strout.='<p>Логин: <input type="text" name="login" /></p>'.PHP_EOL;
$strout.='<p>Пароль: <input type="text" name="password" /></p>'.PHP_EOL;
$strout.='<p><input type="submit" value="Войти" /></p>'.PHP_EOL;
$strout.='</form>';

$strout.='<form action="lab6.php?do=Reg" method="POST">'.PHP_EOL;
$strout.='<p>Регистрация:</p>'.PHP_EOL;
$strout.='<p>Логин: <input type="text" name="RegLogin" /></p>'.PHP_EOL;
$strout.='<p>Пароль: <input type="text" name="RegPassword" /></p>'.PHP_EOL;
$strout.='<p><input type="submit" value="Регистрация"/></p>'.PHP_EOL;
}
$strout.='</form>';
echo $strout;

$loginandpass=array('1'=>'Byjok '.md5('qwerty123'),'2'=>'Hank '.md5('fuckingperl'),'3'=>'ILOVEANGELINA '.md5('AngelinaSosi'));
$fd = fopen("LoginsAndPasswords.txt", 'r') or die("не удалось открыть файл");
while(!feof($fd))
{	
    $str = fgets($fd);
	$loginandpass[] = $str;
	//array_push($loginandpass,
}

if(isset($_POST['login'])&&isset($_POST['password'])&&!empty($_POST['login'])&&!empty($_POST['password'])){
if(checkpass($loginandpass)){
	$_SESSION['login'] = $_POST['login'];
	echo '<meta http-equiv="refresh" content="0.1; URL=lab6.php">'; 
}else{echo "Вы не прошли проверку логина и пароля.";}
}else{echo "Заполните все поля.";}
function checkpass($loginandpass)
{	
$loginmin=2;$passwordmin=5;
$flag=false;
if(strlen($_POST['login'])>=$loginmin && strlen($_POST['password'])>=$passwordmin){
	
	$i=1;
	while($i<=count($loginandpass)&&!$flag){
	if(is_int(strripos($loginandpass[$i],$_POST['login']))&&is_int(stripos($loginandpass[$i],md5($_POST['password']))))
	{
		$flag=true;	
	}else{$flag=false;}
	$i++;
	}
}else echo "Логин или пароль недостаточной длинны. 	";
	return $flag;
}
?>
</body>