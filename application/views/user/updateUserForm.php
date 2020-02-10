<div class="container-general">
<?php 

$this->load->helper('form');
$this->load->helper('html');
//formulaire de saisie pour modification des informations de l'utilisateur
echo form_open_multipart('index.php/User/update');

echo form_input(['name' => 'user_id', 'type' => 'hidden','class' => 'form-control', 'value' => $objUser->getId()]);

if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_role']==1) {
	echo form_label('Pseudo', 'user_pseudo');
	echo form_input(['name' => 'user_pseudo', 'type' => 'text','class' => 'form-control', 'value' => $objUser->getPseudo()]);
}else{
	echo form_hidden('user_pseudo',$objUser->getPseudo());
}

echo form_label('Nom', 'user_name');
echo form_input(['name' => 'user_name','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getName()]);

echo form_label('Prénom', 'user_firstname');
echo form_input(['name' => 'user_firstname','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getFirstName()]);

echo form_label('Adresse mail', 'user_mail');
echo form_input(['name' => 'user_mail','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getMail()]);

if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_role']==1) {
	echo form_label('Rôle à attribuer', 'user_role');
	echo form_dropdown(['name' => 'user_role','class' => 'form-control', 'required' => 'required'], $roleOptions, $objUser->getRole());
}else{
	echo form_hidden('user_role',3);
}
?>
<div class="img-user-serie">
	<?php
	echo form_label('Modifier votre image de profile', 'user_image');
	echo form_upload(['name' => 'user_img', 'id' => 'user_img', 'class' => 'form-control-file']);
	?>
</div>
<div class="div-btn-end">
	<?php echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-secondary'], 'Valider');
   		  echo form_close();
	?>
	<a type="button" class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Annuler</a>
</div>
</div>
