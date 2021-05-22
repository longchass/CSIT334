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

//sends an email to all subscribers?
//NOT WORKING AT THE MOMENT, DO NOT USE
/*
function runEmailNotification(inText, inSubject) {
    $.ajax({
        type: 'POST',
        url: 'scripts/php_scripts/email_notification.php',
        data: {
            text: inText, subject: inSubject
        }
    });
}
*/




/* -=-=-= To use -=-=-=-

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