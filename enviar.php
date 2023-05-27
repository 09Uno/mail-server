<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = '192.168.1.11';
    $mail->Port = 25;

    // Autenticação SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'baosendbao@outlook.com';
    $mail->Password = '123';

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "baomail";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    $sql = "SELECT * FROM emails";
    $resultado = $conexao->query($sql);

    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $anexo = $_FILES['anexo']['tmp_name'];

    $count = 0;


    $mail->setFrom('baosendbao@outlook.com', 'bao');

    while ($row = $resultado->fetch_assoc()) {
        $emailDestinatario = $row['email'];

        $mail->isHTML(true);
        $mail->ClearAddresses();
        $mail->addAddress($emailDestinatario, $assunto);
        $mail->Subject = $assunto;
        $mail->Body = "<b>$mensagem</b>";

        // Adiciona o anexo

        if (!empty($anexo) && is_uploaded_file($anexo)) {
            $mail->addAttachment($anexo, $anexoNome);
        }
        
        $mail->send();
        $count++;

        if ($count >= 50) {
            sleep(15);
            $count = 0;
        }
    }

    echo 'Message has been sent';
    header("Location: sucesso.html");

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: falha.html");

}
