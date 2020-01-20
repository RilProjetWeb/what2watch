                <tbody>
                    <tr>
                        <div>
                            <td style="padding-top: 20px;"><?php echo $objUser->getId(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getPseudo(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getName(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getFirstname(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getMail(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getRole_lib(); ?></td>
                        </div>
                        <td><img style="margin: auto; height: 50px; width: 50px;" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>"></td>
                        <td>
							<button type="button" class="btn btn-warning"><a style="color: white;" href="http://localhost/What2Watch/index.php/User/updateForm/<?php echo $objUser->getId(); ?>">modifier</a></button>
                            <button type="button" class="btn btn-danger"><a style="color: white;" href="http://localhost/What2Watch/index.php/User/delete/<?php echo $objUser->getId(); ?>">Supprimer</a></button>
                        </td>
                    </tr>   
                </tbody>