

<?PHP
//-=-=- Sends an SMS to a SINGLE NUMBER-=-=-=-=

//gets the sent number and message from call
$number = $_POST['number']; //if implemented, need to call to twillo API to verify number, see https://www.twilio.com/docs/glossary/what-e164
$message = $_POST['message'];


//pases inputs correctly to python
$command = 'python sendSMS.py ' . $number. ' ' . $message;

//executes command and returns output
$output = shell_exec($command);

//output of the  script
echo $output;

?>
