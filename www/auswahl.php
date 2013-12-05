<?php
error_reporting(E_ALL);
function printr($arg) {
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["send"])) {
	printr($_POST);
	
	$meinfeld = $_POST["inputPassword3"];
	echo $meinfeld;
}

?> 
<html>
	<head>
		<title>Auswahl</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<form name="form" method="post" action="">
			
				<div class="dropdown">
					<button class="btn dropdown-toggle sr-only" type="button" id="dropdownMenu1" data-toggle="dropdown">
						Dropdown
						<span class="caret"></span>
					</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
						</ul>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="control-label">Email</label>
				<div>
				  <input type="text" class="form-control" name="inputEmail3" id="inputEmail3" placeholder="Email">
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputPassword3" class="control-label">Password</label>
				<div>
				  <input type="password" class="form-control" name="inputPassword3" id="inputPassword3" placeholder="Password">
				</div>
			  </div>
			  <div class="form-group">
				<div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox"> Remember me
					</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div>
				  <input type="submit" name="send" class="btn btn-default">Sign in</button>
				</div>
			  </div>
			</form>
		</div>
		<a href="Service.php?ort=Bern">Serviceanzeige</a>
	</body>
</html>