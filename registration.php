<?php

class Registration{

function add_user($login, $password, $pswrepeat, $mail, $name)
	{
		if (($password)==($pswrepeat)) 
		{
			$numberOfLoginRepetitions=0;
			$xml = simplexml_load_file("users.xml");

			$data= $xml->user;

				
			foreach ($data as $showlog) 
   			{
     			foreach ($showlog->login as $logins) 
     				{
       					if ($logins==$login) 
       					{
       						$numberOfLoginRepetitions+=1;	
       					}
       				}
       		}
       		if ($numberOfLoginRepetitions==0) 
       		{
       			$shifrPassword=md5($password);
       			$xml = simplexml_load_file("users.xml");
				$user=$xml->addChild('user');
 				$user->addChild('login', $login);
				$user->addChild('password', $shifrPassword);
				$user->addChild('email', $mail);
				$user->addChild('name', $name);
				$xml->asXML('users.xml');
				echo "Зарегистрирован";
       		}
       		else
       			echo "Данный логин уже существует!";
		}
		else echo"Пароли не совпадают!";
	}
}
function isAjaxRequest()
{
    if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
        return false;
    }
    return 'XMLHttpRequest' === $_SERVER['HTTP_X_REQUESTED_WITH'];
}
$user=new Registration;
if (!isAjaxRequest())
{
    exit();
}
else{
		$_COOKIE["login"] = $_REQUEST["login"];
		$_SESSION["login"] =$_REQUEST["login"] ;
		$user->add_user($_REQUEST["login"],$_REQUEST["password"],$_REQUEST["pswrepeat"],$_REQUEST["mail"],$_REQUEST["nameuser"]);
	}	 
?>