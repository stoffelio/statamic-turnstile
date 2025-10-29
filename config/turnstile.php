<?php

return [
  'sitekey' => env('TURNSTILE_SITE_KEY', ''),
  'secretkey' => env('TURNSTILE_SECRET_KEY', ''),

  'protect_registration' => env('TURNSTILE_PROTECT_REGISTRATION', false),
];