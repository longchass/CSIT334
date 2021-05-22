<?PHP
    //NOT SET UP, DO NOT USE


    /*
    //comment and clean up code
    function sendMessage()
    {
        //gets the sent text & email header
        $text = $_POST['text'];
        $email_subject = $_POST['subject'];

        //email content set 
        //can change and use HTML code OR TEMPLATE ID
        $content = array(
            "en" => $text
        );

        //API fields used
        $fields = array(
            'app_id' => "4354d47c-391a-40fd-967f-fbe4df633c0c",
            'included_segments' => array(
                'Subscribed Users'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'email_subject' => $email_subject,
            'email_body' => $content,
            'email_from_name' => 'VaXafe',
            'name' => 'Email Notification'
        );

        //converts to JSON
        $fields = json_encode($fields);
        // print("\nJSON sent:\n");
        // print($fields);

        //sends data to API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NGI2M2QyOWItZWMwNy00OWJjLTg4OGQtOWI5YTliODZiZTUw'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    //responses from API
    $response = sendMessage();
    $return["allresponses"] = $response;
    $return = json_encode($return);

    $data = json_decode($response, true); //custom map of data that is passed back
    //print_r($data);
    $id = $data['id'];
    // print_r($id);

    //print("\n\nJSON received:\n");
    //print($return);
    //print("\n");
    */
    ?>
