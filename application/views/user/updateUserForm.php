<?php 

$this->load->helper('form');

echo form_open('index.php/User/update');

echo form_input(['name' => 'user_id', 'type' => 'hidden','class' => 'form-control', 'value' => $objUser->getId()]);

echo form_label('Pseudo', 'user_pseudo');
echo form_input(['name' => 'user_pseudo', 'type' => 'text','class' => 'form-control', 'value' => $objUser->getPseudo()]);

echo form_label('Nom', 'user_name');
echo form_input(['name' => 'user_name','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getName()]);

echo form_label('Prénom', 'user_firstname');
echo form_input(['name' => 'user_firstname','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getFirstName()]);

echo form_label('Adresse mail', 'user_mail');
echo form_input(['name' => 'user_mail','type' => 'text', 'class' => 'form-control', 'value' => $objUser->getMail()]);

echo "<br>";

echo form_label('Rôle à attribuer', 'user_role');
$options = [1 => 'Administrateur',
			2 => 'Modérateur',
			3 => 'Utilisateur'];
echo form_dropdown('user_role',$options, $objUser->getRole());

echo "<br>";

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-success'], 'Valider');

echo form_close();
?>

<br><button type="button" class="btn btn-warning" onclick="location.href='<?php echo base_url(); ?>index.php/User/userManager/ALL'"><a style="color: white;">Annuler</a></button>