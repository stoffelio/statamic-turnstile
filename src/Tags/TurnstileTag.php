<?php

namespace Stoffelio\StatamicTurnstile\Tags;

use Statamic\Tags\Tags;

class TurnstileTag extends Tags
{
  protected static $handle = 'turnstile';

  /**
   * The {{ turnstile:field }} tag.
   * Adds the Turnstile element to your HTML
   * @return string
   */
  public function field()
  {
    $sitekey = config('turnstile.sitekey') ?? '';
    $theme = $this->params->get('theme', 'auto');
    $name = $this->params->get('name');

    $responseField = $name ? " data-response-field-name=\"".$name."\"" : '';

    return "<div class=\"cf-turnstile\" data-sitekey=\"".$sitekey."\" data-theme=\"".$theme."\"".$responseField."></div>";
  }

  /**
   * The {{ turnstile:script }} tag.
   * Adds the javascript library to your site
   * @return string
   */
  public function script()
  {
    $src = "https://challenges.cloudflare.com/turnstile/v0/api.js";

    if (! $this->params->get('async', true)) {
      return "<script src=\"".$src."\"></script>";
    }

    return "<script src=\"".$src."\" async defer></script>";
  }
}
