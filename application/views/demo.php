<!DOCTYPE html>
<html>
<head>
	<title>CSRF Demo</title>
</head>
<body>
<form method="post">
	CSRF Token: <input type="text" name="csrf_token" value="<?php echo $csrf_token ?>"><br>
	<button type="submit" name="btnSubmit" value="submit">Submit</button>
</form>
</body>
</html>