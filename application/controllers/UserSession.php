<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserSession extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('UserManager_model');
        $this->load->model('UserClass_model');
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function index(){
        
    }
        public function signIn(){
        $this->load->view('header');
        $this->load->view('signin');
        $this->load->view('footer');   
    }  
    public function signOut(){
        $this->load->view('header');
        $this->load->view('footer');
    }
	public function logIn(){
        if (!is_null($this->UserManager_model->verifUser($_POST['user_id'],$_POST['user_password']))) {
            $this->session->set_userdata('user',$_POST['user_id']);
            redirect('User/userManager/ALL');
        }else{
            echo "Erreur: identifiant ou mot de passe incorrect";
        }
    }
}
?>