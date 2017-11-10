<?php
 global $db_server;
 global $db_username;
 global $db_password;
 global $db;

	session_start();
	if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{	
        
        /* Redirect to a different page in the current directory that was requested */
       header("location: ../../index.php");
		//exit();
	}	
	
  
  require_once "../../system/config.php";

	$polaczenie= @new mysqli($db_server, $db_username, $db_password, $db);
	
	if($polaczenie->connect_errno!=0)
	{
		echo "Error:".$polaczenie->connect_errno;
	}
	else
	{
		$login=$_POST['login'];
		$haslo=$_POST['haslo'];
		$login=htmlentities($login,ENT_QUOTES,"UTF-8");
		$sql="SELECT *FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";
		
		if($rezultat = $polaczenie->query(
			sprintf("SELECT *FROM uzytkownicy WHERE user='%s'",
			mysqli_real_escape_string($polaczenie,$login))))
		{
			$ilu_userow=$rezultat->num_rows;
			if($ilu_userow>0)
			{	
                $wiersz=$rezultat->fetch_assoc();
				if(password_verify($haslo,$wiersz['pass']))
				{
					$_SESSION['login1']=$wiersz['user'];
					$_SESSION['loggedin']=$login;
					$_SESSION['id']=$wiersz['id'];
					unset($_SESSION['blad']);
                    $rezultat->free_result();
					header("location:../../index.php?msg=login");
					 die();
					
                     
				}
				else
				{
					$_SESSION['blad']='<span style="color:red">Nieprawidlowe has�o!</span>';
			
				}	 
			}
			else
			{
				$_SESSION['blad']='<span style="color:red">Nieprawidlowy login!</span>';
		
			}	 
		}
 
 
	}

?>