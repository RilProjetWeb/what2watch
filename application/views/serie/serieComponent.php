<article class="article-serie">
    <img class="img-serie" alt="<?php echo $objSerie->getName(); ?>" src="/what2watch/assets/images/series/<?php echo $objSerie->getImg(); ?>" />
    <div class="info-serie">
		<div class="head-info-serie">
			<a class="h3 info-serie-name" href="index.php/serie/details/<?php echo $objSerie->getId(); ?>" role="button">
				<?php echo $objSerie->getName(); ?>
			</a>
			<?php
				if (isset($this->session->userdata['user_id'])) {
					if (strpos($_SERVER['PHP_SELF'], 'favorisList')!=true){
						if ($favoris==false){
							?>
							<a href="/what2watch/index.php/user/addToFavoris/<?php echo $this->session->userdata['user_id'].'/'.$objSerie->getId()?>" 
								data-toggle="tooltip" data-placement="top" title="Ajouter à ma liste !">
								<i class="material-icons">add_circle_outline</i>
							</a>
							<?php
						}else{
							?><a disabled><i class="material-icons">check</i></a><?php
						}
					}
					if (strpos($_SERVER['PHP_SELF'], 'favorisList')==true) {
						?>
						<a href="/what2watch/index.php/user/deleteFavoris/<?php echo $this->session->userdata['user_id'].'/'.$objSerie->getId()?>"
							data-toggle="tooltip" data-placement="top" title="Retier de ma liste !">
							<i class="material-icons">remove_circle_outline</i>
						</a>
						<?php
					}
				}
			?>
		</div>
        <h6 class="summary-serie"> 
			<?php echo $objSerie->getResume(); ?> 
			<?php 
				if(strlen($objSerie->getSummary())>250) {
					if (isset($this->session->userdata['user_id'])) { ?>
						<a href="" data-toggle="modal" data-target="#modalResume<?php echo $objSerie->getId(); ?>">voir plus</a> 
					<?php }
				} 
			?>
		</h6>
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
		<?php if (isset($this->session->userdata['user_id'])) { ?>
		<p class="span-info-serie-creator">Créé par : <a href="/what2watch/index.php/user/profile/<?php echo $objSerie->getCreator(); ?>"><?php echo $objSerie->getCreatorname(); ?></a></p>
		<?php } ?>
		<?php if($objSerie->getStatus()==1) { ?>
			<div class="div-btn-actions-serie">
				<?php if($objSerie->getCreator()==$this->session->userdata('user_id') || $this->session->userdata('user_role')==1 || $this->session->userdata('user_role')==2){ ?>
				<a class="btn btn-secondary" href="/what2watch/index.php/serie/editSerie/<?php echo $objSerie->getId(); ?>" role="button"><i class="material-icons">edit</i>Modifier</a>
				<a class="btn btn-primary" data-toggle="modal" data-target="#modalSuppression<?php echo $objSerie->getId(); ?>">
					<i class="material-icons">delete</i>Supprimer
				</a>
				<?php } ?>
			</div>
		<?php } else {?>
			<div class="div-btn-actions-serie">
				<a class="btn btn-primary" data-toggle="modal" data-target="#modalSuppression<?php echo $objSerie->getId(); ?>" role="button">
					<i class="material-icons">close</i>
				</a>
				<a class="btn btn-primary" href="/what2watch/index.php/serie/validateSerie/<?php echo $objSerie->getId(); ?>" role="button"
					data-toggle="tooltip" data-placement="top" title="Valider la série">
					<i class="material-icons">check</i>
				</a>
			</div>
		<?php }?>
	</div>
</article>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="modalSuppression<?php echo $objSerie->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Etes-vous sûr de supprimer la série <b><?php echo $objSerie->getName(); ?></b> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a class="btn btn-primary" href="/what2watch/index.php/serie/delete/<?php echo $objSerie->getId(); ?>" role="button">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal pour les descriptions de séries longues -->
<?php
if(strlen($objSerie->getSummary())>250){
	?>
	<div class="modal fade" id="modalResume<?php echo $objSerie->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><?php echo $objSerie->getName() ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><?php echo $objSerie->getSummary(); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
			</div>
			</div>
		</div>
	</div>
	<?php
}
?>

