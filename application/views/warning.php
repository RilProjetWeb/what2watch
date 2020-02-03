<H3>Avertissement: opération d'administration majeure</H3>
<h4>Etes-vous sûr de vouloir valider l'opération suivante?</h4>
<p><?php echo $op." du profile N°".$userId." - (".$pseudo.")"; ?></p>

<?php 
	$this->load->helper('form');

	echo form_open('index.php/User/delete');
	echo form_hidden('user_id',$userId);
	echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-success'], 'Valider');
	echo form_close();
?>

<br><button type="button" class="btn btn-warning" onclick="location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'"><a style="color: white;">Annuler</a></button>