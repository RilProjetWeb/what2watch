<div class="container-general">
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

    ?>
    <div class="div-btn-end">
	    <?php echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-secondary'], 'Valider');
   	    	  echo form_close();
	    ?>
	    <a type="button" class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Annuler</a>
    </div>
</div>