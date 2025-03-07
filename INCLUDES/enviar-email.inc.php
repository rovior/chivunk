<?php
require '../INCLUDES/geraCodigo.inc.php';

$codigoGerado = geraCodigoAutenticacao();

$_SESSION['codigo_autenticacao'] = $codigoGerado;

$interesseDoCliente = $_SESSION['opcao_selecionada'];

// Incluir os arquivos do PHPMailer
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

// Importar os namespaces do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegar e sanitizar o nome do usuário
    $nomeUsuario = $_POST['nome-do-usuario'];
    $nomeUsuario = trim($nomeUsuario);  // Remover espaços extras
    $nomeUsuario = htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8');  // Evitar XSS

    // Pegar e sanitizar o e-mail
    $emailDestinatario = filter_var($_POST['email-do-usuario'], FILTER_SANITIZE_EMAIL);
    
    // Verificar se o e-mail é válido
    if (filter_var($emailDestinatario, FILTER_VALIDATE_EMAIL)) {

        // Definir a mensagem do e-mail
        $mensagem = 'Olá, ' . $nomeUsuario . ',<br><br>';
        $mensagem .= 'Seja bem-vindo à SiteLease!<br><br>';
        $mensagem .= 'Agradecemos pela confiança em nossos serviços. Você escolheu o serviço: <strong>' . $interesseDoCliente . '</strong>.<br><br>';
        $mensagem .= 'Aqui está o seu código de acesso: <strong>' . $codigoGerado . '</strong>.<br><br>';
        $mensagem .= 'Esse código será necessário para você acessar a área do cliente em nosso site e acompanhar o status do seu pedido.<br><br>';
        $mensagem .= 'Caso tenha alguma dúvida ou precise de mais informações, não hesite em nos contactar.<br><br>';
        $mensagem .= 'Atenciosamente,<br>Equipe SiteLease';
        // Criar instância do PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'contatositelease@gmail.com';  // Seu e-mail
            $mail->Password = 'wvwr ysxu wjjc gxuw';  // Sua senha de e-mail ou senha de app
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Segurança TLS
            $mail->Port = 587;  // Porta do servidor SMTP

            // Remetente e destinatário
            $mail->setFrom('contatositelease@gmail.com', 'Site Lease');
            $mail->addAddress($emailDestinatario, $nomeUsuario);  // Endereço do destinatário

            // Conteúdo do e-mail
            $mail->isHTML(true);  // Habilita o formato HTML
            $mail->Subject = 'E-mail enviado via PHPMailer by Gabriel & Robert';
            $mail->Body    = $mensagem;  // Mensagem formatada em HTML
            $mail->AltBody = strip_tags($mensagem);  // Caso o cliente de e-mail não suporte HTML

            // Envia o e-mail
            $mail->send();
        } catch (Exception $e) {
            echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
        }
    } else {
        echo 'O endereço de e-mail fornecido não é válido.';
    }
} else {
    echo 'Por favor, preencha o formulário corretamente.';
}

?>
