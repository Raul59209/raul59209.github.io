<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate inputs
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Données invalides. Veuillez remplir tous les champs correctement.";
        exit;
    }

    // Email settings
    $to = "raul59209@yahoo.com"; 
    $subject = "Nouveau message de $name";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Nom: $name\nEmail: $email\nMessage:\n$message";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Message envoyé avec succès !'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Erreur lors de l\\'envoi du message.'); window.history.back();</script>";
    }
} else {
    // Not a POST request
    http_response_code(403);
    echo "Erreur de soumission.";
}
?>
