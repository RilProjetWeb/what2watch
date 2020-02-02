<?php 
$this->load->helper('form');

echo form_open('index.php/User/updatePassword');

echo form_hidden('user_id',$userId);

echo form_label('Ancien mot de passe', 'current_password');
echo form_input(['name' => 'current_password', 'type' => 'password','class' => 'form-control']);

echo form_label('Nouveau mot de passe', 'user_password');
echo form_input(['name' => 'user_password','type' => 'password', 'class' => 'form-control']);

echo form_label('Confirmation du nouveau mot de passe', 'confirm_password');
echo form_input(['name' => 'confirm_password','type' => 'password', 'class' => 'form-control']);

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-success'], 'Valider');

echo form_close();
?>

<br><button type="button" class="btn btn-warning" onclick="location.href='<?php echo base_url(); ?>index.php/User/userManager/ALL'"><a style="color: white;">Annuler</a></button>