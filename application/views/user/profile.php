<article class="article-serie">
    <img class="img-serie" alt="<?php echo $objUser->getPseudo(); ?>" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>"/>
    <div class="info-serie">
        <h3 class="creator"><?php echo $objUser->getPseudo(); ?></h3>
        <h6 class="summary-serie">Nom: <?php echo $objUser->getName(); ?> </h6>
        <h6 class="summary-serie">Prénom: <?php echo $objUser->getFirstName(); ?> </h6>
        <div class="info-det-serie">
            <span class="span-info-serie-year">Mail: <?php echo $objUser->getMail(); ?> </span>
        </div>
        <div class="div-btn-end" <?php if(!isset($this->session->userdata['user_role'])||$this->session->userdata['user_id']!=substr($_SERVER['PHP_SELF'], 35)){echo "hidden";} ?>>
            <a type="button" class="btn btn-secondary" href="<?php echo base_url(); ?>index.php/User/updateUser/<?php echo $objUser->getId(); ?>">Modifier le profil</a>
            <a type="button" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/User/updateUserPassword/<?php echo $objUser->getId(); ?>">Modifier le mot de passe</a>
            <a type="button" class="btn btn-primary" href="<?php echo base_url(); ?>index.php/user/updateUserImage/<?php echo $objUser->getId(); ?>">Modifier l'image de profile</a>
        </div>
    </div>
</article>