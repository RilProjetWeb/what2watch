<?php

$this->load->helper('form');
$this->load->helper('html');

echo form_open('index.php/serie/update', ['id' => 'frmEditSerie']);

echo form_hidden('serie_id', $objSerie->getId());

?>
<div class="img-edit-serie">
	<?php
	$imageProperties = [
		'src'    => '/assets/images/' . $objSerie->getImg(),
		'class'  => 'img-serie',
	];
	echo img($imageProperties);
	echo form_upload(['name' => 'serie_img', 'class' => 'form-control-file', 'value' => $objSerie->getImg()]);
	?>
</div>

<?php
echo form_input(['name' => 'serie_name', 'class' => 'form-control', 'placeholder' => 'Nom', 'value' => $objSerie->getName(), 'required' => 'required']);

echo form_textarea(['name' => 'serie_summary', 'class' => 'form-control', 'placeholder' => 'Description', 'value' => $objSerie->getSummary(), 'required' => 'required']);

echo form_input(['name' => 'serie_year', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Année', 'value' => $objSerie->getYear(), 'required' => 'required']);

echo form_input(['name' => 'serie_nbseasons', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Nb saisons', 'value' => $objSerie->getNbseasons(), 'required' => 'required']);

echo form_input(['name' => 'serie_age', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Age max', 'value' => $objSerie->getAge(), 'required' => 'required']);

echo form_dropdown(['name' => 'serie_catid', 'class' => 'form-control', 'required' => 'required'], $objCat, $objSerie->getCatId() - 1);

echo form_dropdown(['name' => 'serie_srcid', 'class' => 'form-control', 'required' => 'required'], $objSrc, $objSerie->getSrcId() - 1);

?>
<div class="div-btn-end">
	<?php echo form_submit(['name' => 'btnSubmit', 'class' => 'btn btn-secondary'], 'Valider');
	echo form_close();
	?>
	<a type="button" class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Annuler</a>
</div>