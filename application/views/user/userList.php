<tr>
	<td><a href="/what2watch/index.php/user/profile/<?php echo $objUser->getId(); ?>"><?php echo $objUser->getPseudo(); ?></a></td>
	<td><?php echo $objUser->getName(); ?></td>
	<td><?php echo $objUser->getFirstname(); ?></td>
	<td><?php echo $objUser->getMail(); ?></td>
	<td><?php echo $objUser->getRole_lib(); ?></td>
	<td><img style="margin: auto; height: 50px; width: 50px;" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>"></td>
	<td>
		<a class="btn btn-primary" href="/what2watch/index.php/user/updateUser/<?php echo $objUser->getId(); ?>" role="button" style="margin: 3px;">
			<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Modifier">edit</i>
		</a>
		<a class="btn btn-primary" data-toggle="modal" data-target="#modalSuppression<?php echo $objUser->getId(); ?>" role="button" style="margin: 3px;">
			<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Supprimer">delete</i>
		</a>
	</td>
</tr>
<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="modalSuppression<?php echo $objUser->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Supprimer un utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Etes-vous sûr de supprimer l'utilisateur <b><?php echo $objUser->getPseudo(); ?></b> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a class="btn btn-primary" href="/what2watch/index.php/user/delete/<?php echo $objUser->getId(); ?>" role="button" style="margin: 3px;">
			Supprimer
		</a>
      </div>
    </div>
  </div>
</div>
