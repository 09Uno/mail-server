<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'baosendbao@outlook.com';
    $mail->Password = 'Br!941690';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "baomail";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    $sql = "SELECT * FROM emails";
    $resultado = $conexao->query($sql);

    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $count = 0;

    $mail->setFrom('baosendbao@outlook.com', 'bao');

    while ($row = $resultado->fetch_assoc()) {
        $emailDestinatario = $row['email'];
        $nome = $row['nome'];
        $mail->isHTML(true);
        $mail->addAddress($emailDestinatario, $nome);
        $mail->Subject = $assunto;
        $mail->Body = "<b>$mensagem</b>";
        $mail->send();
        $count++;

        if ($count >= 50) {
            sleep(15);
            $count = 0;
        }
    }

    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
