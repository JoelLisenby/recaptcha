# recaptcha
A super simple PHP class for use with [reCAPTCHA](https://www.google.com/recaptcha/admin)'s new ReCAPTCHA v3 with scores.

# usage
(See [index.php](index.php) for a working example)

Before you begin, you'll need a site key and secret key from https://www.google.com/recaptcha/ (choose reCAPTCHA v3 option)

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
**5** Optional: Use the get_response() function to gain access to the score so you can make your own definition of "success"
```php
$response = $recaptcha->get_response();
$score = $response->score; // Score between 0.0 and 1.0. 1.0 is very likely a good interaction, 0.0 is very likely a bot
$success = $response->success; // true is a valid reCAPTCHA token for your site
```

Complete get_response() returns:
```
{
  "success": true|false,      // whether this request was a valid reCAPTCHA token for your site
  "score": number             // the score for this request (0.0 - 1.0)
  "action": string            // the action name for this request (important to verify)
  "challenge_ts": timestamp,  // timestamp of the challenge load (ISO format yyyy-MM-dd'T'HH:mm:ssZZ)
  "hostname": string,         // the hostname of the site where the reCAPTCHA was solved
  "error-codes": [...]        // optional
}
```
