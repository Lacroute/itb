<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
</head>
<body>
	<form action="" method="post">
		<label>Email</label>
		<input type="text" name="email" />
		<label>Password</label>
		<input type="password" name="password" />
		<input type="submit" value="Connect" /> 
	</form>
	<?php var_dump(F3::get('errorMsg'));?>
</body>
</html>