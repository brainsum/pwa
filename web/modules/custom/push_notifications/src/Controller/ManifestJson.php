<?php

namespace Drupal\push_notifications\Controller;

use Drupal\Core\Cache\CacheableResponse;
use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Push Notifications routes.
 */
class ManifestJson extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $port = '49157';

    $output = [
      "orientation" => "portrait",
      "name" => "Push Notifications",
      "short_name" => "PN",
      "display" => "standalone",
      "background_color" => "#ffffff",
      "theme_color" => "#ffffff",
      "lang" => "en",
      "icons" => [
        [
          "src" => "http://127.0.0.1:" . $port . "/modules/contrib/pwa/assets/druplicon-512.png",
          "sizes" => "512x512",
          "type" => "image/png",
        ],
        [
          "src" => "http://127.0.0.1:" . $port . "/modules/contrib/pwa/assets/druplicon-192.png",
          "sizes" => "192x192",
          "type" => "image/png",
        ],
        [
          "src" => "http://127.0.0.1:" . $port . "/modules/contrib/pwa/assets/druplicon-144.png",
          "sizes" => "144x144",
          "type" => "image/png",
        ],
      ],
      "start_url" => "/",
      "scope" => "/",
    ];
    $output = json_encode($output);

    $response = new CacheableResponse($output, 200, [
      'Content-Type' => 'application/json',
    ]);
    $meta_data = $response->getCacheableMetadata();
    $meta_data->addCacheTags(['manifestjson']);
    $meta_data->addCacheContexts(['languages:language_interface']);

    return $response;
  }

}
