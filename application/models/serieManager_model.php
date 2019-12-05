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
        $this->db->select("serie_name, serie_summary, serie_year, serie_nbseasons, serie_age, serie_status, cat_lib AS serie_catname, serie_srcid, src_lib AS serie_srcname, user_pseudo AS serie_creatorname, serie_img");
        $this->db->from('serie s');
		$this->db->join('category c', 's.serie_catid=c.cat_id');
		$this->db->join('source src', 's.serie_srcid=src.src_id');
		$this->db->join('user u', 's.serie_creator=u.user_id');
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
