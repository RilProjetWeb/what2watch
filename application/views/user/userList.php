                <tbody>
                    <tr>
                        <div>
                            <td style="padding-top: 20px;"><?php echo $objUser->getId(); ?></td>
                            <td style="padding-top: 20px;"><a href="/what2watch/index.php/user/profile/<?php echo $objUser->getId();?>"><?php echo $objUser->getPseudo(); ?></a></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getName(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getFirstname(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getMail(); ?></td>
                            <td style="padding-top: 20px;"><?php echo $objUser->getRole_lib(); ?></td>
                        </div>
                        <td><img style="margin: auto; height: 50px; width: 50px;" src="/what2watch/assets/images/profile/<?php echo $objUser->getImg(); ?>"></td>
                        <td>
							<button type="button" class="btn btn-warning" onclick="location.href='<?php echo base_url(); ?>index.php/User/updateUser/<?php echo $objUser->getId(); ?>'"><a style="color: white;">modifier</a></button>
                            <button type="button" class="btn btn-danger" onclick="location.href='<?php echo base_url(); ?>index.php/User/warning/suppression/<?php echo $objUser->getId(); ?>'"><a style="color: white;">Supprimer</a></button>
                        </td>
                    </tr>   
                </tbody>