<?php

class autorization
{
	function log_in($login,$password)
	{
		$numberOfLoginRepetitions=0;
		$xml = simplexml_load_file("users.xml");
		$shifrPassword=md5($password);
		$data= $xml->user;
		
		foreach ($data as $showlog) 
   		{
     		foreach ($showlog->password as $passwords) 
     		{     			
     			foreach ($showlog->login as $logins) 
     			{      	
     				if (($logins==$login)and($passwords==$shifrPassword)) 
       				{
       					$numberOfLoginRepetitions+=1;									
       				}
       				if (($logins==$login)and($passwords!=$shifrPassword)) 
       				{
       					echo "Неправильный пароль";									
       				}      							
       			}
    		}
    	}

		if ($numberOfLoginRepetitions!=0) 
		{
			$_COOKIE["login"] = $_REQUEST["login"];
			$_SESSION['login'] =$_REQUEST["login"];
			echo "Авторизован";
		}
		elseif ($numberOfLoginRepetitions==0) 
		{
			echo "Данного пользователя не существует";
		}
	}

	function isAjaxRequest()
	{
    	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']))
    	{
        	return false;
    	}
    	return 'XMLHttpRequest' === $_SERVER['HTTP_X_REQUESTED_WITH'];
	}
}
$user=new autorization;

session_start();
$_COOKIE["login"] =$_REQUEST["login"];
$_SESSION["login"] =$_REQUEST["login"];
$user->log_in($_REQUEST["login"],$_REQUEST["password"]);

?>