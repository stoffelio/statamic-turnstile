<?php

namespace Stoffelio\StatamicTurnstile\Tags;

use Statamic\Tags\Tags;

class TurnstileTag extends Tags
{
  protected static $handle = 'turnstile_script';

  /**
   * The {{ turnstile_script }} tag.
   * Adds the javascript library to your site
   * @return string
   */
  public function index()
  {
    return "<script src=\"https://challenges.cloudflare.com/turnstile/v0/api.js\" async defer></script>";
  }
}