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
   * @param  \Statamic\Events\FormSubmitted  $event
   * @return void
   */
  public function handle(FormSubmitted $event)
  {
    $handle = $this->turnstileField($event->submission->form()->blueprint());

    if ($handle === null) {
      return;
    }

    if (!TurnstileService::verify($this->token($handle))) {
      throw ValidationException::withMessages([__('statamic-turnstile::validation.turnstile')]);
    }
  }

  // the handle of the form's turnstile field, or null if it has none
  private function turnstileField(Blueprint $blueprint) {
    foreach ($blueprint->fields()->all() as $field) {
      if ($field->type() == "turnstile") {
        return $field->handle();
      }
    }
    return null;
  }

  // the field view names cloudflare's response input after the field, so that a
  // blueprint can mark it required. markup written before that, or by hand with
  // {{ turnstile:field }} and no name, still posts cloudflare's own default.
  private function token($handle)
  {
    return request()->input($handle) ?: (request()->input('cf-turnstile-response') ?? '');
  }
}
