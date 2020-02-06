<div class="container-general">
<?php
	echo form_open('index.php/User/update');
	
	echo form_hidden('user_id',$userId);
	
	echo "	<table class='table table-bordered'>
				<tr>
					<td>".form_radio('user_img','Spacers_Choice_Logo.png','checked')."<img style='margin: auto; height: 150px; width: 180px' src='/what2watch/assets/images/profile/Spacers_Choice_Logo.png'>"."</td>
					<td>".form_radio('user_img','Aramid_Ballistics_Logo.png')."<img style='margin: auto; height: 150px; width: 180px' src='/what2watch/assets/images/profile/Aramid_Ballistics_Logo.png'>"."</td>
					<td>".form_radio('user_img','Auntie_Cleo_Logo.png')."<img style='margin: auto; height: 150px; width: 180px' src='/what2watch/assets/images/profile/Auntie_Cleo_Logo.png'>"."</td>
				</tr>
				<tr>
					<td>".form_radio('user_img','Odeon_Logo.png')."<img style='margin: auto; height: 150px; width: 180px' src='/what2watch/assets/images/profile/Odeon_Logo.png'>"."</td>
					<td>".form_radio('user_img','Rizzo_Logo.png')."<img style='margin: auto; height: 150px; width: 180px' src='/what2watch/assets/images/profile/Rizzo_Logo.png'>"."</td>
					<td>".form_radio('user_img','UDL_Logo.png')."<img style='margin: auto; height: 150px; width: 180px' src='/what2watch/assets/images/profile/UDL_Logo.png'>"."</td>
				</tr>
			</table>";
			
			// $table = new \CodeIgniter\View\Table();

			// $data = array(
			// 		array('Name', 'Color', 'Size'),
			// 		array('Fred', 'Blue', 'Small'),
			// 		array('Mary', 'Red', 'Large'),
			// 		array('John', 'Green', 'Medium')
			// );
			
			//echo $table->generate($data);
?>

<div class="div-btn-end">
	<?php echo form_submit(['name' => 'btnSubmit','class' => 'btn btn-secondary'], 'Valider');
   		  echo form_close();
	?>
	<a type="button" class="btn btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Annuler</a>
</div>
</div>