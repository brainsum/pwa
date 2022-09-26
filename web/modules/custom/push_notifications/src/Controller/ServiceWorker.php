<?php

namespace Drupal\push_notifications\Controller;

use Drupal\Core\Cache\CacheableResponse;
use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Push Notifications routes.
 */
class ServiceWorker extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $path = \Drupal::service('extension.path.resolver')->getPath('module', 'push_notifications');
    $sw = file_get_contents($path . '/js/serviceworker.js');

    $response = new CacheableResponse($sw, 200, [
      'Content-Type' => 'application/javascript',
      'Service-Worker-Allowed' => '/',
    ]);

    return $response;
  }

}
