use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . "/vendor/autoload.php";

// OAuth 2.0 credentials obtained through the Google Cloud Console
$clientID = '805424963153-g210k6vr9rkishhbo2epdpdm8dkemfvn.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURI = 'https://example.com/oauth2callback';

// Obtain access token through OAuth 2.0 authorization process
$accessToken = 'your_access_token_here';

$mail = new PHPMailer(true);

try {
// SMTP settings for Gmail
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use STARTTLS for encryption
$mail->SMTPAuth = true;

// Set OAuth 2.0 credentials as public properties
$mail->oauthClientId = $clientID;
$mail->oauthClientSecret = $clientSecret;
$mail->oauthRefreshToken = '';
$mail->oauthAccessToken = $accessToken;

// Sender and recipient
$mail->setFrom('your_email@gmail.com', 'Your Name');
$mail->addAddress('recipient@example.com', 'Recipient Name');

// Email content
$mail->isHTML(true);
$mail->Subject = 'Test Email';
$mail->Body = 'This is a test email.';

// Send email
$mail->send();
echo 'Email sent successfully';
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

