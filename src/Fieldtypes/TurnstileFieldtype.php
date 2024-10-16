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

  protected function configFieldItems(): array
  {
    return [
      'theme' => [
        'display'      => 'Theme',
        'instructions' => 'Select Turnstile theme to use',
        'type'         => 'select',
        'default'      => 'auto',
        'options'      => [
          'auto'  => __( 'Auto' ),
          'light' => __( 'Light' ),
          'dark'  => __( 'Dark' ),
        ]
      ]
    ];
  }
}
