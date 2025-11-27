<?php

namespace Stoffelio\StatamicTurnstile\Listeners;

use Statamic\Events\UserRegistering;
use Illuminate\Validation\ValidationException;
use Stoffelio\StatamicTurnstile\Services\TurnstileService;

class TurnstileRegistrationListener
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
   * @param  \Statamic\Events\UserRegistering  $event
   * @return void
   */
  public function handle(UserRegistering $event)
  {
    if (config('turnstile.protect_registration')) {
      if (!TurnstileService::verify(request()->input('cf-turnstile-response') ?? '')) {
        throw ValidationException::withMessages([__('statamic-turnstile::validation.turnstile')]);
      }
    }
  }
}