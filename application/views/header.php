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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script><nav class="navbar sticky-top navbar-expand-lg">
        <a class="navbar-brand logo" href="/what2watch/"><i class="material-icons">play_circle_filled</i>What2Watch</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="/what2watch/">Accueil</a>
							<?php if($this->session->userdata('user_id')) { ?>
								<a class="nav-link" href="/what2watch/index.php/serie/mySeries/<?php echo $this->session->userdata('user_id') ?>">Mes séries</a>
								<a class="nav-link" href="/what2watch/index.php/serie/addSerie">Ajouter une série</a>
								<a class="nav-link" href="/what2watch/index.php/serie/seriesToValidate">Séries à valider</a>
							<?php } ?>
							<?php if($this->session->userdata('user_role')==1){ echo "<a class='nav-link' href='/what2watch/index.php/user/usermanager/ALL'>Gestion des utilisateurs</a>"; } ?>
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
							<i class="material-icons">input</i>
						</a>
					<?php 
					}else{ ?>
						<a class="btn btn-background" href="/what2watch/index.php/user/signin" role="button">Connexion</a>
						<a class="btn btn-outline" href="/what2watch/index.php/user/signup" role="button">Inscription</a>
					<?php }
				?>
			</div>
        </div>
    </nav>
</head>
