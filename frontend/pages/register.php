<?php
	global $title;
	global $separator;
	global $description;
    global $logo;
    global $db_server;
    global $db_username;
    global $db_password;
    global $db;

    session_start();
    
        if(isset($_POST['email']))
        {
            //udana walidacja?Załóżm, że tak
            $wszystko_OK=true;
            //Sprawdz poprawność  nickname
            $nick=$_POST['nick'];
            //Sprawdzenie dlugosci nicku i znaków alfanumerycznych
            if((strlen($nick)<3)||(strlen($nick)>20))
            {
                $wszystko_OK=false;
                $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";
            }
            if(ctype_alnum($nick)==false)
            {
                $wszystko_OK=false;
                $_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
            }
            //Sprawdz poprawnosc adresu email
            $email=$_POST['email'];
            $emailB=filter_var($email,FILTER_SANITIZE_EMAIL);
    
            if ((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
            {
                $wszystko_OK=false;
                $_SESSION['e_email']="Podaj poprawny adres email";
            }
            //Sprawdz poprawność hasła
            $haslo1=$_POST['haslo1'];
            $haslo2=$_POST['haslo2'];
            if((strlen($haslo1)<8)|| (strlen($haslo1)>20))
            {
                $wszystko_OK=false;
                $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków";
            }
            if($haslo1!=$haslo2)
            {
                $wszystko_OK=false;
                $_SESSION['e_haslo']="Podane Hasla nie sa identyczne";
            }
            $haslo_hash=password_hash($haslo1,PASSWORD_DEFAULT);
            //echo $haslo_hash;exit();
    
            //Czy zaakceptowano regulamin
            if(!isset($_POST['regulamin']))
            {
                $wszystko_OK=false;
                $_SESSION['e_regulamin']="Potwierdz akceptacje regulaminu";
    
            }
    
            require_once "system/config.php";
                mysqli_report(MYSQLI_REPORT_STRICT);
            try
            {
            
                $polaczenie= @new mysqli($db_server, $db_username,$db_password, $db);
                
                    if($polaczenie->connect_errno!=0)
                    {
                        throw new Exception(mysqli_connect_errno());
                    }
                    else
                    {
                        //Czy email juz istnieje?
                        $rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
                        if(!$rezultat) throw new Exception($polaczenie->error);
                        $ile_takich_emaili=$rezultat->num_rows;
                        if($ile_takich_emaili>0)
                        {
                                $wszystko_OK=false;
                                $_SESSION['e_email']="Istnieje juz konto przypisane do tego adresu email!";
                    
    
                        }
                        
                        //Czy nick jest juz zarezerwowany?
                        $rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
                        if(!$rezultat) throw new Exception($polaczenie->error);
                        $ile_takich_nickow=$rezultat->num_rows;
                        if($ile_takich_nickow>0)
                        {
                                $wszystko_OK=false;
                                $_SESSION['e_nick']="Istnieje juz gracz o takim nicku.Wybierz inny.";
                        }
                            if($wszystko_OK==true)
                            {
                                //Hurra, Wszystkie testy zaliczone, dodajemy gracza do bazy.
                            
                                if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL,'$nick','$haslo_hash','$email')"))
                                {
                                    
                                    $_SESSION['udanarejestracja']=true;
                                    //header("location:index.php");
                                    header("location:index.php?msg=accountcreated");
                                    die();
                                   
        
    
    
                                }
                                else
                                {
                                    throw new Exception($polaczenie->error);
    
                                    
    
                                }
                            }
                        
    
                        $polaczenie->close();
    
                    }
    
    
            }
            catch(Exception $e)
            {
                echo '<span style="color:red;">Błąd servera, przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
                echo '</br>Informacja developerska: '.$e;
            }
    
    
    
            if($wszystko_OK==true)
            {
                //Hurra, Wszystkie testy zaliczone, dodajemy gracza do bazy.
                ;exit();
    
            }
    
        }
    
    
    

?>
<html>
	<head>
		<title><?php echo $title.$separator.$description; ?>  </title>
		<link rel="stylesheet" href="frontend/design/font-awesome-4.7.0/css/font-awesome.min.css">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=latin-ext" rel="stylesheet">
		<link href="frontend/design/css/stylesheet.css" rel="stylesheet" type="text/css">
        <style>
		.error
		{
			color:red;
			margin-top:10px;
			margin-bottom:10px;

		}


	</style>
		</head>
	</body>
		<div class="wrapper">
				<?php require_once("frontend/templates/header.php"); ?>
			<div class="layer">
				<div class="content">
					<h2>Register</h2>
                    <form method="post">
                    Nickname:</br> <input type="text" name="nick"/> </br>
                    <?php
                        if(isset($_SESSION['e_nick']))
                        {
                            echo'<div class="error">'.$_SESSION['e_nick'].'</div>';
                            unset($_SESSION['e_nick']);
                        }
            
                    ?>
                    E-mail:</br> <input type="text" name="email"/> </br>
                    <?php
                        if(isset($_SESSION['e_email']))
                        {
                            echo'<div class="error">'.$_SESSION['e_email'].'</div>';
                            unset($_SESSION['e_email']);
                        }
            
                    ?>
                    Twoje Haslo:</br> <input type="password" name="haslo1"/> </br>
                    <?php
                        if(isset($_SESSION['e_haslo']))
                        {
                            echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
                            unset($_SESSION['e_haslo']);
                        }
            
                    ?>
                    Powtorz Haslo:</br> <input type="password" name="haslo2"/> </br>
                    <label>
                        <input type="checkbox" name="regulamin"/> Ackeptuje Regulamin
                    </label>
                    <?php
                        if(isset($_SESSION['e_regulamin']))
                        {
                            echo'<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                            unset($_SESSION['e_regulamin']);
                        }
            
                    ?>
                    <a href="regulamin.php">Regulamin</a></br>
                    <input type="submit" value="Register"/>
                </form>
					<a href="index.php?page=index">index</a>
					<a href="index.php?page=contact">contact</a>
				</div>
			</div>
			<?php require_once("frontend/templates/footer.php"); ?>
		</div>
	</body>
</html>