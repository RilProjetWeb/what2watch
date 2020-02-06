<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SerieManager_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

	/**
	 * Récupération des séries selon filtres et status (publié ou non)
	 */
    public function getAll()
    {
        $this->db->select("serie_id, serie_name, serie_summary, serie_year, serie_nbseasons, serie_age, serie_status, serie_catid, cat_lib AS serie_catname, serie_srcid, src_lib AS serie_srcname, user_pseudo AS serie_creatorname, serie_img, serie_creator");
        $this->db->from('serie s');
        $this->db->join('category c', 's.serie_catid=c.cat_id');
        $this->db->join('source src', 's.serie_srcid=src.src_id');
		$this->db->join('user u', 's.serie_creator=u.user_id');
		$this->db->order_by(1,'DESC');

        // Recherche par mots-clés
        if (isset($_POST['serie_name']) && $_POST['serie_name'] != '') {
            $arrKeywords = explode(" ", $_POST['serie_name']);
            foreach ($arrKeywords as $strKeyword) {
                $this->db->like('serie_name', $strKeyword);
            }
        }

        // Recherche année
        if (isset($_POST['serie_year']) && $_POST['serie_year'] != '') {
            $this->db->where('serie_year', $_POST['serie_year']);
        }

        // Recherche nb saison
        if (isset($_POST['serie_nbseasons']) && $_POST['serie_nbseasons'] != '') {
            $this->db->where('serie_nbseasons', $_POST['serie_nbseasons']);
        }

        // Recherche nb saison
        if (isset($_POST['serie_age']) && $_POST['serie_age'] != '') {
            $this->db->where('serie_age <=', $_POST['serie_age']);
        }

        // Recherche par categorie
        if (isset($_POST['serie_cat']) && $_POST['serie_cat'] != 0) {
            $this->db->where('serie_catid', $_POST['serie_cat']);
        }

        // Recherche par source
        if (isset($_POST['serie_src']) && $_POST['serie_src'] != 0) {
            $this->db->where('serie_srcid', $_POST['serie_src']);
        }
		
		// Seulement les séries validés
		$this->db->where('serie_status', 1);

        $query = $this->db->get();
        return $query->result('array');
    }

	/**
	 * Liste des catégories
	 */
    public function getCategories()
    {
        $this->db->select("*");
        $this->db->from('category');

        $query = $this->db->get();
        return $query->result('array');
    }

	/**
	 * Liste des sources/plateformes
	 */
    public function getSources()
    {
        $this->db->select("*");
        $this->db->from('source');

        $query = $this->db->get();
        return $query->result('array');
	}
	
	/**
	 * Récupération d'un série selon l'id
	 */
	public function getSerieById($id)
	{
        $this->db->select("serie_id, serie_name, serie_summary, serie_year, serie_nbseasons, serie_age, serie_status, serie_catid, cat_lib AS serie_catname, serie_srcid, src_lib AS serie_srcname, user_pseudo AS serie_creatorname, serie_img, serie_creator");
        $this->db->from('serie s');
        $this->db->join('category c', 's.serie_catid=c.cat_id');
        $this->db->join('source src', 's.serie_srcid=src.src_id');
        $this->db->join('user u', 's.serie_creator=u.user_id');
		$this->db->where('serie_id', $id);
		$query = $this->db->get();
        return $query->result('array');
	}

	/**
	 * Récupération des series de l'utilisateur connecté
	 */
	public function getMySeries($idUser)
	{
        $this->db->select("serie_id, serie_name, serie_summary, serie_year, serie_nbseasons, serie_age, serie_status, serie_catid, cat_lib AS serie_catname, serie_srcid, src_lib AS serie_srcname, user_pseudo AS serie_creatorname, serie_img, serie_creator");
        $this->db->from('serie s');
        $this->db->join('category c', 's.serie_catid=c.cat_id');
        $this->db->join('source src', 's.serie_srcid=src.src_id');
        $this->db->join('user u', 's.serie_creator=u.user_id');
		$this->db->where('serie_creator', $idUser);
		$query = $this->db->get();
        return $query->result('array');
	}	

	/**
	 * Récupération des séries à valider pour un modérateur connecté
	 */
	public function getSeriesToValidate()
	{
        $this->db->select("serie_id, serie_name, serie_summary, serie_year, serie_nbseasons, serie_age, serie_status, serie_catid, cat_lib AS serie_catname, serie_srcid, src_lib AS serie_srcname, user_pseudo AS serie_creatorname, serie_img, serie_creator");
        $this->db->from('serie s');
        $this->db->join('category c', 's.serie_catid=c.cat_id');
        $this->db->join('source src', 's.serie_srcid=src.src_id');
        $this->db->join('user u', 's.serie_creator=u.user_id');
		$this->db->where('serie_status', 0);
		$query = $this->db->get();
        return $query->result('array');
	}

	/**
	 * Validation d'une série par un modérateur
	 */
	public function validateSerie($idSerie){
		{	
			$data = array(
				'serie_status' => 1
			 );
			 
			$this->db->where('serie_id', $idSerie);
			$this->db->update('serie', $data);
		}
	}

	/**
	 * Ajout d'une série
	 */
    public function add($object)
    {
		$data = array(
			'serie_name' => $object['serie_name'],
			'serie_summary' => $object['serie_summary'],
			'serie_year' => $object['serie_year'],
			'serie_nbseasons' => $object['serie_nbseasons'],
			'serie_age' => $object['serie_age'],
			'serie_catid' => $object['serie_catid'],
			'serie_srcid' => $object['serie_srcid'],
			'serie_img' => $object['serie_img'],
			'serie_status' => 0,
			'serie_creator' => 1,
		 );

        $this->db->insert('serie', $data);
    }

	/**
	 * Mise à jour d'une série
	 */
    public function update($object)
    {	

		$data = array(
			'serie_name' => $object['serie_name'],
			'serie_summary' => $object['serie_summary'],
			'serie_year' => $object['serie_year'],
			'serie_nbseasons' => $object['serie_nbseasons'],
			'serie_age' => $object['serie_age'],
			'serie_catid' => $object['serie_catid']+1,
			'serie_srcid' => $object['serie_srcid']+1
		);

		if(isset($object["serie_img"]) && $object["serie_img"]!=""){
			$img = $object["serie_img"];
			
			$data +=  ['serie_img' => $img];
		}


		

		$this->db->where('serie_id', $object['serie_id']);
		$this->db->update('serie', $data);
    }

	/**
	 * Suppression d'un série
	 */
    public function delete($id)
    {
        $this->db->delete('serie', array('serie_id' => $id));
    }


}
