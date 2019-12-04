<?php

class user extends CI_Model
{

    private $_user_id;
    private $_user_pseudo;
    private $_user_password;
    private $_user_name;
    private $_user_firstname;
    private $_user_mail;
    private $_user_role;
    private $_user_rolename;
    private $_user_img;

    // Constructeur
    public function __construct()
    {

    }

    // Hydratation
    public function hydrate($arrData)
    {
        foreach ($arrData as $strAttrib => $strValue) {
            $strMethodeName = "set" . ucfirst(str_replace("user", "", $strAttrib));
            if (method_exists($this, $strMethodeName)) {
                $this->$strMethodeName($strValue);
            }
        }
	}
	
	public function getId():int{
		return $this->_user_id;
	}
	public function setId(int $intId){
		$this->_user_id = $intId;
	}

	public function getPseudo():string{
		return $this->_user_pseudo;
	}
	public function setPseudo(string $strPseudo){
		$this->_user_pseudo = $strPseudo;
	}

	public function getPassword():string{
		return $this->_user_password;
	}
	public function setPassword(string $strPassword){
		$this->_user_password = $strPassword;
	}

	public function getName():string{
		return $this->_user_name;
	}
	public function setName(string $strName){
		$this->_user_name = $strName;
	}

	public function getFirstname():string{
		return $this->_user_firstname;
	}
	public function setFirstname(string $strFirstname){
		$this->_user_firstname = $strFirstname;
	}

	public function getMail():string{
		return $this->_user_mail;
	}
	public function setMail(string $strMail){
		$this->_user_mail = $strMail;
	}

	public function getRole():int{
		return $this->_user_role;
	}
	public function setRole(int $intRole){
		$this->_user_role = $intRole;
	}

	public function getRolename():string{
		return $this->_user_rolename;
	}
	public function setRolename(string $strRolename){
		$this->_user_rolename = $strRolename;
	}

	public function getImg():string{
		return $this->_user_img;
	}
	public function setImg(string $strImg){
		$this->_user_img = $strImg;
	}
	
}
