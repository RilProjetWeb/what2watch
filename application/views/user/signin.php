<?php 

$this->load->helper('form');

echo form_open('UserSession/logIn');

echo form_label('Identifiant (pseudo ou adresse mail)', 'user_id');
echo form_input(['name' => 'user_id', 'type' => 'text','class' => 'form-control']);

echo form_label('Mot de passe', 'user_password');
echo form_input(['name' => 'user_password','type' => 'password', 'class' => 'form-control']);

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-danger'], 'Connexion');

echo form_close();