<?php session_destroy() ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.3">
<title>Login :)</title>
</head>
<body>
<link href="styles/dashboard.css" rel="stylesheet"/>
  <form action="trylogin.php" method = "post">
        <label for="username">Username:</label> <input type="text" id="username" name="username"><br /><br />
        <label for="password">Password:</label> <input type="text" id="password" name="password"><br /><br />
        <input type = "submit" name ="login" value="login" id="login"></input>
	<input type = "submit" name="register" value="register" id="register"></input>
  </form>
</body>
</html>
