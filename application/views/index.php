<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Register</h1>
	<?php if(isset($errors))
	{
		echo $errors;
	} 
	unset($errors);
	if(isset($success))
	{
		echo $success;	
	}
	unset($success);
	?>
	<form action="/register" method="post">
		<p>Name: <input type="text" name="name"></p>
		<p>Username: <input type="text" name="username"></p>
		<p>Email: <input type="text" name="email"></p>
		<p>Password: <input type="password" name="password"></p>
		<p>Confirm: <input type="password" name="confirm_password"></p>
		<p>D.O.B. <input type="date" name="dob"></p>
		<p><input type="submit" name="submit" value="Register"></p>
	</form>
	<h1>Login</h1>
	<form action="/login" method="post">
		<p>Username: <input type="text" name="username"></p>
		<p>Password: <input type="password" name="password"></p>
		<p><input type="submit" name="submit" value="Login"></p>
	</form>
</body>
</html>