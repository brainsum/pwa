<?php

namespace Drupal\custom_pwa\Controller;

use Drupal\Core\Cache\CacheableResponse;
use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Custom PWA routes.
 */
class ManifestJson extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $output = json_encode($this->getPwaSettings());

    $response = new CacheableResponse($output, 200, [
      'Content-Type' => 'application/json',
    ]);

    // Set cache.
    $meta_data = $response->getCacheableMetadata();
    $meta_data->addCacheTags(['manifestjson']);
    $meta_data->addCacheContexts(['languages:language_interface']);

    return $response;
  }

  /**
   * Manifest JSON settings.
   *
   * Instead of this, you can create a manifest settings form.
   * https://developer.mozilla.org/en-US/docs/Web/Manifest.
   */
  private function getPwaSettings() {

    $settings = [
      "name" => "Custom PWA",
      "short_name" => "PWA",
      "description" => "Custom PWA description.",
      "display" => "standalone",
      "orientation" => "portrait",
      "background_color" => "#ffffff",
      "theme_color" => "#ffffff",
      "lang" => "en",
      "icons" => $this->getIcons(),
      "start_url" => "/",
      "scope" => "/",
      "gcm_sender_id" => "103953800507",
    ];

    return $settings;

  }

  /**
   * Pwa Icons.
   *
   * Pwa generate icon tool:
   * https://tools.crawlink.com/tools/pwa-icon-generator/
   * - extract the zip file.
   * - copy the files from assets/icons into custom_pwa module assets/icons
   * folder.
   *
   * Instead of this, you can create an icons settings form
   * to set all icons manually.
   */
  private function getIcons() {

    $modulePath = \Drupal::service('extension.path.resolver')->getPath('module', 'custom_pwa');
    $path = $modulePath . '/';

    $icons = [
      [
        "src" => $path . "assets/icons/icon-72x72.png",
        "sizes" => "72x72",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-96x96.png",
        "sizes" => "96x96",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-128x128.png",
        "sizes" => "128x128",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-144x144.png",
        "sizes" => "144x144",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-152x152.png",
        "sizes" => "152x152",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-192x192.png",
        "sizes" => "192x192",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-384x384.png",
        "sizes" => "284x284",
        "type" => "image/png",
      ],
      [
        "src" => $path . "assets/icons/icon-512x512.png",
        "sizes" => "512x512",
        "type" => "image/png",
      ],
    ];

    return $icons;

  }

}
