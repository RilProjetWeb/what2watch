<div class="profile-container">
    <img class="profile-img" alt="<?php echo $objUser->getPseudo(); ?>" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>"/>
	<h1 class="profile-pseudo"><?php echo $objUser->getPseudo(); ?></h1>
	<div class="profile-infos">
        <h5 class="profile-name"><b>Nom:</b> <?php echo $objUser->getName(); ?> </h5>
        <h5 class="profile-firstname"><b>Prénom:</b> <?php echo $objUser->getFirstName(); ?> </h5>
        <h5 class="profile-mail"><b>Mail:</b> <?php echo $objUser->getMail(); ?> </h5>
	</div>
	<div class="div-btn-profile" <?php if(!isset($this->session->userdata['user_role'])||$this->session->userdata['user_id']!=substr($_SERVER['PHP_SELF'], 35)){echo "hidden";} ?>>
            <a type="button" class="btn btn-secondary" href="<?php echo base_url(); ?>index.php/User/updateUser/<?php echo $objUser->getId(); ?>">Modifier le profil</a>
            <a type="button" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/User/updateUserPassword/<?php echo $objUser->getId(); ?>"><i class="material-icons"></i>Modifier le mot de passe</a>
			<a type="button" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/user/signout">Déconnexion</a>
    </div>
</div>
