<?php 

$this->load->helper('form');

echo form_open('index.php/serie/add', ['id' => 'frmAddSerie']);

echo form_input(['name' => 'serie_name', 'class' => 'form-control', 'placeholder' => 'Nom', 'required' => 'required']);

echo form_textarea(['name' => 'serie_summary', 'class' => 'form-control', 'placeholder' => 'Description', 'required' => 'required']);

echo form_input(['name' => 'serie_year','type' => 'number', 'class' => 'form-control', 'placeholder' => 'Année', 'required' => 'required']);

echo form_input(['name' => 'serie_nbseasons', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Nb saisons', 'required' => 'required']);

echo form_input(['name' => 'serie_age', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Age max', 'required' => 'required']);

echo form_dropdown(['name' => 'serie_catid','class' => 'form-control', 'required' => 'required'], $objCat);

echo form_dropdown(['name' => 'serie_srcid','class' => 'form-control', 'required' => 'required'], $objSrc);

echo form_upload(['name' => 'serie_img','class' => 'form-control-file', 'required' => 'required']);

?>
<div class="div-btn-end">
	<?php echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-secondary'], 'Valider');
   		  echo form_close();
	?>
	<a type="button" class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Annuler</a>
</div>
