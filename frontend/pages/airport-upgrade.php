<?php
	global $title;
	global $separator;
	global $description;
    global $logo;
	session_start();
	
	require_once("system/includes.php");
?>
<html>
	<head>
		<title> <?php echo $title.$separator.$description; ?>  </title>
		<link rel="stylesheet" href="frontend/design/font-awesome-4.7.0/css/font-awesome.min.css">
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=latin-ext" rel="stylesheet">
		<link href="frontend/design/css/stylesheet.css" rel="stylesheet" type="text/css">
	</head>
	<body onload()>
		<div class="wrapper">
				<?php require_once("frontend/templates/header.php"); ?>
			<div class="layer">
				<div class="content">
					<h2>Index</h2>
					<p> This is the index page </p>
						<?php
							if(isset($_SESSION['loggedin']))
							{   
									//Dane do Polaczenia z baza danych /data to connection to db
									$db_server="localhost";
									$db_username="root";
									$db_password="";
									$db="mmorts";

									//Create connection/Polaczenie z baza danych
									$conn=new mysqli($db_server,$db_username,$db_password,$db);

									//Check connection /sprawdzanie polaczenia
									if($conn->connect_error)
									{
										die("Connection Failed: ".$conn->connect_error);
									}
									else
									{
										$username=$_SESSION['loggedin'];
										//Connection to Database works/ Polaczono z baza danych DODAC SEPARATOR
										$query="SELECT id FROM uzytkownicy WHERE user='$username'" ;
										$result=mysqli_query($conn,$query);
										$row=mysqli_fetch_assoc($result);

										$userId=$row['id'];

										
										$query="SELECT cash, passtart,hangar1,hangar2,hangar3,wiezakontroli FROM airport WHERE user_id='$userId'" ;
										$result=mysqli_query($conn,$query);
										$row=mysqli_fetch_assoc($result);
										//Airport Data
										$kasa=$row['cash'];
										$pas_start=$row['passtart'];
										$hangar1=$row['hangar1'];
										$hangar2=$row['hangar2'];
										$hangar3=$row['hangar3'];
										$wieza_kontroli=$row['wiezakontroli'];
										echo $kasa;


								

									}

						?>	  
								<h2> Airport </h2> 
								<div class="airport-wrapper">
									<div class="airport-menu">
										MENU
										<div class="kasa">
											Cash:<?php echo $kasa ?>
										</div>
										<ol>	
											<li><a href="index.php">Airport</a></li>
                                            <li><a href="#">Planes upgrade</a></li>
                                            <li><a href="#">inne</a></li>
                                            <li><a href="#">inne</a></li>
										</ol>
									</div>
									<div class="airport-upgrade">
										
                                            <div class="pasy_start" id="pasy_start">
												<script>
												var pas_lvl=<?php echo $pas_start;?>;
											//	var pas_lvl=<?php echo $pas_start;?>;
												var obraz="pas" + pas_lvl + ".png";
												//document.getElementById("pasy_start").innerHTML="Tak jest! Podano prawidłowe hasło: "
												document.getElementById("pasy_start").innerHTML='<img src="frontend/images/'+obraz+'"alt="" width="150" height="130"/>'	
												</script>
											</div>

											<div class="hangar1">
											</div>
											<div class="hangar2">
											</div>
											<div class="hangar3">
											</div>
											<div class="wieza_kontroli">
											</div>
											<div class="terminal">
											</div>
									</div>
								</div>
								<div style="clear:both;"></div>
								<?php
                            }
                            else
                            {
                                //HEADER DODAĆ DO INDEX.PHP
                            }
							?>
					<a href="index.php?page=index">index</a>
					<a href="index.php?page=contact">contact</a>
				</div>
			</div>
			<?php require_once("frontend/templates/footer.php"); ?>
		</div>
	</body>
</html>