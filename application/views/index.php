<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Friend Finder App</title>
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
</head>
<body>
<div class="container">
	<div class='row'>
		<div class='col-sm-4'>
			<h1>Register</h1>
			<form role="form" action='/users/create' method='post'>
			  	<div class="form-group">
			    	<label>First Name</label>
			    	<input type="text" name="first_name" class="form-control" placeholder="Enter first name">
			  	</div>
			  	<div class="form-group">
			    	<label>Last Name</label>
			    	<input type="text" name="last_name" class="form-control" placeholder="Enter last name">
			  	</div>
			  	<div class="form-group">
			    	<label>Email address</label>
			    	<input type="email" name="email" class="form-control" placeholder="Enter email">
			  	</div>
			  	<div class="form-group">
			    	<label>Password</label>
			    	<input type="password" name="password" class="form-control" placeholder="Password">
			  	</div>
			  	<div class="form-group">
			    	<label>Confirm Password</label>
			    	<input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
			  	</div>
			  	<button type="submit" class="pull-right btn btn-default">Register</button>
			</form>
		</div>
		<div class='col-sm-4 col-sm-offset-1'>
			<h1>Login</h1>
			<form role="form" action='/users/login' method='post'>
			  	<div class="form-group">
			    	<label>Email address</label>
			    	<input type="email" name="email" class="form-control" placeholder="Enter email">
			  	</div>
			  	<div class="form-group">
			    	<label>Password</label>
			    	<input type="password" name="password" class="form-control" placeholder="Password">
			  	</div>
			  	<button type="submit" class="pull-right btn btn-default">Login</button>
			</form>
			</br>
			</br>
<?php if($this->session->flashdata('errors'))
			{	?>
			<h4><?= $this->session->flashdata('errors') ?></h4>
<?php	}	
		if($this->session->flashdata('success'))
			{	?>
			<h4><?= $this->session->flashdata('success') ?></h4>
<?php	}	?>
		</div>
	</div>
</div>
</body>
</html>