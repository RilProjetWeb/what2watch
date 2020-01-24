<?php 

$this->load->helper('form');
$attributes = ['class' => 'container-edit', 'id' => 'signupform'];

echo form_open('User/create', $attributes);

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
echo form_dropdown(['name' => 'user_role', 'class' => 'form-control'], $objRole);


echo "<br>";

//echo form_label('Image de profile', 'user_img');
//echo form_input(['name' => 'user_img','type' => 'file', 'class' => 'form-control']);

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-success'], 'Valider');

echo form_close();