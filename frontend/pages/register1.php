<?php
	global $title;
	global $separator;
	global $description;
	global $logo;


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
		</head>
	</body>
		<div class="wrapper">
				<?php require_once("frontend/templates/header.php"); ?>
			<div class="layer">
				<div class="content">
					<h2>Register</h2>
                    <form role="form">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" id="password"  required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail Address:</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <button type="submit" class="btn btn-default">Submit </button>
                    </form>
					<a href="index.php?page=index">index</a>
					<a href="index.php?page=contact">contact</a>
				</div>
			</div>
			<?php require_once("frontend/templates/footer.php"); ?>
		</div>
	</body>
</html>