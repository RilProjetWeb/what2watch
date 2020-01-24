<article class="article-serie">
    <img class="img-serie" alt="<?php echo $objSerie->getName(); ?>" src="/what2watch/assets/images/<?php echo $objSerie->getImg(); ?>" />
    <div class="info-serie">
        <a class="h3 info-serie-name" href="index.php/serie/details/<?php echo $objSerie->getId(); ?>" role="button"><?php echo $objSerie->getName(); ?></a></h3>
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
		<p class="span-info-serie-creator">Créé par : <?php echo $objSerie->getCreatorname(); ?></p>
		<div class="div-btn-actions-serie">
			<a class="btn btn-outline" href="index.php/serie/details/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">subject</i>Détails</a>
			<a class="btn btn-background" href="index.php/serie/edit/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">edit</i>Modifier</a>
		</div>
	</div>
</article>
