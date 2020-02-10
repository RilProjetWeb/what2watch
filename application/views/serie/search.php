<?php

$this->load->helper('form');

echo form_open('#', ['id' => 'frmSearchSerie']);

echo form_input(['name' => 'serie_name', 'class' => 'form-control', 'placeholder' => 'Nom', 'value' => isset($_POST['serie_name'])?$_POST['serie_name']:""]);

echo form_input(['name' => 'serie_year', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Année', 'value' => isset($_POST['serie_year'])?$_POST['serie_year']:""]);

echo form_input(['name' => 'serie_nbseasons', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Nombre de saisons', 'value' => isset($_POST['serie_nbseasons'])?$_POST['serie_nbseasons']:""]);

echo form_input(['name' => 'serie_age', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Age max', 'value' => isset($_POST['serie_age'])?$_POST['serie_age']:""]);

echo form_dropdown(['name' => 'serie_cat', 'class' => 'form-control', 'value' => isset($_POST['serie_cat'])?$_POST['serie_cat']:""], $objCat);

echo form_dropdown(['name' => 'serie_src', 'class' => 'form-control', 'value' => isset($_POST['serie_src'])?$_POST['serie_src']:""], $objSrc);

echo form_submit(['name' => 'btnSubmit', 'class' => 'btn btn-secondary'], 'Rechercher');

echo form_close();
?>
