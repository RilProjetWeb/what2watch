<html>
<head>
<title>My Form</title>
</head>
<body>

<?php //echo validation_errors(); ?>

<?php //echo form_open('form'); ?>
<form method="post" action="http://localhost/What2Watch/index.php/user/logIn">
<h5>Identifiant</h5>
<input type="text" name="username" value="" size="50" />
<h5>Mot de passe</h5>
<input type="text" name="password" value="" size="50" />
<div><input type="submit" value="Submit" value="Se connecter" /></div>

</form>

</body>
</html>
