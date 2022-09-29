# Statamic Turnstile

> Add Cloudflare Turnstile verification to your Statamic forms

## Features

This addon lets you secure your Statamic forms with Cloudflare Turnstile, an alternative to services like Google reCaptcha.

Simply add the script to your site via our custom tag and then add a Turnstile field to any form you want to protect. Everything else is done for you.

## How to Install

Before setting up this addon you need to register with Cloudflare Turnstile and add your site. You will receive two keys that need to be added to your project's .env file.

``` env
TURNSTILE_SITE_KEY=0x4AAAAAAAAlfghdghfh387
TURNSTILE_SECRET_KEY=0x4AAAAAAAAlJftzhtjtrrjtznU-eVC4iU
```

Next install the addon via the control panel or simply run `composer require stoffelio/statamic-turnstile`.

To load the javascript needed to display the Turnstile widget on the front end, add the `{{ turnstile:script }}` tag to your site's head.

Lastly edit the blueprint for any form you want to secure and add a field of the Turnstile fieldtype.

## Turnstile Field Output

This addon assumes that you use Statamic's `{{ field }}` tag to automatically pull in the view associated with each form field.

If you want to change the output, you can publish the view to the views/vendor folder using the `php artisan vendor:publish --tag=turnstile-view` command.

If you're creating your own form output and not using the field views, you can use the `{{ turnstile:field }}` tag to output your field manually.