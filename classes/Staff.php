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
  public function set_name($fname, $lname)
  {
	  $this->fname = $fname;
	  $this->lname = $lname;
  }
  public function get_name() 
  {
	  $name = $this->fname." ".$this->lname;
	  return $this->name;
  }
}
?>