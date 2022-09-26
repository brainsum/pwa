<?php

namespace Drupal\custom_pwa;

/**
 * Custom PWA module Services.
 */
class Services {

  public function sendFirebaseMessage( $token, $title, $message, $imageUrl) {

    $cimzett_tomb = [$token];

    $uzenet_tomb = [
      'title' => $title,
      'body' => $message,
      'sound' => 'default',
      'icon' => $imageUrl,
      'click_action' => 'https://google.com',
      'color' => '#f00',
      'requireInteraction' => TRUE,
    ];

    $mezok_tomb = [
      'registration_ids' => $cimzett_tomb,
      'notification' => $uzenet_tomb
    ];


    $headers = [
      'Authorization: key=kMGmsaaMuzRRixu0deq5Q-gyW11M70oNSaWJmgPJB4c', // ide jön az AAAA kezdetű hosszú Server Key (amit a Firebase konzolból másolsz be)
      'Content-Type: application/json'
    ];

    if ($this->_isCurl()) {
      $ch = curl_init();
      curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
      curl_setopt( $ch,CURLOPT_POST, true );
      curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
      curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $mezok_tomb ) );
      curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

      $eredmenye = curl_exec($ch);

      curl_close( $ch );

      $eredmeny = json_decode($eredmenye);

      if ($eredmeny->success==1 && $eredmeny->failure==0) {
        //print "Sikeres küldés! ID: " . $eredmeny->multicast_id . "<br><br>";
      }
      elseif ($eredmeny->success==0 && $eredmeny->failure==1) {
        //print "A küldés sikertelen.<br><br>";
      }
      else {
        //print "A küldés sikertelen. (ismeretlen hiba)<br><br>";
      }
    }
    else {
      //print "A küldés sikertelen. (cURL nem támogatott)<br><br>";
    }
  }

  private function _isCurl(){
    return function_exists('curl_version');
  }

}
