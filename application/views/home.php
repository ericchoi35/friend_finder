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
	<div class='container'>
		<div class='row'>
			<h1 class='col-sm-6'>Welcome, <?= $this->session->userdata('first_name') ?>!<a href='/users/destroy' class='btn btn-default pull-right'>Log off</a></h1>
		</div>
		<div class='row'>
			<div class='col-sm-4'>
				<h3>List of friends:</h3>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>

<?php 		foreach($friends as $friend)
			{ 	?>
					<tr>
						<td><?= $friend['first_name'] ?> <?= $friend['last_name'] ?></td>
						<td><?= $friend['email'] ?></td>
					</tr>
<?php				
			}?>
					</tbody>
				</table>
			</div>
		</div>

		<div class='row'>
			<div class='col-sm-6'>
				<h3>List of users who subscribed to friend finder:</h3>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php 		foreach($non_friends as $non_friend)
			{ 	?>
					<tr>
						<td><?= $non_friend['first_name'] ?> <?= $non_friend['last_name'] ?></td>
						<td><?= $non_friend['email'] ?></td>
						<td>
							<form action='/users/add_friend' method='post'>
								<input type='hidden' name='friend_id' value="<?= $non_friend['id'] ?>">
								<input type='submit' class='btn btn-default' value='Add as friend'>
							</form>
						</td>
					</tr>
<?php		
			}	?>
<?php 		foreach($friends as $friend)
			{ 	?>
					<tr>
						<td><?= $friend['first_name'] ?> <?= $friend['last_name'] ?></td>
						<td><?= $friend['email'] ?></td>
						<td>Friends</td>
					</tr>
<?php		}	?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</body>
</html>