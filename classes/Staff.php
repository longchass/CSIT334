<?php
//require vaccine_cert.php;

class Staff {
  // Properties
  protected $username;
  protected $fname;
  protected $lname;
  
  // Methods
  public function __construct($arg1, $arg2, $arg3)
  {
	  $this->username = $arg1;
	  $this->fname = $arg2;
	  $this->lname = $arg3;
  }
  public function vaccinated($username, $name, $vac_date)
  {
	  $vaccine_cert = new vaccine_cert($username, $name, $vac_date);
  }
  public function set_fname($fname)
  {
	  $this->fname = $fname;
  }
   public function set_lname($lname)
  {
	  $this->lname = $lname;
  }
  public function get_name() 
  {
	  $name = $this->fname." ".$this->lname;
	  return $this->name;
  }
  function get_fname() {
    return $this->fname;
  }
  function get_lname() {
    return $this->lname;
  }
  function get_username() {
    return $this->username;
  }
}
?>