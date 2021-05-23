

<?PHP
//-=-=- Sends an email to a SINGLE ADDRESS-=-=-=-=

//gets the sent email address
$text = $_POST['email'];

//pases inputs correctly to python
$command2 = 'python sendEmail.py ' . $text;

//executes command and returns output
$output = shell_exec($command2);

//output of the email script
echo $output;

/*
//old code with no arguments, keep for reference
    $command = escapeshellcmd('python sendEmail.py');
    $output = shell_exec($command);
    echo $output; // prints results of script
*/
?>
