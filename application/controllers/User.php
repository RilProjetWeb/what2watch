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
    }
    public function signIn(){
        $this->load->view('header');
        $this->load->view('signin');
        $this->load->view('footer');
    }
    public function logIn($identifier,$pwd){
        if(verifUser($identifier,$pwd)){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username','Username','required')
        }
    }
    public function signOut(){
        session_destroy();
        $this->index();
    }
    public function index()
    {
        $this->load->view('header');
        // TODO pagination
        // $config['base_url'] = 'localhost/what2watch';
        // $config['total_rows'] = 13;
        // $config['per_page'] = 10;
        // $this->pagination->initialize($config);
        // echo $this->pagination->create_links();

        $arrSeries = $this->SerieManager_model->getAll();
        $objSerie = new SerieClass_model;
        $data = array();
        foreach ($arrSeries as $arrDetSeries) {
            $objSerie->hydrate($arrDetSeries);
            $data['objSerie'] = $objSerie;
            $this->load->view('serieComponent', $data);
        }

        $this->load->view('footer');
    }

    public function delete($id)
    {
        $this->SerieManager_model->delete($id);
    }
}