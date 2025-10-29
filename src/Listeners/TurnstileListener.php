<?php

namespace Stoffelio\StatamicTurnstile\Listeners;

use Statamic\Events\FormSubmitted;
use Illuminate\Validation\ValidationException;
use Statamic\Fields\Blueprint;
use Stoffelio\StatamicTurnstile\Services\TurnstileService;

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
      if (!TurnstileService::verify(request()->input('cf-turnstile-response') ?? '')) {
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
}
