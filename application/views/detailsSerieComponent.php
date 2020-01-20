<article class="article-serie">
    <img class="img-serie" alt="<?php echo $objSerie->getName(); ?>" src="/what2watch/assets/images/<?php echo $objSerie->getImg(); ?>" />
    <div class="info-serie">
        <h3 class="creator"><?php echo $objSerie->getName(); ?></h3>
        <h6 class="summary-serie"> <?php echo $objSerie->getSummary(); ?> </h6>
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
            <span class="span-info-serie"><?php echo $objSerie->getNbseasons(); ?> saisons </span>
        </div>
        <p class="span-info-serie-creator">Créé par : <?php echo $objSerie->getCreatorname(); ?></p>
    </div>
</article>
