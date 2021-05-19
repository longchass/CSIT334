<?php
class VaccineCert
{
    // Properties
    protected $username;
    protected $name;
    protected $vac_date;

    // Methods
	function __construct($arg1, $arg2, $arg3)
	{
		$this->username = $arg1;
		$this->name = $arg2;
		$this->vac_date = $arg3;
	}
    function set_username($username)
    {
        $this->username = $username;
    }
    function set_name($name)
    {
        $this->name = $name;
    }
    function set_vac_date($vac_date)
    {
        $this->vac_date = $vac_date;
    }
	function get_username()
	{
		return $this->username;
	}
    function get_name()
    {
        return $this->name;
    }
    function get_vac_date()
    {
        return $this->vac_date;
    }
}
?>