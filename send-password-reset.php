<?php
$email = $_POST["email"];

$mysql = require __DIR__ . "/conf.php";

// Check if token already exists
$sql_check = "SELECT reset_token_hash FROM users WHERE email = ?";
$stmt_check = $mysql->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$stmt_check->store_result();
$count=0;
if ($stmt_check->num_rows > 0) {
    // Token already exists, attempt to generate a new one
    $max_attempts = 10; // Set a maximum number of attempts
    $attempt = 0;
    do {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        // Check if the token already exists
        $sql_token_exists = "SELECT COUNT(*) FROM users WHERE reset_token_hash = ?";
        $stmt_token_exists = $mysql->prepare($sql_token_exists);
        $stmt_token_exists->bind_param("s", $token_hash);
        $stmt_token_exists->execute();
        $stmt_token_exists->bind_result($count);
        $stmt_token_exists->fetch();
        $stmt_token_exists->close();

        $attempt++;

    } while ($count > 0 && $attempt < $max_attempts); // Loop until a unique token is generated or maximum attempts reached

    if ($attempt < $max_attempts) {
        // Update database with new token
        $sql_update = "UPDATE users
                       SET reset_token_hash = ?,
                           reset_token_expires_at = ? 
                       WHERE email = ?";
        $stmt_update = $mysql->prepare($sql_update);
        $stmt_update->bind_param("sss", $token_hash, $expiry, $email);
        $stmt_update->execute();
        $stmt_update->close();

        echo "User found and updated successfully.";

        // Email sending logic here
        $mail = require __DIR__ . "/mailer.php";
        $mail->setFrom("noreply@example.com", "PHPmailer");
        $mail->addAddress($email);
        $mail->Subject = "Password reset";
        $mail->Body = <<<END
            Click <a href="http://example.com/reset-password.php?token=$token">here</a>
            to reset your password.
        END;
        try {
            $mail->send();
            echo "Link has been sent, check your mail";
        } catch (Exception $e) {
            echo "Email can not be sent, error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to generate a unique token within the maximum attempts limit.";
    }
} else {
    echo "User not found.";
}

$stmt_check->close();
$mysql->close();





