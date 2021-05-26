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
	function displayAllUser() {
	$sql = 'SELECT PERSON.USERNAME, FNAME, LNAME, INFECTED, VACCINE_TYPE
			FROM PERSON LEFT OUTER JOIN vaccine_cert
			ON person.username = vaccine_cert.username';
		if($stmt = $link->query($sql) )
		{
			echo "<div id='header' ></div>";
			echo "<h3>Profile information</h3>";
			echo "<table width='80%' border='1' align='center'>\n";
			echo "<tr><th>Username</th><th>First name</th><th>Last name</th><th>Infected</th></tr>";
			while($row = $stmt->fetch_row() )
			{
				if($row[3] <> 1) $row[3] = 0;
				$Person = new $Person($row[0],$row[1],$row[2]);
				$Person->set_infected($row[3]);
				echo "<tr><td>".$Person->get_username()."</td>\n";
				echo "<td>".$Person->get_fname()."</td>\n";
				echo "<td>".$Person->get_lname()."</td>\n";
				echo "<td>".$Person->get_infected()."</td>\n";
				echo "<td>"$row[4]"</td></tr>\n";	
			}
			echo "</table>\n";
			$stmt->close();
		}
	}

	function findUser(string $u) {
		$sql = "SELECT PERSON.USERNAME, FNAME, LNAME, INFECTED, VACCINE_TYPE
				FROM person LEFT OUTER JOIN vaccine_cert
				ON person.username = vaccine_cert.username
				where person.username like ?";
		if($stmt = $link->prepare($sql) ) {
			$stmt->bind_param("s",$_GET['name']);
			
			if($stmt->execute() ) {
				echo "<div id='header' ></div>";
				echo "<h3>Profile information</h3>";
				echo "<table width='80%' border='1' align='center'>\n";
				echo "<tr><th>Username</th><th>First name</th><th>Last name</th><th>Infected</th><th>Vaccine</th></tr>";
				$result = $stmt->get_result();
				while($row = $result->fetch_row() ) {
					if ($row[3] <> 1) $row[3] = 0;
				
					$Person = new Person($row[0],$row[1],$row[2]);
					$Person->set_infected($row[3]);
					echo "<tr><td>".$Person->get_username()."</td>\n";
					echo "<td>".$Person->get_fname()."</td>\n";
					echo "<td>".$Person->get_lname()."</td>\n";
					echo "<td>".$Person->get_infected()."</td>\n";
					echo "<td>$row[4]</td></tr>\n";	
				}
				echo "</table>\n";
				$stmt->close();
			}
		}
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