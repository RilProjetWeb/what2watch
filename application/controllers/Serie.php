<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Serie extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('serieManager_model');
		$this->load->model('serieClass_model');
		$this->load->view('header');
		$this->load->library("pagination");
    }

    public function index()
	{
		// Configuration de la pagination
		$config = array();
        $config["base_url"] = base_url() . "index.php/serie";
        $config["total_rows"] = $this->serieManager_model->get_count();
        $config["per_page"] = 5;
        $config["uri_segment"] = 2;

		// Initialisation de la pagination
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		// On stocke les séries dans un tableau selon la limie de la pagination par page
		$arrSeries = $this->serieManager_model->getAll($config["per_page"], $page);
		
		// On enregistre les liens de la pagination pour l'envoyer à la vue
		$data["links"] = $this->pagination->create_links();

		// Page courante
		$data['page'] = "index";
	   
		// Recupération des catégories et chargement de la liste d'options
		$options['objCat'] = $this->getCategories(true);

        // Recupération des sources et chargement de la liste d'options
        $options['objSrc'] = $this->getSources(true);

		$this->load->view('serie/search', $options);
		
		$this->load->model('userManager_model');
		
		// On parcourt les séries récupérées, on hydrate un objet Série pour chacune et on charge la vue
		$objSerie = new serieClass_model;
        foreach ($arrSeries as $arrDetSeries) {
            $objSerie->hydrate($arrDetSeries);
            $data['objSerie'] = $objSerie;
            if (isset($this->session->userdata['user_id'])) {
				// On vérifie si la série est en favoris pour l'utilisateur
            	if (empty($this->userManager_model->getFavorisByUserAndSerie($this->session->userdata['user_id'],$objSerie->getId()))) {
                	$data['favoris']=false;
            	}else{
                	$data['favoris']=true;
            	}
            }
            $this->load->view('serie/serieComponent', $data);
		}

		$this->load->view('serie/paginationSerie', $data);
		$this->load->view('footer');
    }
	
	/**
	 * Page des séries de l'utilisateur connecté
	 */
	public function mySeries($idUser){
		$this->load->model('userManager_model');
		$arrMySeries = $this->serieManager_model->getMySeries($idUser);
		$arrMySeries;
		$objSerie = new serieClass_model;
		$data = array();
		$data['page'] = "mySeries";
		if($arrMySeries){
			foreach ($arrMySeries as $serie) {
				$objSerie->hydrate($serie);
				$data['objSerie'] = $objSerie;
				if (isset($this->session->userdata['user_id'])) {
					if (empty($this->userManager_model->getFavorisByUserAndSerie($this->session->userdata['user_id'],$objSerie->getId()))) {
						$data['favoris']=false;
					}else{
						$data['favoris']=true;
					}
				}
				$this->load->view('serie/serieComponent', $data);
			}
		}else{
			$this->load->view('serie/emptyMySeries');
		}
        $this->load->view('footer');
	}

	/**
	 * Page des séries à valider pour un modérateur
	 */
	public function seriesToValidate(){
		$this->load->model('userManager_model');
		$arrMySeries = $this->serieManager_model->getSeriesToValidate();
		$objSerie = new serieClass_model;
		$data = array();
		$data['page']="seriesToValidate";
		if($arrMySeries){
			foreach ($arrMySeries as $serie) {
				$objSerie->hydrate($serie);
				$data['objSerie'] = $objSerie;
				if (empty($this->userManager_model->getFavorisByUserAndSerie($this->session->userdata['user_id'],$objSerie->getId()))) {
					$data['favoris']=false;
				}else{
					$data['favoris']=true;
				}
				$this->load->view('serie/serieComponent', $data);
			}
		}else{
			$this->load->view('serie/emptySeriesToValidate');
		}
		$this->load->view('footer');
	}

	/**
	 * Page de modification d'un série avec formulaire pré-rempli
	 */
    public function editSerie($id)
    {

        $arrSerieById = $this->serieManager_model->getSerieById($id);
        $data = array();
        $objSerie = new serieClass_model;
        $objSerie->hydrate($arrSerieById[0]);
        $data['objSerie'] = $objSerie;
        $data['objCat'] = $this->getCategories(false);
        $data['objSrc'] = $this->getSources(false);
        $this->load->view('serie/editSerie', $data);

		$this->load->view('footer');
    }

	/**
	 * Page d'ajout d'une série avec formulaire vide
	 */
    public function addSerie()
    {	
		$data = array();
        $data['objCat'] = $this->getCategories(true);
        $data['objSrc'] = $this->getSources(true);
		$this->load->view('serie/addSerie', $data);
		$this->load->view('footer');
	}

	/**
	 * Validation d'une série par un modérateur
	 */
	public function validateSerie($idSerie){
		$this->serieManager_model->validateSerie($idSerie);
		redirect('/');
	}

	/**
	 * Appel à la requête d'ajout d'une série
	 */
	public function add(){
		// Insertion de la série, en envoyant les informations du formulaire et le nom de l'image
		$this->serieManager_model->add($_POST, $_FILES['serie_img']['name']);
		
		// Sauvegarde de l'image dans les assets du projet
		// On configue l'enregistrement avec le chemin de destination et les formats autorisés
		$config['upload_path'] = './assets/images/series';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $this->load->library('upload', $config);
		$this->upload->do_upload('serie_img');
		redirect('/');
	}
	
	/**
	 * Appel à la requête de mise à jour d'une série
	 */
	public function update(){
		$this->serieManager_model->update($_POST, $_FILES['serie_img']['name']);
		$config['upload_path'] = './assets/images/series';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $this->load->library('upload', $config);
		$this->upload->do_upload('serie_img');
		redirect('/');
	}

	/**
	 * Appel à la requête d'ajout d'une série
	 */
	public function delete($id)
    {
		$this->load->model('userManager_model');
    	$this->userManager_model->deleteFavorisByid('serie_id',$id);
		$this->serieManager_model->delete($id);
		redirect('/');
    }

	/**
	 * Appel à la requête de récupération des catégories
	 */
    public function getCategories($avecOption)
    {
        $arrCat = $this->serieManager_model->getCategories();
        $options = array();
		if($avecOption){
			array_push($options, '--Catégorie--');
		}
        foreach ($arrCat as $category) {
            array_push($options, $category['cat_lib']);
        }
        return $options;
    }

	/**
	 * Appel à la requête de récupération des sources/plateformes
	 */
    public function getSources($avecOption)
    {
        $arrSrc = $this->serieManager_model->getSources();
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
