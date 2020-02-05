<div class="container-general">
<?php 

$this->load->helper('form');

echo form_open('index.php/User/update');

echo form_input(['name' => 'user_id', 'type' => 'hidden','class' => 'form-control', 'value' => $objUser->getId()]);

if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_role']==1) {
	echo form_label('Pseudo', 'user_pseudo');
	echo form_input(['name' => 'user_pseudo', 'type' => 'text','class' => 'form-control', 'value' => $objUser->getPseudo()]);
}else{
	echo form_hidden(['name' => 'user_pseudo', 'type' => 'text','class' => 'form-control', 'value' => $objUser->getPseudo()]);
}

echo form_label('Nom', 'user_name');
echo form_input(['name' => 'user_name','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getName()]);

echo form_label('Prénom', 'user_firstname');
echo form_input(['name' => 'user_firstname','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getFirstName()]);

echo form_label('Adresse mail', 'user_mail');
echo form_input(['name' => 'user_mail','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getMail()]);

echo "<br>";

if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_role']==1) {
	echo form_label('Rôle à attribuer', 'user_role');
	$options = [1 => 'Administrateur',
				2 => 'Modérateur',
				3 => 'Utilisateur'];
	echo form_dropdown('user_role',$options, $objUser->getRole());
}else{
	echo form_hidden('user_role',3);
}

echo "<br>";

/**$js = 'onClick="location.href='?><?php echo $_SERVER['HTTP_REFERER']; ?>';*/



echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-secondary'], 'Valider');
//echo form_button(['name' => 'btnBack','class' => 'btn btn-primary'], 'Annuler', $js);

echo form_close();
?>
<!-- TODO -->
<!-- <a class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button">Annuler</a>
<a type="button" class="btn btn-primary" onclick="location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>'">Annuler</a> -->
</div>