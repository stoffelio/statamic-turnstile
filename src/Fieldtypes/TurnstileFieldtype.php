<?php

namespace Stoffelio\StatamicTurnstile\Fieldtypes;

use Statamic\Fields\Fieldtype;

class TurnstileFieldtype extends Fieldtype
{
  protected static $title = 'Turnstile';
  protected $selectable = false;
  protected $selectableInForms = true;
  protected $icon = 'lock';

  public function view()
    {
        return 'statamic-turnstile::turnstile';
    }
}