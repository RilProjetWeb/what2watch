<?php
defined('BASEPATH') or exit('No direct script access allowed');
class SerieManager_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getAll()
    {
        $this->db->select("serie_name, serie_summary, serie_year, serie_nbseasons, serie_age, serie_status, serie_catid, cat_lib AS serie_catname, serie_srcid, src_lib AS serie_srcname, user_pseudo AS serie_creatorname, serie_img");
        $this->db->from('serie s');
        $this->db->join('category c', 's.serie_catid=c.cat_id');
        $this->db->join('source src', 's.serie_srcid=src.src_id');
        $this->db->join('user u', 's.serie_creator=u.user_id');

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
        

        $query = $this->db->get();
        return $query->result('array');
    }

    public function getCategories()
    {
        $this->db->select("*");
        $this->db->from('category');

        $query = $this->db->get();
        return $query->result('array');
    }

    public function getSources()
    {
        $this->db->select("*");
        $this->db->from('source');

        $query = $this->db->get();
        return $query->result('array');
    }

    public function add($object)
    {
        $this->db->insert('serie', $object);
    }

    public function update($object)
    {
        $this->db->update($object);
    }

    public function delete($id)
    {
        $this->db->delete('serie', array('serie_id' => $id));
    }


}
