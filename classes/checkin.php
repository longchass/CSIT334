<?php
require person.php;
require business.php;
class Checkin
{
    // Properties
    protected $p_username;
    protected $name;
    protected $b_username;
	protected $address;
	protected $check_in;
	protected $check_out;

    // Methods
	function __construct($arg1, $arg2, $arg3, $arg4, $arg5)
	{
		$this->p_username = $arg1;
		$this->name = $arg2;
		$this->b_username = $arg3;
		$this->address = $arg4;
		$this->check_in = $arg5;
		echo "User $this->p_username checked in at $this->b_username at $this->check_in";
	}
    function set_checkin($check_in)
    {
        $this->check_in = $check_in;
    }
    function set_checkout($check_out)
    {
        $this->check_out = $check_out;
		echo "User $this->p_username checked out from $this->b_username at $this->check_out";
    }
    function get_name()
    {
        return $this->name;
    }
    function get_address()
    {
        return $this->address;
    }
	function get_checkin() 
	{
		return $this->check_in;
	}
	function get_checkout()
	{
		return $this->check_out;
	}
}
?>

/* CREATE TABLE CHECKIN (
	p_username	VARCHAR(50)		NOT NULL,		/*Personal ID*/
    name	VARCHAR(50) NOT NULL,		
	b_username	VARCHAR(50)		NOT NULL,		/*Business ID*/
	address VARCHAR(50) NOT NULL,	
	check_in_time	DATETIME DEFAULT CURRENT_TIMESTAMP,	/*Current time used to sign in*/
	check_out_time	DATETIME,							/*Time signed out*/
	
	CONSTRAINT P_FK FOREIGN KEY (p_username) REFERENCES person (username), 		/*field has to exist in person table*/
	CONSTRAINT B_FK FOREIGN KEY (b_username) REFERENCES business (username)		/*field has to exist in business table*/
); */