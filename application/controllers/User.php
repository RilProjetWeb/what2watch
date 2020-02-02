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
	}

	public function signin(){
        $this->load->view('header');
        $this->load->view('user/signin');
        $this->load->view('footer');
	}

	public function signup(){
        $options['objRole'] = $this->getRoles(true);

        $this->load->view('header');
        $this->load->view('user/signup', $options);
        $this->load->view('footer');
	}
	
	public function signout(){
		$this->session->sess_destroy();
		redirect('/');
    }
	
	public function login(){
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
            redirect('index.php/user/profile/'.$this->session->userdata['user_id']);
        }else{
            echo "Erreur: identifiant ou mot de passe incorrect";
        }
    }

    public function profile($id){
        $this->load->view('header');

        $objUser = new UserClass_model;
        $data = array();

        $singleUser = $this->UserManager_model->getUserById($id);
        $objUser->hydrate($singleUser);
		$data['objUser'] = $objUser;
        $this->load->view('user/profile', $data);
	}

    public function userManager($srtKey){
        if(!isset($this->session->userdata['user_id'])){
            redirect('index.php/user/signin');
        }else{
            if ($this->session->userdata['user_role']==1) {
                $objUser= new UserClass_model;
                $data= array();

                $this->load->view('header');
                $this->load->view('user/userTableHead');
                $arrUser= $this->UserManager_model->getAllUsers($srtKey);
                foreach($arrUser as $singleUser){
                    $objUser->hydrate($singleUser);
                    $data['objUser']=$objUser;
                    $this->load->view('user/userList',$data);       
                }
            }else{
                $this->load->view('header');
                $this->load->view('accessDenied');
                $this->load->view('footer');
            }
        }
	}	

    public function create(){
        if ($this->UserManager_model->createUser($_POST['user_pseudo'],$_POST['user_password'],$_POST['user_name'],$_POST['user_firstname'],$_POST['user_mail'],$_POST['user_role'])) {
            redirect('index.php/user/usermanager/ALL');
        }else{
            echo "Erreur: votre compte n'a pas peu être crée. Votre pseudo ou votre email est déjà utilisé";
        }
    }

    public function updateUser($id){
            if(isset($this->session->userdata['user_id'])&&($this->session->userdata['user_id']==$id||$this->session->userdata['user_role']==1)){
                $this->load->view('header');

                $objUser = new UserClass_model;
                $data = array();

                $singleUser = $this->UserManager_model->getUserById($id);

                $objUser->hydrate($singleUser);
                $data['objUser'] = $objUser;
                $this->load->view('user/updateUserForm', $data);
                $this->load->view('footer');
            }else{
                $this->load->view('header');
                $this->load->view('accessDenied');
                $this->load->view('footer');
            }
    }

    public function updateUserPassword($id){
        $this->load->view('header');
        $data['userId']=$id;
        $this->load->view('user/updateUserPaswordForm',$data);
        $this->load->view('footer');
    }

    public function updateUserImage($id){
        if(isset($this->session->userdata['user_id'])&&$this->session->userdata['user_id']==$id){
            $this->load->view('header');
            $data['userId']=$id;
            $this->load->view('user/changeUserImage',$data);
            $this->load->view('footer');
        }else{
            $this->load->view('header');
            $this->load->view('accessDenied');
            $this->load->view('footer');
        }
    }

    public function update(){
        $this->UserManager_model->updateUser($_POST['user_id'],$_POST);
        if (isset($this->session->userdata['user_role'])&&$this->session->userdata['user_role']==1) {
            redirect('index.php/user/usermanager/ALL');
        }else{
            redirect('index.php/User/profile/'.$_POST['user_id']);
        }
    }

    public function updatePassword(){
        $this->load->library('encryption');
        if ($this->encryption->decrypt($this->UserManager_model->getUserById($_POST['user_id'])->user_password)===$_POST['current_password']) {
            if ($_POST['user_password']!=$_POST['current_password']) {
                if ($_POST['user_password']==$_POST['confirm_password']) {
                    unset($_POST['current_password'],$_POST['confirm_password']);
                    $this->UserManager_model->updateUser($_POST['user_id'],$_POST);
                    redirect('index.php/User/profile/'.$_POST['user_id']);
                }else{
                    echo "Erreur: Le mot de passe de confirmation ne correspond pas au nouveau mot de passe!";
                }
            }else{
                echo "Erreur: Le nouveau mot de passe entré est similaire à l'ancien mot de passe!";
            }
        }else{
            echo "Erreur: L'ancien mot de passe entré est érroné!";
        }
    }

    public function delete()
    {
        $this->UserManager_model->deleteUser($_POST['user_id']);
        redirect('index.php/User/userManager/ALL');
    }

    public function warning($op, $userId){
        $this->load->view('header');
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
}
