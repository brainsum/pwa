<?php

namespace Drupal\custom_pwa\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

/**
 * Returns responses for Custom PWA routes.
 */
class GetToken extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => Markup::create('<p id="mytoken">myTOKEN</p>'),
    ];
    $build['#attached']['library'][] = 'custom_pwa/gettoken';
    return $build;
  }

}
