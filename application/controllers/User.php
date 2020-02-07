<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserManager_model');
        $this->load->model('UserClass_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->view('Header');
	}

	public function signin(){
        /*
            - Affichage d'une vue proposant un formulaire de connexion au compte d'utilisateur
        */
        $this->load->view('user/signin');
        $this->load->view('footer');
	}

	public function signup(){
        /*
            - Affichage d'une vue proposant un formulaire de création d'un compte d'utilisateur
        */
        foreach ($this->UserManager_model->getRoles() as $key => $value) {
            $data['roleOptions'][$value['role_id']]=$value['role_lib'];
        }
        $this->load->view('user/signup', $data);
        $this->load->view('footer');
	}
	
	public function signout(){
        /*
            - Deconnexion du compte d'utilisateur
        */ 
		$this->session->sess_destroy();
		redirect('/');
    }
	
	public function login(){
        /*
            - Connexion au compte d'utilisateur
        */
		if ($this->UserManager_model->verifUser($_POST['user_id'],$_POST['user_password'])) {

			$arrUser = $this->UserManager_model->getUserByIdentifier($_POST['user_id']);
			$data = array();
			$objUser = new UserClass_model;
			$objUser->hydrate($arrUser);
			$data['objUser'] = $objUser;

			$user = array(
				'user_id' => $objUser->getId(),
				'user_pseudo' => $objUser->getPseudo(),
				'user_img' => $objUser->getImg(),
				'user_role' => $objUser->getRole(),
			);

			$this->session->set_userdata($user);
            redirect('/');
        }else{
            $data=['heading'=>"Echec de l'identification",'message'=>'(Identifiant ou mot de passe incorrect)'];
            $this->load->view('errors/cli/error_404',$data);
            $this->load->view('footer');
        }
    }

    public function profile($id){
        /*
            - Affichage du profile
            - Instanciation et hydratation d'un objet User
            - Affichage de la vue
        */
        $objUser = new UserClass_model;
        $data = array();

        $singleUser = $this->UserManager_model->getUserById($id);
        $objUser->hydrate($singleUser);
		$data['objUser'] = $objUser;
        $this->load->view('user/profile', $data);
	}

    public function userManager($srtKey){
        /*
            - Affichage d'une interface de gestion des comptes
            - Instanciation et hydratation de multiples objet User
            - Affichage multiples de vues
        */
        if(!isset($this->session->userdata['user_id'])){
            redirect('index.php/user/signin');
        }else{
            if ($this->session->userdata['user_role']==1) {
                $objUser= new UserClass_model;
                $data= array();

				$this->load->view('user/userTableHead');
				$arrUser= $this->UserManager_model->getAllUsers($srtKey);
                //Affichage multiple de vues au nombre d'utilisateurs dans la base de données
                foreach($arrUser as $singleUser){
                    $objUser->hydrate($singleUser);
                    $data['objUser']=$objUser;
                    $this->load->view('user/userList',$data);       
                }
            }else{
                $this->load->view('accessDenied');
                $this->load->view('footer');
            }
        }
	}	

    public function create(){
        /*
            - Création d'un compte d'utilisateur
        */
        if ($this->UserManager_model->createUser($_POST['user_pseudo'],$_POST['user_password'],$_POST['user_name'],$_POST['user_firstname'],$_POST['user_mail'],$_POST['user_role'])) {
            redirect('index.php/user/usermanager/ALL');
        }else{
            $data=['heading'=>"Echec de la création du compte",'message'=>'(Pseudo ou mot de passe déjà utilisé)'];
            $this->load->view('errors/cli/error_404',$data);
            $this->load->view('footer');
        }
    }

    public function updateUser($id){
        /*
            - Affichage d'une vue proposant un formulaire permettant de mettre à jour les informations du compte utilisateur
        */
            if(isset($this->session->userdata['user_id'])&&($this->session->userdata['user_id']==$id||$this->session->userdata['user_role']==1)){

                $objUser = new UserClass_model;
                $data = array();

                $singleUser = $this->UserManager_model->getUserById($id);
                $objUser->hydrate($singleUser);

                foreach ($this->UserManager_model->getRoles() as $key => $value) {
                    $data['roleOptions'][$value['role_id']]=$value['role_lib'];
                }

                $data['objUser'] = $objUser;
                $this->load->view('user/updateUserForm', $data);
                $this->load->view('footer');
            }else{
                $this->load->view('accessDenied');
                $this->load->view('footer');
            }
    }

    public function updateUserPassword($id){
        /*
            - Affichage d'une vue proposant un formulaire permettant de mettre à jour le mot de passe du compte utilisateur
        */
        $data['userId']=$id;
        $this->load->view('user/updateUserPaswordForm',$data);
        $this->load->view('footer');
    }

    public function updateUserImage($id){
        /*
            - Mise à jour de l'image de profile du compte d'utilisateur
        */
        if(isset($this->session->userdata['user_id'])&&$this->session->userdata['user_id']==$id){
            $data['userId']=$id;
            $this->load->view('user/changeUserImage',$data);
            $this->load->view('footer');
        }else{
            $this->load->view('accessDenied');
            $this->load->view('footer');
        }
    }

    public function update(){
        /*
            - Mise à jour des informations du compte utilisateur
        */
        $this->UserManager_model->updateUser($_POST['user_id'],$_POST);
        if (isset($this->session->userdata['user_role'])&&$this->session->userdata['user_role']==1) {
            redirect('index.php/user/usermanager/ALL');
        }else{
            redirect('index.php/User/profile/'.$_POST['user_id']);
        }
    }

    public function updatePassword(){
        /*
            - Mise à jour du mot de passe du compte d'utilisateur
        */
        $this->load->library('encryption');
        if ($this->encryption->decrypt($this->UserManager_model->getUserById($_POST['user_id'])->user_password)===$_POST['current_password']) {
            if ($_POST['user_password']!=$_POST['current_password']) {
                if ($_POST['user_password']==$_POST['confirm_password']) {
                    unset($_POST['current_password'],$_POST['confirm_password']);
                    $this->UserManager_model->updateUser($_POST['user_id'],$_POST);
                    redirect('index.php/User/profile/'.$_POST['user_id']);
                }else{
                    $data=['heading'=>"Echec du changement de mot de passe",'message'=>'(Le mot de passe de confirmation ne correspond pas au nouveau mot de passe!)'];
                    $this->load->view('errors/cli/error_404',$data);
                    $this->load->view('footer');
                }
            }else{
                $data=['heading'=>"Echec du changement de mot de passe",'message'=>"(Le nouveau mot de passe entré est similaire à l'ancien mot de passe!)"];
                $this->load->view('errors/cli/error_404',$data);
                $this->load->view('footer');
            }
        }else{
            $data=['heading'=>"Echec du changement de mot de passe",'message'=>"(L'ancien mot de passe entré est érroné!)"];
            $this->load->view('errors/cli/error_404',$data);
            $this->load->view('footer');
        }
    }

    public function delete()
    {
        /*
            - Suppression du compte d'utilisateur
        */
        $this->UserManager_model->deleteFavorisByid('user_id',$_POST['user_id']);
        $this->UserManager_model->deleteUser($_POST['user_id']);
        redirect('index.php/User/userManager/ALL');
    }

    public function warning($op, $userId){
        /*
            - Affichage d'une vue avertissant l'utilisateur avant une opération majeur de gestion de données
        */
        $data=['op'=>$op, 'userId'=>$userId, 'pseudo'=>$this->UserManager_model->getUserById($userId)->user_pseudo]; 

        $this->load->view('warning',$data);
        $this->load->view('footer');
    }

    public function getRoles($avecOption)
    {
        $arrRoles = $this->UserManager_model->getRoles();
        $options = array();
		if($avecOption){
			array_push($options, '-- Rôle --');
		}
        foreach ($arrRoles as $role) {
            array_push($options, $role['role_lib']);
        }
        return $options;
    }

    public function favorisList($userId)
    {
        /*
            - Affichage multiple d'une liste de series favoris, choisies précédemment par l'utilisateur 
        */
        $this->load->model('SerieManager_model');
        $this->load->model('SerieClass_model');
        if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_id']==$userId) {

            $objSerie = new SerieClass_model;
            $data = array();

            foreach ($this->UserManager_model->getFavorisByUser($userId) as $singleFavoris) {
                $objSerie->hydrate($this->SerieManager_model->getSerieById($singleFavoris->serie_id)[0]);
                $data['objSerie'] = $objSerie;
                if (empty($this->UserManager_model->getFavorisByUserAndSerie($singleFavoris->user_id,$singleFavoris->serie_id))) {
                    $data['favoris']=false;
                }else{
                    $data['favoris']=true;
                }
                $this->load->view('serie/serieComponent', $data);
            }
        }else{
            $this->load->view('accessDenied');
        }
        $this->load->view('footer');
    }
    public function addToFavoris($userId,$serieId){
        /*
            - Ajout d'une série choisie par l'utilisateur en favoris
        */
        if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_id']==$userId) {
            if ($this->UserManager_model->addFavoris($userId,$serieId)) {
                redirect('index.php/User/favorisList/'.$this->session->userdata['user_id']);
            }else{

            }
        }else{
            $this->load->view('accessDenied');
            $this->load->view('footer');
        }
    }
    public function deleteFavoris($userId,$serieId){
        /*
            - Suppression d'une série choisie par l'utilisateur en favoris
        */
        if (isset($this->session->userdata['user_id'])&&$this->session->userdata['user_id']==$userId) {
            $this->UserManager_model->deleteFavorisByIds($userId,$serieId);
            redirect('index.php/User/favorisList/'.$this->session->userdata['user_id']);
        }else{
            $this->load->view('accessDenied');
            $this->load->view('footer');
        }
    }
}