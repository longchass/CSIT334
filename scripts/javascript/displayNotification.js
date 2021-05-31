//sends the given text as a notification to the user
function runPushNotification(inText) {
    $.ajax({
        type: 'POST',
        url: 'scripts/php_scripts/webPush_notification.php',
        data: {
            text: inText
        }
    });
}

/* -=-=-= To use runPushNotification()-=-=-=-

1. Have this code in the header for every page you want to display a notification AND the first page the user will visit to make them subscribe
<script>
        //required for notifications
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "4354d47c-391a-40fd-967f-fbe4df633c0c",
            });
        });
</script>
<script type="text/javascript" src="scripts/javascript/displayNotification.js"></script>

2. Use this tag and function to run the push notification (can be any tag, not just button)
    <button onclick="runPushNotification('Test notification is working correctly')">Test notification</button>

*/


//sends an email to a SINGLE ADDRESS based on address given
function runEmailNotification(inText) {
    $.ajax({
        type: 'POST',
        url: 'scripts/php_scripts/email_notification.php',
        data: {
            email: inText
        }
    });
}

//sends a SMS to a SINGLE NUMBER based on number and message given
//will not work until a verified number is added. Not done due to risk of having number sent to spammers.
function runSMSNotification(inNumber, inMessage) {
    $.ajax({
        type: 'POST',
        url: 'scripts/php_scripts/SMS_notification.php',
        data: {
            number: inNumber, message: inMessage
        }
    });
}