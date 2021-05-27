<?php
class Business
{
    // Properties
    protected $username;
    protected $name;
    protected $address;
	protected $guest_lim;
	// Constructor
    public function __construct(string $u, string $n, string $a, string $lim ) {
        $this->username = $u;
        $this->name     = $n;
		$this->address  = $a;
		$this->guest_lim = $lim;
    }
    // Methods
    function set_name($name)
    {
        $this->name = $name;
    }
	function set_guest_lim($lim) {
		$this->guest_lim = $lim;
	}
    function get_username()
    {
		return $this->username;    
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
	function get_guest_lim()
	{
		return $this->guest_lim;
	}
}
?>