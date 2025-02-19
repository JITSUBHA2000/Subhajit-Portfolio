<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require __DIR__ . '/../vendor/autoload.php'; // Ensure the path is correct
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $subject = htmlspecialchars($_POST['subject']);
      $message = htmlspecialchars($_POST['message']);
  
      $mail = new PHPMailer(true);
  
      try {
          // SMTP Configuration
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'sjm.avalgate@gmail.com'; // Your Gmail
          $mail->Password   = 'mxgpxcevqcxkdffr'; // Generate an App Password from Gmail settings
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port       = 587;
  
          // Recipients
          $mail->setFrom($email, $name); // From User
          $mail->addAddress('sjm.avalgate@gmail.com'); // Receiving Email
  
          // Email Content
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body    = "<p><strong>Name:</strong> $name</p>
                            <p><strong>Email:</strong> $email</p>
                            <p><strong>Message:</strong> $message</p>";
  
          // Send Email
          if ($mail->send()) {
              echo "success";
          } else {
              echo "error";
          }
          exit();
      } catch (Exception $e) {
          echo "error: {$mail->ErrorInfo}";
      }
  } else {
      echo "Invalid request.";
  }  
?>
