<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo "\nERREUR: ",
	$heading,
	"\n\n",
	$message,
	"\n\n";
?>

<a type="button" class="btn btn-secondary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Retour</a>
