<?php 

$this->load->helper('form');

echo form_open('User/create');

echo form_label('Pseudo', 'user_pseudo');
echo form_input(['name' => 'user_pseudo', 'type' => 'text','class' => 'form-control']);

echo form_label('Nom', 'user_name');
echo form_input(['name' => 'user_name','type' => 'text', 'class' => 'form-control']);

echo form_label('Prénom', 'user_firstname');
echo form_input(['name' => 'user_firstname','type' => 'text', 'class' => 'form-control']);

echo form_label('Adresse mail', 'user_mail');
echo form_input(['name' => 'user_mail','type' => 'text', 'class' => 'form-control']);

echo form_label('Mot de passe', 'user_password');
echo form_input(['name' => 'user_password','type' => 'password', 'class' => 'form-control']);

echo "<br>";

echo form_label('Rôle à attribuer', 'user_role');
$options = [1 => 'Administrateur',
			2 => 'Modérateur',
			3 => 'Utilisateur'];
echo form_dropdown('user_role',$options);

echo "<br>";

//echo form_label('Image de profile', 'user_img');
//echo form_input(['name' => 'user_img','type' => 'file', 'class' => 'form-control']);

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-success'], 'Valider');

echo form_close();