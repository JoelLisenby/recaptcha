# recaptcha
A super simple PHP class for use with [reCAPTCHA](https://www.google.com/recaptcha/admin)'s new Invisible ReCAPTCHA API.

# usage
(See [index.php](index.php) for a working example)

Before you begin, you'll need a site key and secret key from https://www.google.com/recaptcha/ (choose invisible reCAPTCHA option)

**1** Include recaptcha.class.php and initiate with your site key and secret key
```php
require_once 'recaptcha.class.php';
$form_id = 'formID';
$site_key = 'YOUR_SITE_KEY';
$secret_key = 'YOUR_SECRET_KEY';
$recaptcha = new Recaptcha($form_id, $site_key, $secret_key);
```
**2** Use the script() function to place the recaptcha scripts (should be above ```</body>```)
```php
echo $recaptcha->script();
```
**3** Use the button('Button Value') function to place the submit button and reCAPTCHA at end of your form
```php
echo $recaptcha->button('Button Value');
```
**4** Use the success() function to check if the visitor successfully filled out the captcha
```php
if($recaptcha->success()) { ... }
```
