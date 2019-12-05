<?php 

$this->load->helper('form');

echo form_open('#', ['id' => 'frmSearchSerie']);

echo form_label('Nom de la série', 'serie_name');
echo form_input(['name' => 'serie_name', 'class' => 'form-control', 'placeholder' => 'Ex: Peaky Blinders']);

echo form_label('Année', 'serie_year');
echo form_input(['name' => 'serie_year','type' => 'number', 'class' => 'form-control', 'placeholder' => 'Ex: 2012']);

echo form_label('Nombre saison', 'serie_nbseasons');
echo form_input(['name' => 'serie_nbseasons', 'type' => 'number', 'class' => 'form-control']);

echo form_label('Age max', 'serie_age');
echo form_input(['name' => 'serie_age', 'type' => 'number', 'class' => 'form-control']);

echo form_label('Catégorie', 'serie_cat');
echo form_dropdown(['name' => 'serie_cat','class' => 'form-control'], $objCat);

echo form_label('Source', 'serie_src');
echo form_dropdown(['name' => 'serie_src','class' => 'form-control'], $objSrc, 'form-control');

echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-danger'], 'Rechercher');

echo form_close();