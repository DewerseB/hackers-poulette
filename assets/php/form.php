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
                    case 'gender':
                        if ($value !== 'm' && $value !== 'f') throw new Exception('Cannot validate : ' . $field . '=>' . $value);
                    break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) throw new Exception('Cannot validate : ' . $field . '=>' . $value);
                    break;
                    case 'country':
                        if (!in_array($value, $countries)) throw new Exception('Cannot validate : ' . $field . '=>' . $value);
                    break;
                    case 'subject':
                        if (!in_array($value, $subjects)) throw new Exception('Cannot validate : ' . $field . '=>' . $value);
                    break;
                    default:

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
            print_r($e->getMessage());
        }

        


        //$mail = new PHPMailer(true);

    }

?>