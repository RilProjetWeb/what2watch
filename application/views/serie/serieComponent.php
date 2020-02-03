<article class="article-serie">
    <img class="img-serie" alt="<?php echo $objSerie->getName(); ?>" src="/what2watch/assets/images/<?php echo $objSerie->getImg(); ?>" />
    <div class="info-serie">
		<a class="h3 info-serie-name" href="index.php/serie/details/<?php echo $objSerie->getId(); ?>" role="button">
			<?php echo $objSerie->getName(); ?>
		</a>
        <h6 class="summary-serie"> <?php echo $objSerie->getResume(); ?> </h6>
        <div class="info-det-serie">
            <span class="span-info-serie-year"><?php echo $objSerie->getYear(); ?> </span>
            <?php
            if ($objSerie->getSrcid() == 1) { ?>
                <img class="img-src-serie" src="/what2watch/assets/images/netflix.png" />
            <?php
            } else if ($objSerie->getSrcid() == 2) { ?>
                <img class="img-src-serie" src="/what2watch/assets/images/prime_video.png" />
            <?php
            } else if ($objSerie->getSrcid() == 3) { ?>
                <img class="img-src-serie" src="/what2watch/assets/images/ocs.png" style="border-radius: 8px;" />
            <?php } ?>
            <span class="span-info-serie"><?php echo $objSerie->getCatname(); ?> </span>
            <span class="span-info-serie-age"><?php echo $objSerie->getAge(); ?>+ </span>
            <span class="span-info-serie"><?php echo $objSerie->getNbseasons(); ?> saison(s) </span>
        </div>
		<p class="span-info-serie-creator">Créé par : <a href="/what2watch/index.php/user/profile/<?php echo $objSerie->getCreator(); ?>"><?php echo $objSerie->getCreatorname(); ?></a></p>
		<?php if($objSerie->getStatus()==1) { ?>
			<div class="div-btn-actions-serie">
				<!-- TODO afficher boutons si créateur, modérateur, admin -->
				<?php if($objSerie->getCreator()==$this->session->userdata('user_id') || $this->session->userdata('user_role')==1 || $this->session->userdata('user_role')==2){ ?>
				<a class="btn btn-outline" href="/what2watch/index.php/serie/details/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">subject</i>Détails</a>
				<a class="btn btn-background" href="/what2watch/index.php/serie/editSerie/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">edit</i>Modifier</a>
				<a class="btn btn-background" href="/what2watch/index.php/serie/delete/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">delete</i></a>
				<?php } ?>
			</div>
		<?php } else {?>
			<div class="div-btn-actions-serie">
				<!-- TODO afficher boutons si créateur, modérateur, admin -->
				<a class="btn btn-outline" href="/what2watch/index.php/serie/details/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">subject</i>Détails</a>
				<a class="btn btn-outline" href="/what2watch/index.php/serie/delete/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">close</i></a>
				<a class="btn btn-background" href="/what2watch/index.php/serie/validateSerie/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">check</i></a>
			</div>
		<?php }?>
	</div>
</article>
