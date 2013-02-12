<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<base href="http://localhost:8888/itb" />
</head>
<body>
	<form action="http://localhost:8888/itb/user/new" method="POST">
		<label>Pseudo</label>
		<input type="text" name="pseudo" />
		<label>Email</label>
		<input type="text" name="email" />
		<label>Password</label>
		<input type="password" name="password" />
		<input type="submit" value="Create" /> 
	</form>
</body>
</html>