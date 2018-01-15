<?php

if(isset($_POST['email'])) {



    // EDIT A LINE BELOW AS REQUIRED

    $email_to = "you@yourdomain.com";

    // Custome your email subject

    $email_subject = "Customer reservation";





    function died($error) {

        // your error code can go here

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";

        echo "These errors appear below.<br /><br />";

        echo $error."<br /><br />";

        echo "Please go back and fix these errors.<br /><br />";

        die();

    }



    // validation expected data exists

    if(!isset($_POST['name']) ||

        !isset($_POST['email']) ||

        !isset($_POST['date']) ||

        !isset($_POST['hour']) ||

        !isset($_POST['service'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  $name = test_input($_POST['name']);// required
  $email = test_input($_POST['email']);// required
  $date = test_input($_POST['date']);// required
  $time = test_input($_POST['hour']);// required
  $service = test_input($_POST['service']);// required


    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email)) {

    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

  }

  list($dd,$mm,$yyyy) = explode('/',$date);
  if (!checkdate($dd,$mm,$yyyy)) {
    $error_message .= 'The Date you entered does not appear to be valid.<br />';
  }


  if(strlen($error_message) > 0) {

    died($error_message);

  }

    $email_message = "Form details below.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "Customer Name: ".clean_string($name)."\n";

    $email_message .= "Customer Email: ".clean_string($email)."\n";

    $email_message .= "Time: ".clean_string($time)." on ".clean_string($date)."\n";

    $email_message .= "Service: ".clean_string($service)."\n";



// create email headers

$headers = 'From: '.$email."\r\n".

'Reply-To: '.$email."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);

?>



<!-- include your own success html here -->



Thank for your reservation. We will be in touch with you very soon.



<?php

}

?>