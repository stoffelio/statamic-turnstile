<?php

namespace Stoffelio\StatamicTurnstile\Listeners;

use Statamic\Events\FormSubmitted;
use Illuminate\Validation\ValidationException;
use Statamic\Fields\Blueprint;

class TurnstileListener
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  \App\Events\FormSubmitted  $event
   * @return void
   */
  public function handle(FormSubmitted $event)
  {
    if ($this->shouldVerify($event->submission->form()->blueprint())) {
      if (!$this->verify($_POST['cf-turnstile-response'] ?? '')) {
        throw ValidationException::withMessages([__('statamic-turnstile::validation.turnstile')]);
      }
    }
  }

  // checks if the form's blueprint contains a turnstile field and should be verified
  private function shouldVerify(Blueprint $blueprint) {
    foreach ($blueprint->fields()->all() as $field) {
      if ($field->type() == "turnstile") {
        return true;
      }
    }
    return false;
  }

  // verifies the provided token with cloudflare's api
  private function verify($token)
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
