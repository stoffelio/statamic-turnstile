<?php

namespace Stoffelio\StatamicTurnstile\Tags;

use Statamic\Tags\Tags;

class TurnstileTag extends Tags
{
  /**
   * The {{ turnstile }} tag.
   * Adds the Turnstile element to your HTML
   * @return string
   */
  public function index()
  {
    $sitekey = config('turnstile.sitekey') ?? '';
    return "<div class=\"cf-turnstile\" data-sitekey=\"".$sitekey."\"></div>";
  }
}