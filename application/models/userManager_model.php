<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserManager_model extends CI_Model
{
    public function __construct(){
		$this->load->database();
	}	
	
	/**
	 * Vérifie si l'utilisateur est présent dans la bdd$
	 */
	public function verifUser($identifier,$pwd){
		//Récupération de l'utilisateur selon l'identificateur $identifier
		if ($this->getUserByIdentifier($identifier)!=null) {
			if ($this->getUserByIdentifier($identifier)->user_password===$pwd) {
				return true;
			}
		}else{
			return false;
		}
}
	
	/**
	 * Récupère tous les utilisateurs de la table user sans restrictions
	 */
	public function getAllUsers($orderBy){
	/*Récupère tous les utilisateurs de la table user sans restrictions*/
		//Requête: SELECT * FROM user;
		$this->db->Select("user.*,role_lib");
		$this->db->From("user");
		$this->db->Join("role","user_role=role_id");
		if ($orderBy!='ALL') {
			$this->db->order_by('user_'.$orderBy,'ASC');
		}
		$query=$this->db->get();
		return $query->result();
	}

	/**
	 * Récupère un utilisateur selon  l'adresse mail ou le pseudo en paramètre
	 */
	public function getUserByIdentifier($identifier){
		//Si $identifier est une chaîne de caractères..
		if (is_string($identifier)) {
			if(strpos($identifier, '@')){
				$field='mail';
			}else{
				$field='pseudo';
			}
		}
		$this->db->select("*");
		$this->db->from("user");
		$this->db->join("role","user_role=role_id");
		$this->db->where("user_".$field."='".$identifier."'");
		$query=$this->db->get()->row();
		return $query;
	}

	/**
	 * Récupère un utilisateur selon  l'identifiant en paramètre
	 */
	public function getUserById($id){
		//Requête: SELECT * FROM user WHERE user_[..]=[..];
		$this->db->select("*,role_lib");
		$this->db->from("user");
		$this->db->join("role","user_role=role_id");
		$this->db->where("user_id=".$id);
		$query=$this->db->get()->row();
		return $query;
	}

	/**
	 * Modification d'un utilisateur dans la bdd
	 */
	public function updateUser($id,$data){
		//Modification de la donnée ($data) du champs ($field), selon l'identifiant (id)
		/*Tentative de modification du champs*/
		unset($data['user_id']);
		unset($data['btnSubmit']);
		try {
			foreach($data as $field => $newData){
				$this->db->set($field,$newData);
			}
			$this->db->where("user_id",$this->getUserById($id)->user_id);
			$this->db->update("user");
			//retourner vrai si la requête est un succès
			return true;
		} catch (Exception $e) {
			//retourner faux si la requête est un échec
			return false;
		} 
	}

	/**
	 * Création d'un utilisateur de la bdd
	 */
	public function createUser($pseudo,$pwd,$name,$firstName,$mail,$role){
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
								 'user_role' => $role);
				/*Requête:
				INSERT INTO user ('user_pseudo','user_password','user_name','user_firstname','user_mail','user_role') VALUES ($pseudo,$pwd,$name,$firstName,$mail,$role)*/
				$this->db->insert('user', $data);
				//Retouner vrai en cas de succès
				return "Opération achevée avec succès: Utilisateur ajouté!";
			}catch (Exception $e) {
				//Retourner faux en cas d'échec
				return "Echec de l'opération: l'addresse mail est déjà existant!";
			}
		}else{
			//..Sinon, retourner faux.
			return false;
		}
	}

	/**
	 * Suppression d'un utilisateur dans la bdd
	 */
	public function deleteUser($id){
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
	
	/**
	 * Récupération des rôles
	 */
	public function getRoles()
    {
        $this->db->select("*");
        $this->db->from('role');

        $query = $this->db->get();
        return $query->result('array');
    }
}
