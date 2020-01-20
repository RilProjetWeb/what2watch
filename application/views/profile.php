<article class="article-serie">
    <img class="img-serie" alt="<?php echo $objUser->getPseudo(); ?>" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>" />
    <div class="info-serie">
        <h3 class="creator"><?php echo $objUser->getPseudo(); ?></h3>
        <h6 class="summary-serie">Nom: <?php echo $objUser->getName(); ?> </h6>
        <h6 class="summary-serie">Prénom: <?php echo $objUser->getFirstName(); ?> </h6>
        <div class="info-det-serie">
            <span class="span-info-serie-year">Mail: <?php echo $objUser->getMail(); ?> </span>
        </div>
    </div>
</article>