<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Charge PHPMailer via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($nom) && !empty($email) && !empty($message)) {
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 2; // Active le débogage
            $mail->Debugoutput = 'html'; 

            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Par exemple, pour Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'noreynindiaye3@gmail.com'; // Ton email
            $mail->Password = 'xhlo rydx bors onhr'; // Mot de passe ou mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurité (STARTTLS)
            $mail->Port = 587; 

            // Entêtes et contenu de l'email
            $mail->setFrom('noreynindiaye3@gmail.com', 'NOREYNI DIGITAL'); 
            $mail->addAddress('noreynindiaye3@gmail.com'); 
            $mail->addReplyTo($email, $nom); 
            $mail->addCustomHeader('X-Mailer', 'PHP/' . phpversion());

            $mail->isHTML(true);
            $mail->Subject = "Nouveau message de $nom via le formulaire de contact";
            $mail->Body    = "<p><strong>Nom :</strong> $nom</p>
                              <p><strong>Email :</strong> $email</p>
                              <p><strong>Message :</strong><br>$message</p>";
            $mail->AltBody = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

            $mail->send();
            echo "Message envoyé avec succès ! Merci pour votre contact.";
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
