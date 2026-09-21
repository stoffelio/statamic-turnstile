# Statamic Turnstile

> Add Cloudflare Turnstile verification to your Statamic forms

## Features

This addon lets you secure your Statamic forms with Cloudflare Turnstile, an alternative to services like Google reCaptcha.

Simply add the script to your site via our custom tag and then add a Turnstile field to any form you want to protect. Everything else is done for you.

You can also protect user registration forms by setting the `TURNSTILE_PROTECT_REGISTRATION` environment variable to `true`.
If you're using this feature make sure to add `{{ turnstile:field }}` into the registration form page.

## Requirements

- Statamic v3, v4, v5 or v6

## How to Install

Before setting up this addon you need to register with Cloudflare Turnstile and add your site. You will receive two keys that need to be added to your project's .env file.

``` env
TURNSTILE_SITE_KEY=0x4AAAAAAAAlfghdghfh387
TURNSTILE_SECRET_KEY=0x4AAAAAAAAlJftzhtjtrrjtznU-eVC4iU
```

Next install the addon via the control panel or simply run `composer require stoffelio/statamic-turnstile`.

To load the javascript needed to display the Turnstile widget on the front end, add the `{{ turnstile:script }}` tag to your site's head. It is loaded with `async defer`. On a page that renders before the script has run, Cloudflare can miss the widget, so `{{ turnstile:script async="false" }}` loads it blocking instead.

Lastly edit the blueprint for any form you want to secure and add a field of the Turnstile fieldtype.

## Turnstile Field Output

This addon assumes that you use Statamic's `{{ field }}` tag to automatically pull in the view associated with each form field.

If you want to change the output, you can publish the view to the views/vendor folder using the `php artisan vendor:publish --tag=turnstile-view` command.

If you're creating your own form output and not using the field views, you can use the `{{ turnstile:field }}` tag to output your field manually. Pass your blueprint field's handle so the solved challenge is posted under it: `{{ turnstile:field name="turnstile" }}`.

## Marking the field required

You can tick "required" on the Turnstile field in your blueprint. The field view names Cloudflare's response input after the field, so the solved challenge arrives under the field's own handle and Statamic's rule can see it. Before this, the field was always empty as far as the validator was concerned and `required` could never pass.

The two checks answer different questions and it is reasonable to use both. `required` means the visitor completed the challenge in the browser, and the addon's own check means Cloudflare agrees the token is genuine. Leave `required` off and the addon still refuses the submission when the token is missing or invalid, exactly as before.

If you published the view before v1.4.0, or you output the field with `{{ turnstile:field }}` and no `name`, the token still arrives as `cf-turnstile-response` and is still verified. Only `required` will not work, because the field's own handle is never in the request.

## Translate validation error message

If you want to change the translation of the validation error message you can publish the default language file using the `php artisan vendor:publish --tag=turnstile-lang` command.

## About

Built and maintained by [Alexander Stoffel](https://stoffel.io/), freelance Statamic and Laravel developer.
