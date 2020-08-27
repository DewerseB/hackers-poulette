<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . '/vendor/PHPMailer-6.1.7/src/Exception.php';
    require __DIR__ . '/vendor/PHPMailer-6.1.7/src/PHPMailer.php';
    require __DIR__ . '/vendor/PHPMailer-6.1.7/src/SMTP.php';

    include 'config.php';

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
        }
    }

    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['country']) && isset($_POST['subject']) && isset($_POST['message'])) {
        
        $form = new ContactForm($_POST);

        try {
            $form->validateForm($formCountries, $formSubjects);
            print_r($form);
        } catch (Exception $e) {
            print_r("Cannot validate the form:<br>" . $e->getMessage());
        }

        


        //$mail = new PHPMailer(true);

    }

?>