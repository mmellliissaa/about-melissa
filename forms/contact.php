// <?php
//   /**
//   * Requires the "PHP Email Form" library
//   * The "PHP Email Form" library is available only in the pro version of the template
//   * The library should be uploaded to: vendor/php-email-form/php-email-form.php
//   * For more info and help: https://bootstrapmade.com/php-email-form/
//   */

//   // Replace contact@example.com with your real receiving email address
//   $receiving_email_address = 'contact@example.com';

//   if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//     include( $php_email_form );
//   } else {
//     die( 'Unable to load the "PHP Email Form" Library!');
//   }

//   $contact = new PHP_Email_Form;
//   $contact->ajax = true;
  
//   $contact->to = $receiving_email_address;
//   $contact->from_name = $_POST['name'];
//   $contact->from_email = $_POST['email'];
//   $contact->subject = $_POST['subject'];

//   // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
//   /*
//   $contact->smtp = array(
//     'host' => 'example.com',
//     'username' => 'example',
//     'password' => 'pass',
//     'port' => '587'
//   );
//   */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
//?>


<?php
// Include the PHPMailer library
require_once 'libs/phpmailer/Exception.php';
require_once 'libs/phpmailer/PHPMailer.php';
require_once 'libs/phpmailer/SMTP.php';

// Use the PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Set SMTP server (e.g., Gmail or custom SMTP)
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // SMTP username
        $mail->Password = 'your_password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Typically 587 for TLS

        // Set the sender and recipient
        $mail->setFrom($email, $name); // From email and name
        $mail->addAddress('recipient@example.com', 'Your Name'); // To email (your email)

        // Set email subject and body
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\nMessage: $message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message"; // For email clients that don't support HTML

        // Send the email
        if ($mail->send()) {
            echo 'Message has been sent';
        } else {
            echo 'Message could not be sent.';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

