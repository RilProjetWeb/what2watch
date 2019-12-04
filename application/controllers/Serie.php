<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Serie extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SerieManager_model');
	}
	
    public function index()
    {
        print_r($this->SerieManager_model->getAll());
	}
	
	public function delete($id)
	{
		$this->SerieManager_model->delete($id);
	}
}
