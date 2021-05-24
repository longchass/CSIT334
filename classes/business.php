<?php
class Business
{
    // Properties
    protected $username;
    protected $name;
    protected $address;
	// Constructor
    public function __construct(string $u, string $n, string $a ) {
        $this->username = $u;
        $this->name     = $n;
		$this->address  = $a;
    }
    // Methods
    function set_name($name)
    {
        $this->name = $name;
    }
    function set_address($address)
    {
        $this->address = $address;
    }
    function get_name()
    {
        return $this->name;
    }
    function get_address()
    {
        return $this->address;
    }
}
?>