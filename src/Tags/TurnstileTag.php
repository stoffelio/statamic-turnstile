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
    return "<div class=\"cf-turnstile\" data-sitekey=\"".$sitekey."\"></div>";
  }

  /**
   * The {{ turnstile:script }} tag.
   * Adds the javascript library to your site
   * @return string
   */
  public function script()
  {
    return "<script src=\"https://challenges.cloudflare.com/turnstile/v0/api.js\" async defer></script>";
  }
}