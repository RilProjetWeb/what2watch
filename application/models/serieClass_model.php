<?php

class serie extends CI_Model
{

    private $_serie_id;
    private $_serie_name;
    private $_serie_summary;
    private $_serie_year;
    private $_serie_nbseasons;
    private $_serie_age;
    private $_serie_status;
	private $_serie_catid;
	private $_serie_catname;
	private $_serie_srcid;
	private $_serie_srcname;
	private $_serie_img;
	private $_serie_creator;
	private $_serie_creatorname;

    // Constructeur
    public function __construct()
    {

    }

    // Hydratation
    public function hydrate($arrData)
    {
        foreach ($arrData as $strAttrib => $strValue) {
            $strMethodeName = "set" . ucfirst(str_replace("serie", "", $strAttrib));
            if (method_exists($this, $strMethodeName)) {
                $this->$strMethodeName($strValue);
            }
        }
	}
	
	public function getId():int{
		return $this->_serie_id;
	}
	public function setId(int $intId){
		$this->_serie_id = $intId;
	}

	public function getName():string{
		return $this->_serie_name;
	}
	public function setName(string $strName){
		$this->_serie_name = $strName;
	}
	
	public function getSummary():string{
		return $this->_serie_summary;
	}
	public function setSummary(string $strSummary){
		$this->_serie_summary = $strSummary;
	}

	public function getYear():int{
		return $this->_serie_year;
	}
	public function setYear(int $intYear){
		$this->_serie_year = $intYear;
	}

	public function getNbseasons():int{
		return $this->_serie_nbseasons;
	}
	public function setNbseasons(int $intNbseasons){
		$this->_serie_nbseasons = $intNbseasons;
	}

	public function getAge():int{
		return $this->_serie_age;
	}
	public function setAge(int $intAge){
		$this->_serie_age = $intAge;
	}

	public function getStatus():int{
		return $this->_serie_status;
	}
	public function setStatus(int $intStatus){
		$this->_serie_status = $intStatus;
	}

	public function getCatid():int{
		return $this->_serie_catid;
	}
	public function setCatid(int $intCatid){
		$this->_serie_catid = $intCatid;
	}

	public function getCatname():string{
		return $this->_serie_catname;
	}
	public function setCatname(string $strCatname){
		$this->_serie_catname = $strCatname;
	}

	public function getSrcid():int{
		return $this->_serie_srcid;
	}
	public function setSrcid(int $intSrcid){
		$this->_serie_srcid = $intSrcid;
	}

	public function getSrcname():string{
		return $this->_serie_srcname;
	}
	public function setSrcname(string $strSrcname){
		$this->_serie_srcname = $strSrcname;
	}

	public function getImg():string{
		return $this->_serie_img;
	}
	public function setImg(string $strImg){
		$this->_serie_img = $strImg;
	}

	public function getCreator():int{
		return $this->_serie_creator;
	}
	public function setCreator(int $intCreator){
		$this->_serie_creator = $intCreator;
	}

	public function getCreatorname():string{
		return $this->_serie_creatorname;
	}
	public function setCreatorname(string $strCreatorname){
		$this->_serie_creatorname = $strCreatorname;
	}
	
}
