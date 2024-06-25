<?php

if (!defined('MODULE_FILE')) die ("Dostep bezpośredni zabroniony...");

include 'funcs/contact/classes/contact.class.php';
$classContact = new contact;

if ($_POST['send'])
{
  try {
    $classMain->checkReCaptcha();
    $classContact->sendMessage();
  } catch (Exception $e) {
    $classMain->redirect(false, 'info', $e->getMessage());
  }
}
$classMain->optList('contact_type');
$classMain->recaptcha();
$classMain->tpl('contact.tpl');
?>
