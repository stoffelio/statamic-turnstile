# Statamic Turnstile

> Add Cloudflare Turnstile verification to your Statamic forms

## Features

This addon lets you secure your Statamic forms with Cloudflare Turnstile, an alternative to services like Google reCaptcha.

Simply add two custom tags to your page and every form submission is automatically verified.

## How to Install

Before setting up this addon you need to register with Cloudflare Turnstile and add your site. You will receive two keys that need to be added to your porject's .env file.

``` env
TURNSTILE_SITE_KEY=0x4AAAAAAAAlfghdghfh387
TURNSTILE_SECRET_KEY=0x4AAAAAAAAlJftzhtjtrrjtznU-eVC4iU
```

Next install the addon via the control panel or simply run the composer command.

``` bash
composer require stoffelio/statamic-turnstile
```

To load the javascript needed to display the Turnstile widget on the front end, add this tag to your site's head:

``` antlers
{{ turnstile_script }}
```

Lastly edit the blueprint for any form you want to secure and add the Turnstile fieldtype.