<?php

namespace Stoffelio\StatamicTurnstile\Fieldtypes;

use Statamic\Fields\Fieldtype;
use Statamic\Statamic;

class TurnstileFieldtype extends Fieldtype
{
  protected static $title = 'Turnstile';
  protected $selectable = false;
  protected $selectableInForms = true;

  /**
   * Statamic 6 replaced the control panel's icon set, and the old lock is not in
   * it. The addon still supports v3 to v5, so the name has to follow the version.
   */
  public function icon()
  {
    return version_compare(Statamic::version(), '6.0.0', '>=') ? 'security-lock' : 'lock';
  }

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
