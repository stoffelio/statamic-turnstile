<?php

namespace Stoffelio\StatamicTurnstile\Services;

class TurnstileService
{

  // verifies the provided token with cloudflare's api
  public static function verify($token)
  {
    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $args = [
      'secret' => config('turnstile.secretkey') ?? '',
      'response' => $token
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($output);
    
    if (! $result || ! $result->success) {
        return false;
    }
    return true;
  }
}
