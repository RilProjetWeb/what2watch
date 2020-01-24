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
            redirect('index.php?user/');
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

        $this->load->view('footer');
	}
	
    public function userManager($srtKey){
        $objUser= new UserClass_model;
        $data= array();

        $this->load->view('header');
        $this->load->view('user/userTableHead');
        $arrUser= $this->UserManager_model->getAllUsers($srtKey);
        foreach($arrUser as $singleUser){
            $objUser->hydrate($singleUser);
            $data['objUser']=$objUser;
            $this->load->view('userList',$data);       
        }
	}
	
    public function updateUserForm($id){
        $this->load->view('header');

        $objUser = new UserClass_model;
        $data = array();
     
        $singleUser = $this->UserManager_model->getUserById($id);

        $objUser->hydrate($singleUser);
        $data['objUser'] = $objUser;
        $data['objRole'] = $this->getRoles(true);
        
        $this->load->view('user/updateUserForm', $data);
        $this->load->view('footer');
    }
    public function create(){
        if ($this->UserManager_model->createUser($_POST['user_pseudo'],$_POST['user_password'],$_POST['user_name'],$_POST['user_firstname'],$_POST['user_mail'],$_POST['user_role'])) {
            $this->userManager('ALL');
        }
    }
    public function update(){
        $this->UserManager_model->updateUser($_POST['user_id'],$_POST);
        redirect('User/userManager/ALL');
    }
    public function delete($id)
    {
        $this->UserManager_model->deleteUser($id);
        redirect('/User/userManager/ALL');
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
