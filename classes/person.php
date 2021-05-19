<?php
class Person {
  // Properties
  protected $username;
  protected $fname;
  protected $lname;
  
  // Methods
  function get_name() {
	  $name = $this->fname." ".$this->lname;
    return $this->name;
	echo $name;
  }
}
?>