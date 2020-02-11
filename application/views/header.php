<?php
	defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/what2watch/assets/styles/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
</head>
<header>
	<nav class="navbar sticky-top navbar-expand-lg">
        <a class="navbar-brand logo" href="/what2watch/"><i class="material-icons">play_circle_filled</i>What2Watch</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<?php if($this->session->userdata('user_id')) { ?>
								<a class="nav-link" href="/what2watch/">Accueil</a>
								<a class="nav-link" href="/what2watch/index.php/serie/mySeries/<?php echo $this->session->userdata('user_id') ?>">Mes séries</a>
								<a class="nav-link" href="/what2watch/index.php/serie/addSerie">Ajouter une série</a>
							<?php } ?>
							<?php 
							/** Si le rôle de l'utilsateur connecté est modérateur : afficher l'onglet "Séries à valider" */
							if($this->session->userdata('user_role')==2) { 
								?><a class='nav-link' href='/what2watch/index.php/serie/seriesToValidate'>Séries à valider</a><?php 
							} 
							if($this->session->userdata('user_id')) { ?>
								<a class='nav-link' href='/what2watch/index.php/user/favorisList/<?php echo $this->session->userdata('user_id');?>'>Ma liste</a><?php 
							} 
							/** Si le rôle de l'utilsateur connecté est administrateur : afficher l'onglet "Gestion des utilisateurs" */
							if($this->session->userdata('user_role')==1) { 
								?><a class='nav-link' href='/what2watch/index.php/user/usermanager/ALL'>Gestion des utilisateurs</a><?php 
							} ?>
						</li>
					</ul>

			<div class="div-header-right">
				<?php 
					if($this->session->userdata('user_id')){ ?>
						<a class="nav-link nav-profile" href="/what2watch/index.php/user/profile/<?php echo $this->session->userdata('user_id') ?>">
							<img class="img-profile" src="/what2watch/assets/images/profile/<?php echo $this->session->userdata('user_img') ?>" alt="" />
							<?php echo $this->session->userdata('user_pseudo') ?>
						</a>
						<a class="logo" href="/what2watch/index.php/user/signout/">
							<i class="material-icons">power_settings_new</i>
						</a>
					<?php 
					}else{ ?>
						<a class="btn btn-primary" href="/what2watch/index.php/user/signin" role="button">Connexion</a>
						<a class="btn btn-secondary" href="/what2watch/index.php/user/signup" role="button">Inscription</a>
					<?php }
				?>
			</div>
        </div>
    </nav>
</header>
