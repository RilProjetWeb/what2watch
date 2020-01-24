<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Serie extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SerieManager_model');
		$this->load->model('SerieClass_model');
		$this->load->view('header');
        // $this->load->library('pagination');
    }

    public function index()
    {
        // TODO pagination
        // $config['base_url'] = 'localhost/what2watch';
        // $config['total_rows'] = 13;
        // $config['per_page'] = 10;
        // $this->pagination->initialize($config);
        // echo $this->pagination->create_links();

        $arrSeries = $this->SerieManager_model->getAll();

        // Recupération des catégories et chargement de la liste d'options
		$options['objCat'] = $this->getCategories(true);

        // Recupération des sources et chargement de la liste d'options
        $options['objSrc'] = $this->getSources(true);

        $this->load->view('serie/search', $options);

        $objSerie = new SerieClass_model;
        $data = array();
        foreach ($arrSeries as $arrDetSeries) {
            $objSerie->hydrate($arrDetSeries);
            $data['objSerie'] = $objSerie;
            $this->load->view('serie/serieComponent', $data);
		}
		
		$this->load->view('footer');

    }

    public function details($id)
    {
        $arrSerieById = $this->SerieManager_model->getSerieById($id);
        $data = array();
        $objSerie = new SerieClass_model;
        $objSerie->hydrate($arrSerieById[0]);
        $data['objSerie'] = $objSerie;
		$this->load->view('serie/detailsSerieComponent', $data);
		
		$this->load->view('footer');
	}
	
	public function mySeries(){
		
	}

    public function edit($id)
    {

        $arrSerieById = $this->SerieManager_model->getSerieById($id);
        $data = array();
        $objSerie = new SerieClass_model;
        $objSerie->hydrate($arrSerieById[0]);
        $data['objSerie'] = $objSerie;
        $data['objCat'] = $this->getCategories(false);
        $data['objSrc'] = $this->getSources(false);
        $this->load->view('serie/editSerie', $data);

		$this->load->view('footer');
    }

    public function delete($id)
    {
        $this->SerieManager_model->delete($id);
    }

    public function addSerie()
    {	
		$data = array();
        $data['objCat'] = $this->getCategories(true);
        $data['objSrc'] = $this->getSources(true);
		$this->load->view('serie/addSerie', $data);
		$this->load->view('footer');
	}
	
	public function update(){
		$this->SerieManager_model->update($_POST);
		redirect('/');
	}

    public function getCategories($avecOption)
    {
        $arrCat = $this->SerieManager_model->getCategories();
        $options = array();
		if($avecOption){
			array_push($options, '--Catégorie--');
		}
        foreach ($arrCat as $category) {
            array_push($options, $category['cat_lib']);
        }
        return $options;
    }

    public function getSources($avecOption)
    {
        $arrSrc = $this->SerieManager_model->getSources();
		$options = array();
		if($avecOption){
			array_push($options, '--Source--');
		}
        foreach ($arrSrc as $source) {
            array_push($options, $source['src_lib']);
        }
        return $options;
    }
}
