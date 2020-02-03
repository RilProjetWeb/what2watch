<?php 

$this->load->helper('form');
$attributes = ['class' => 'container-general', 'id' => 'signupform'];

echo form_open('index.php/User/create', $attributes);

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

if(isset($this->session->userdata['user_id'])&&$this->session->userdata['user_role']==1){
	echo form_label('Rôle à attribuer', 'user_role');
	echo form_dropdown('user_role',$roleOptions,3);	
}else{
	echo form_hidden('user_role',3);
}


echo "<br>";

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-success'], 'Valider');

echo form_close();
