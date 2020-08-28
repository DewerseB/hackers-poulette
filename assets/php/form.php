<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require __DIR__ . '/vendor/PHPMailer-6.1.7/src/Exception.php';
    require __DIR__ . '/vendor/PHPMailer-6.1.7/src/PHPMailer.php';
    require __DIR__ . '/vendor/PHPMailer-6.1.7/src/SMTP.php';

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
                        if (strlen($value) === 0) throw new Exception($field . " cannot be empty.");
                        if (strlen($value) > 128) throw new Exception($field . " must have 128 characters max.");
                    break;
                    case 'gender':
                        if ($value !== 'm' && $value !== 'f') throw new Exception($field . " must be equal to 'm' or 'f'");
                    break;
                    case 'email':
                        if (strlen($value) === 0) throw new Exception($field . " cannot be empty.");
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
                        if (strlen($value) === 0) throw new Exception($field . " cannot be empty.");
                        if (strlen($value) > 1024) throw new Exception($field . " must have 1024 characters max.");
                    break;
                    case 'honeypot':
                        if ($value !== '') throw new Exception("Bot detected!");
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

        function getMailBody($formSubjects) {
            return "From: " . $this->getFullName() . "\nEmail: " . $this->email . "\nCountry: " . $this->country . "\n\nSubject: " . array_search($this->subject, $formSubjects, true) . "\n\n" . $this->message;
        }
    }

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['country']) && isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['honeypot']) && isset($_POST['submit'])) {
        
        $form = new ContactForm($_POST);
        $formIsValid = false;

        try {
            $form->validateForm($formCountries, $formSubjects);
            $formIsValid = true;
            // echo "<p class='has-background-success-dark'>";
            // print_r($form);
            // echo "</p>";
        } catch (Exception $e) {
            print_r("<p class='has-background-danger-dark'>Cannot validate the form:<br>" . $e->getMessage() . "</p>");
        }

        if ($formIsValid) try {
            
            $configSMTP = include('admin/smtp-config.php');
            
            $mail = new PHPMailer(true);

            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $configSMTP['host'];                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $configSMTP['username'];                // SMTP username
            $mail->Password   = $configSMTP['password'];                // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $configSMTP['port'];                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->addAddress($configSMTP['mail']);                     // Add a recipient            
            $mail->addAddress($form->email, $form->getFullName());      // Add a recipient            

            // Content
            $mail->setFrom($form->email, $form->getFullName());
            //$mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = array_search($form->subject, $formSubjects, true);
            $mail->Body    = $form->getMailBody($formSubjects);
            //$mail->AltBody = $form->message;

            $mail->send();
            //print_r($mail->Body);

            print_r("<p class='has-background-success-dark'>Form sent.<br>We sent you a confirmation email.</p>");
        } catch (Exception $e) {
            print_r("<p class='has-background-danger-dark'>Cannot send the mail:<br>" . $e->getMessage() . "</p>");
        }

    }

?>