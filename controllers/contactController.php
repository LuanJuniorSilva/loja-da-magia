<?php
class contactController extends controller
{
  public function index()
  {
    $this->loadView('contact');
  }

  public function send()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      return header('Location: /lojadamagia/contact');
    }

    $name = trim(strip_tags(filter_input(INPUT_POST, 'name')));
    $email = trim(strip_tags(filter_input(INPUT_POST, 'email')));
    $tel = trim(strip_tags(filter_input(INPUT_POST, 'tel')));
    $subject = trim(strip_tags(filter_input(INPUT_POST, 'subject')));
    $message = trim(strip_tags(filter_input(INPUT_POST, 'message')));

    if ($name && $email && $tel && $subject && $message) {
      $messageForEmail  = "<strong>Nome:</strong> {$name}";
      $messageForEmail .= "<strong>E-mail:</strong> {$email}";
      $messageForEmail .= "<strong>Telefone:</strong> {$tel}";
      $messageForEmail .= "<strong>Assunto:</strong> {$subject}";
      $messageForEmail .= "<strong>Mensagem:</strong> {$message}";

      try {
        $email = mail('suporte@lojadamagia.com', $subject, $messageForEmail);
        $_SESSION['contact_msg_ok'] = 'E-mail enviado com sucesso.';
      } catch (Error $erro) {
        $_SESSION['contact_msg_err'] = 'Falha ao enviar e-mail, tente novamente mais tarde!';
      }
    } else {
      $_SESSION['contact_msg_err'] = 'Digite todos os seus dados corretamente.';
    }

    header('Location: /lojadamagia/contact');
  }
}
