<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserManager_model extends CI_Model
{
    public function __construct(){
	}

	public function getAllUsers(){
	/*Récupère tous les utilisateurs de la table user sans restrictions*/
		//Requête: SELECT * FROM user;
		$this->db->Select("*");
		$this->db->From("user");
		$query=$this->db->get();
		return $query->result();
	}
	public function getUserByIdentifier($identifier){
	/*Récupère un utilisateur selon  l'adresse mail, le pseudo, ou l'identifiant en paramètre*/
		//Si $identifier est une chaîne de caractères..
		if (is_string($identifier)) {
			//Si $identifier contient un '@'..
			if(strpos($identifier, '@')){
				//Le champs ($field) 'mail' sera selectionné dans la prochaine requête.
				$field='mail';
			}else{
				//..Sinon, le champs ($field) 'pseudo' sera selectionné dans la prochaine requête.
				$field='pseudo';
			}
		}else{
			//..Sinon, le champs ($field) 'id' sera selectionné dans la prochaine requête.
			$field='id';
		}
		//Requête: SELECT * FROM user WHERE user_[..]=[..];
		$this->db->Select("*");
		$this->db->From("user");
		$this->db->where("user_".$field."='".$identifier."'");
		$query=$this->db->get()->row();
		return $query;
	}
	public function verifUser($identifier,$pwd){
	/*Vérifie si l'utilisateur est présent dans la bdd*/
			//Récupération de l'utilisateur selon l'identificateur $identifier
			$singleUser=$this->getUserByIdentifier($identifier);
			//Si le pseudo de l'utilisateur ou son adresse mail match avec celui de l'utilisateur trouvé..
			if ($identifier===(int)$singleUser->user_id||$identifier===$singleUser->user_pseudo||$identifier===$singleUser->user_mail) {
				/*Vérification du mot de passe*/
				//Si le mot de passe hashé match avec celui (hashé également) de l'utilisateur trouvé..
				if(hash('sha256',hash('sha256',$pwd))==$this->db->query('Select user_password From user Where user_id='.$singleUser->user_id)->row('user_password')){
					//retourner vrai
					return true;
				}else{
					//..Sinon, retrouner faux
					return false;
				}
			}else{
				//..Sinon, retourner faux
				return false;
			}	
	}
	public function updateUser($field,$data,$id){
	/*Modification d'un utilisateur dans la bdd*/
		//Modification de la donnée ($data) du champs ($field), selon l'identifiant (id)
		/*Tentative de modification du champs*/
		try {
			$this->db->set("user_".$field,$data);
			//ATTENTION:$id doit être un entier ici, et non une chaîne de caractère.
			$this->db->where("user_id",$this->getUserByIdentifier($id));
			$this->db->update("user");
			//retourner vrai si la requête est un succès
			return true;
		} catch (Exception $e) {
			//retourner faux si la requête est un échec
			return false;
		} 
	}
	public function createUser($pseudo,$pwd,$name,$firstName,$mail,$role,$img){
	/*Création d'un utilisateur de la bdd*/
		//Si le pseudo et le mail n'ont pas été monopolisé par un autre utilisateur..
		if (!$this->getUserByIdentifier($pseudo)&&!$this->getUserByIdentifier($mail)) {
			/*Tentative de suppression de l'enregistrement*/
			try {
				//Tableau dont les index 
				$data = array('user_pseudo' => $pseudo,
								'user_password' => hash('sha256', hash('sha256',$pwd)),
								'user_name' => $name,
								'user_firstname' => $firstName,
								'user_mail' => $mail,
								 'user_roleid' => $role,
								'user_img' => $img);
				/*Requête:
				INSERT INTO user ('user_pseudo','user_password','user_name','user_firstname','user_mail','user_roleid','user_img') VALUES ($pseudo,$pwd,$name,$firstName,$mail,$role,$img)*/
				$this->db->insert('user', $data);
				//Retouner vrai en cas de succès
				return true;
			}catch (Exception $e) {
				//Retourner faux en cas d'échec
				return false;
			}
		}else{
			//..Sinon, retourner faux.
			return false;
		}
	}
	public function deleteUser($id){
	/*Suppression d'un utilisateur dans la bdd*/
		//Tentative de suppression
		try {
			//Requête: DELETE FROM user WHERE user_id=$id;
			$this->db->where('user_id', $id);
			$this->db->delete('user');
			//Retourner vrai en cas de succès
			return true;
		}catch (Exception $e) {
			//Retrouner faux en cas d'échec
			return false;
		}	
	}
    
}
