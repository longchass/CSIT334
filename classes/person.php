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
    return $this->lname;
  }
}
?>