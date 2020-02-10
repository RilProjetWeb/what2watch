<div class="container-general">
<?php 

$this->load->helper('form');

$attributes = ['id' => 'signinform'];

echo form_open('index.php/user/login', $attributes);

echo form_label('Identifiant (pseudo ou adresse mail)', 'user_id');
echo form_input(['name' => 'user_id', 'type' => 'text','class' => 'form-control']);

echo form_label('Mot de passe', 'user_password');
echo form_input(['name' => 'user_password','type' => 'password', 'class' => 'form-control']);

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-danger'], 'Connexion');

echo form_close();

if(isset($isError) && $isError){
	?>
		<div class="alert alert-danger" role="alert">
		Identifiant ou mot de passe incorrect
		</div>
	<?php
}

?>
</div>
