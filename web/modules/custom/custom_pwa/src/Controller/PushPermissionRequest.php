<?php

namespace Drupal\custom_pwa\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Custom PWA routes.
 */
class PushPermissionRequest extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $requestButton = [
      '#type' => 'button',
      '#value' => t('Request Push Notification Permission'),
      '#attributes' => [
        'class' => ['button', 'button--primary', 'push-permission-request'],
      ],
    ];

    $build['content'] = [
      '#markup' => \Drupal::service('renderer')->render($requestButton),
    ];
    $build['#attached']['library'][] = 'custom_pwa/push_permission_request';

    return $build;

  }

}
