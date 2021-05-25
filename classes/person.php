<?php
class Person {
  // Properties
  protected $username;
  protected $password;
  protected $fname;
  protected $lname;
  protected $infected;
  public function __construct(string $u, string $p, string $f, string $l ) {
	$this->username = $u;
	$this->password = $p;
	$this->fname    = $f;
	$this->lname    = $l;
  }
  // Methods
  function get_fname() {
    return $this->fname;
  }
  function get_lname() {
    return $this->lname;
  }
  function get_username() {
    return $this->username;
  }
  function get_password() {
    return $this->password;
  }
  function get_infected() {
    return $this->infected;
  }
  function set_lname($l)
	{
	$this->lname = $l;
	}
  function set_fname($f)
	{
	$this->fname = $f;
	}
  function set_username($u)
	{
	$this->lname = $u;
	}
	function set_password($p) {
		$this->password = $p;
	}
  function set_infected($i) {
    $this->infected = $i;
  }
}
?>