<?php

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require __DIR__ . '/vendor/PHPMailer-6.1.7/src/Exception.php';
    // require __DIR__ . '/vendor/PHPMailer-6.1.7/src/PHPMailer.php';
    // require __DIR__ . '/vendor/PHPMailer-6.1.7/src/SMTP.php';

    require __DIR__ . '/vendor/SendGrid/sendgrid-php.php';

    include 'form-config.php';

    class ContactForm {
        function __construct($post) {
            foreach ($post as $field => $value) {
                if ($field === 'email') {
                    $this->$field = filter_var(trim($value), FILTER_SANITIZE_EMAIL);
                } else {
                    $this->$field = filter_var(trim($value), FILTER_SANITIZE_STRING);
                }
            }
        }

        function validateForm($countries, $subjects) {
            foreach ($this as $field => $value) {
                switch ($field) {
                    case 'firstname': case 'lastname':
                        if (strlen($value) > 256) throw new Exception($field . " must have 256 characters max.");
                    break;
                    case 'gender':
                        if ($value !== 'm' && $value !== 'f') throw new Exception($field . " must be equal to 'm' or 'f'");
                    break;
                    case 'email':
                        if (strlen($value) > 254) throw new Exception($field . " must have 254 characters max.");
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) throw new Exception($value . " is not a valid " . $field);
                    break;
                    case 'country':
                        if (!in_array($value, $countries)) throw new Exception($value . " is not a valid " . $field);
                    break;
                    case 'subject':
                        if (!in_array($value, $subjects)) throw new Exception($value . " is not a valid " . $field);
                    break;
                    case 'message':
                        if (strlen($value) > 1024) throw new Exception($field . " must have 1024 characters max.");
                    break;
                    case 'submit':
                        if ($value !== 'Submit') throw new Exception("Something went wrong with submit.");
                    break;
                    default:
                        throw new Exception($field . " is not a valid input");
                    break;
                }
            }
            return true;
        }

        function getFullName() {
            return $this->firstname . " " . $this->lastname;
        }
    }

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['country']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['submit'])) {
        
        $form = new ContactForm($_POST);
        $formIsValid = false;

        try {
            $form->validateForm($formCountries, $formSubjects);
            $formIsValid = true;
            print_r($form);
        } catch (Exception $e) {
            print_r("Cannot validate the form:<br>" . $e->getMessage());
        }

        if ($formIsValid) try {

            $configSMTP = include('smtp-config.php');
            
            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom($form->email, $form->getFullName());
            $email->setSubject($form->subject);
            $email->addTo("bastien.dewerse@gmail.com", "B.D.");
            $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
            $email->addContent(
                "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
            );
            $sendgrid = new \SendGrid(getenv('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'));
            
            
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            
            
            
            
            
            
            
            
            
            
            
            
            // $mail = new PHPMailer(true);

            // //Server settings
            // //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            // $mail->isSMTP();                                            // Send using SMTP
            // $mail->Host       = $configSMTP['host'];                    // Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // $mail->Username   = $configSMTP['username'];                // SMTP username
            // $mail->Password   = $configSMTP['password'];                // SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            // $mail->Port       = $configSMTP['port'];                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // $mail->addAddress($configSMTP['mail']);                     // Add a recipient            

            // // Content
            // $mail->setFrom($form->email, $form->getFullName());
            // $mail->isHTML(true);                                  // Set email format to HTML
            // $mail->Subject = $form->subject;
            // $mail->Body    = $form->message;
            // //$mail->AltBody = $form->message;

            // //$mail->send();
            // //print_r($mail);
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
            //print_r("Cannot send the mail:<br>" . $e->getMessage());
        }

    }

?>