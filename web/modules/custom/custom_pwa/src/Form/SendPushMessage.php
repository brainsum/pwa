<?php

namespace Drupal\custom_pwa\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Custom PWA form.
 */
class SendPushMessage extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_pwa_send_push_message';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Token'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (mb_strlen($form_state->getValue('message')) < 10) {
      $form_state->setErrorByName('message', $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::service('custom_pwa.services')->sendFirebaseMessage($form_state->getValue('message'), 'Test Message tile', 'Test message body...', 'https://user-images.githubusercontent.com/3104648/28351989-7f68389e-6c4b-11e7-9bf2-e9fcd4977e7a.png');
    $this->messenger()->addStatus($this->t('The test message has been sent...'));

  }

}

// https://www.howtogeek.com/devops/how-to-send-mobile-push-notifications-with-php-and-firebase/#:~:text=Creating%20Your%20Firebase%20Project&text=Click%20the%20settings%20cog%20in,notifications%20to%20the%20Firebase%20API.
// https://firebase-php.readthedocs.io/en/stable/cloud-messaging.html#
// https://firebase.google.com/docs/cloud-messaging/ios/client#access_the_registration_token
// https://firebase.google.com/docs/cloud-messaging/
// https://www.youtube.com/watch?v=2zHqTjyfIY8
// https://firebase.google.com/docs/cloud-messaging/server?authuser=0&hl=en#choosing-a-server-option
