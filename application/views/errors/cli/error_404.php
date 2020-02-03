<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo "\nERREUR: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";
?>

<br><button type="button" class="btn btn-warning" onclick="location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'"><a style="color: white;">Retour</a></button>