<tr>
	<td><a href="/what2watch/index.php/user/profile/<?php echo $objUser->getId(); ?>"><?php echo $objUser->getPseudo(); ?></a></td>
	<td><?php echo $objUser->getName(); ?></td>
	<td><?php echo $objUser->getFirstname(); ?></td>
	<td><?php echo $objUser->getMail(); ?></td>
	<td><?php echo $objUser->getRole_lib(); ?></td>
	<td><img style="margin: auto; height: 50px; width: 50px;" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>"></td>
	<td>
		<a class="btn btn-primary" href="/what2watch/index.php/user/updateUser/<?php echo $objUser->getId(); ?>" role="button" style="margin: 3px;">
			<i class="material-icons">edit</i>
		</a>
		<a class="btn btn-primary" href="/what2watch/index.php/user/warning/suppression/<?php echo $objUser->getId(); ?>" role="button" style="margin: 3px;">
			<i class="material-icons">delete</i>
		</a>
	</td>
</tr>
