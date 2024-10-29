<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables están configuradas y no son nulas
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        // Reemplaza con tu dirección de correo electrónico real
        $receiving_email_address = 'albertomonserrate342@gmail.com';

        // Ruta del archivo php-email-form.php
        $php_email_form = '../assets/vendor/php-email-form/php-email-form.php';

        // Verificar si el archivo php-email-form.php existe
        if (file_exists($php_email_form)) {
            include($php_email_form);

            // Crear instancia de PHP_Email_Form
            $contact = new PHP_Email_Form;
            $contact->ajax = true;
            
            // Configurar detalles del correo electrónico
            $contact->to = $receiving_email_address;
            $contact->from_name = $_POST['name'];
            $contact->from_email = $_POST['email'];
            $contact->subject = $_POST['subject'];

            // Descomentar y configurar si quieres usar SMTP
            /*
            $contact->smtp = array(
                'host' => 'example.com',
                'username' => 'example',
                'password' => 'pass',
                'port' => '587'
            );
            */

            // Agregar mensajes al cuerpo del correo
            $contact->add_message($_POST['name'], 'From');
            $contact->add_message($_POST['email'], 'Email');
            $contact->add_message($_POST['message'], 'Message', 10);

            // Enviar el correo y mostrar el resultado
            $sendResult = $contact->send();
            if ($sendResult) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error'; // No se pudo cargar la biblioteca "PHP Email Form"
        }
    } else {
        echo 'error'; // Datos del formulario incompletos
    }
} else {
    echo 'error'; // Método de solicitud incorrecto
}

?>
