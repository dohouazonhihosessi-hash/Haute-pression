<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyage des champs pour éviter les injections
    $name = strip_tags(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Vérification des champs
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: error.html");
        exit();
    }

    $to = "hautepressioninter@gmail.com";
    $subject = "Nouveau message de $name";
    $body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";
    
    // Entêtes sécurisés
    $headers = "From: noreply@tondomaine.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        header("Location: success.html");
        exit();
    } else {
        header("Location: error.html");
        exit();
    }
}
?>