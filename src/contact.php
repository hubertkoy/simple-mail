<?php
require '../templates/contact.html';

if (isset($_POST['submit'])) {
    $inputs = [
        'contact_name' => $_POST['contact_name'],
        'contact_email' => $_POST['contact_email'],
        'contact_subject' => $_POST['contact_subject'],
        'contact_message' => $_POST['contact_message'],
    ];
    $fields = [
        'contact_name' => 'string',
        'contact_email' => 'email',
        'contact_subject' => 'string',
        'contact_message' => 'string',
    ];
    $data = sanitize($inputs, $fields);
    $name = $data['contact_name'];
    $email = $data['contact_email'];
    $subject = $data['contact_subject'];
    $message = $data['contact_message'];
    $subject = "Wiadomość od $name: $subject";
    $txt = "Otrzymano wiadomość email od $name ($email). \n\n $message";
    $mail = new Mail();
    $mail->send($subject, $txt, $email, $name);
}
