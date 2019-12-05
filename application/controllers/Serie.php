<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Serie extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SerieManager_model');
        $this->load->model('SerieClass_model');
        // $this->load->library('pagination');

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
        $arrCat = $this->SerieManager_model->getCategories();
        $arrSrc = $this->SerieManager_model->getSources();

        // Recupération des catégories et chargement de la liste d'options
        $options['objCat']  = array();
        array_push($options['objCat'], '--');
        foreach ($arrCat as $category) {
            array_push($options['objCat'], $category['cat_lib']);
        }

        // Recupération des sources et chargement de la liste d'options
        $options['objSrc']  = array();
        array_push($options['objSrc'], '--');
        foreach ($arrSrc as $source) {
            array_push($options['objSrc'], $source['src_lib']);
        }

        $this->load->view('search', $options);

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
