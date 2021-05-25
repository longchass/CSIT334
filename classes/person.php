<?php
class Person {
  // Properties
  protected $username;
  protected $fname;
  protected $lname;
  public function __construct(string $u, string $f, string $l ) {
	$this->username = $u;
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
}
?>