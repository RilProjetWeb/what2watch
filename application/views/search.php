<?php 

$this->load->helper('form');

echo form_open('#', ['id' => 'frmSearchSerie']);

echo form_input(['name' => 'serie_name', 'class' => 'form-control', 'placeholder' => 'Nom']);

echo form_input(['name' => 'serie_year','type' => 'number', 'class' => 'form-control', 'placeholder' => 'Année']);

echo form_input(['name' => 'serie_nbseasons', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Nb saisons']);

echo form_input(['name' => 'serie_age', 'type' => 'number', 'class' => 'form-control', 'placeholder' => 'Age max']);

echo form_dropdown(['name' => 'serie_cat','class' => 'form-control'], $objCat);

echo form_dropdown(['name' => 'serie_src','class' => 'form-control'], $objSrc);

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-danger'], 'Rechercher');

echo form_close();