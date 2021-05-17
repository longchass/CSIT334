<?php
<<<<<<< Updated upstream
	$str_browser_language = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
	$str_browser_language = !empty($_GET['language']) ? $_GET['language'] : $str_browser_language;
	switch (substr($str_browser_language, 0,2))
	{
		case 'de':
			$str_language = 'de';
			break;
		case 'en':
			$str_language = 'en';
			break;
		default:
			$str_language = 'en';
	}
    
	$arr_available_languages = array();
	$arr_available_languages[] = array('str_name' => 'English', 'str_token' => 'en');
	$arr_available_languages[] = array('str_name' => 'Deutsch', 'str_token' => 'de');
    
	$str_available_languages = (string) '';
	foreach ($arr_available_languages as $arr_language)
	{
		if ($arr_language['str_token'] !== $str_language)
		{
			$str_available_languages .= '<a href="'.strip_tags($_SERVER['PHP_SELF']).'?language='.$arr_language['str_token'].'" lang="'.$arr_language['str_token'].'" xml:lang="'.$arr_language['str_token'].'" hreflang="'.$arr_language['str_token'].'">'.$arr_language['str_name'].'</a> | ';
		}
	}
	$str_available_languages = substr($str_available_languages, 0, -3);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="<?php echo $str_language; ?>" xml:lang="<?php echo $str_language; ?>">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>MAMP PRO</title>
<style type="text/css">
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: .9em;
        color: #000000;
        background-color: #FFFFFF;
        margin: 0;
        padding: 10px 20px 20px 20px;
    }
=======

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$sql = $priv = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
	
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
		$priv = "SELECT id, username, privs FROM USERS WHERE username = ?";
		
		if($stmt = mysqli_prepare($link, $priv)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			// Set parameters
			$param_username = $username;
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Store result
				mysqli_stmt_store_result($stmt);
					
				// Check if username exists, if yes then find their privilege
				if(mysqli_stmt_num_rows($stmt) == 1){   
					mysqli_stmt_bind_result($stmt, $id, $username, $privs);
					if($privs == '#P') {
						$sql = "SELECT id, username, password FROM person WHERE username = ?";
					} elseif ($privs == '#S') {
						$sql = "SELECT id, username, password FROM staff WHERE username = ?";
					}
					verify_password($sql);
				}
			} else{
				echo "Oops! Username does not exist. Please try again.";
			}
			mysqli_stmt_close($stmt);
		}
    }
	
	function verify_password($sql) {
		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			// Set parameters
			$param_username = $username;
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Store result
				mysqli_stmt_store_result($stmt);
					
				// Check if username exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt) == 1){                    
					// Bind result variables
					mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
					if(mysqli_stmt_fetch($stmt)){
						if(password_verify($password, $hashed_password)){
							// Password is correct, so start a new session
							session_start();
								
							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $username;                          
							$_SESSION["priv"] =$privs
							// Redirect user to welcome page
							header("location: welcome.php");
						} else{
							// Password is not valid, display a generic error message
							$login_err = "Invalid username or password.";
						}
					}
				} else{
					// Username doesn't exist, display a generic error message
					$login_err = "Invalid username or password.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}
	}
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
>>>>>>> Stashed changes

    samp {
        font-size: 1.3em;
    }

    a {
        color: #000000;
        background-color: #FFFFFF;
    }

    sup a {
        text-decoration: none;
    }

    hr {
        margin-left: 90px;
        height: 1px;
        color: #000000;
        background-color: #000000;
        border: none;
    }

    #logo {
        margin-bottom: 10px;
        margin-left: 28px;
    }

    .text {
        width: 80%;
        margin-left: 90px;
        line-height: 140%;
    }
</style>
</head>

<body>
    <p><img src="MAMP-PRO-Logo.png" id="logo" alt="MAMP PRO Logo" width="250" height="49" /></p>

<?php if ($str_language == 'de'): ?>

<<<<<<< Updated upstream
    <p class="text"><strong>Der virtuelle <span lang="en" xml:lang="en">Host</span> wurde erfolgreich eingerichtet.</strong></p>
    <p class="text">Wenn Sie diese Seite sehen, dann bedeutet dies, dass der neue virtuelle <span lang="en" xml:lang="en">Host</span> erfolgreich eingerichtet wurde. Sie können jetzt Ihren <span lang="en" xml:lang="en">Web</span>-Inhalt hinzufügen, diese Platzhalter-Seite<sup><a href="#footnote_1">1</a></sup> sollten Sie ersetzen <abbr title="beziehungsweise">bzw.</abbr> löschen.</p>
    <p class="text">
        Server-Name: <samp><?php echo $_SERVER['SERVER_NAME']; ?></samp><br />
        Document-Root: <samp><?php echo $_SERVER['DOCUMENT_ROOT']; ?></samp>
    </p>
    <p class="text" id="footnote_1"><small><sup>1</sup> Dateien: <samp>index.php</samp> und <samp>MAMP-PRO-Logo.png</samp></small></p>
    <hr />
    <p class="text">This page in: <?php echo $str_available_languages; ?></p>
=======
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
                
                <input type="text" name="username" placeholder="Username" required="required <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
              
            
               
                <input type="password" name="password" placeholder="Password" required="required" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            
            
                <input type="submit" class="btn btn-primary btn-block btn-large" value="Login">
            
            <p>Sign Up: <a href="registerPersonal.php">For myself</a> or <a href="registerBusiness.php">For my business</a></p>
        </form>
		
		
    </div>
    </div>
</body>
</html>
>>>>>>> Stashed changes

<?php elseif ($str_language == 'en'): ?>

    <p class="text"><strong>The virtual host was set up successfully.</strong></p>
    <p class="text">Long DUmb Dumb<sup><a href="#footnote_1">1</a></sup> should be replaced or deleted.</p>
    <p class="text">
        Server name: <samp><?php echo $_SERVER['SERVER_NAME']; ?></samp><br />
        Document root: <samp><?php echo $_SERVER['DOCUMENT_ROOT']; ?></samp>
    </p>
    <p class="text" id="footnote_1"><small><sup>1</sup> Files: <samp>index.php</samp> and <samp>MAMP-PRO-Logo.png</samp></small></p>
    <hr />
    <p class="text">Diese Seite auf: <?php echo $str_available_languages; ?></p>

<?php endif; ?>

</body>
</html>