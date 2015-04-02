# recaptcha
A simple PHP implementation of the new 2.0 API

# usage
(See [index.php](index.php) for a working example)

**1** Include recaptcha.class.php and initiate with your site key and secret key
```php
require_once 'recaptcha.class.php';
$site_key = 'YOUR_SITE_KEY';
$secret_key = 'YOUR_SECRET_KEY';
$recaptcha = new Recaptcha($site_key, $secret_key);
```
**2** Use the script() function to place the recaptcha script (usually above ```</head>```)
```php
<?php echo $recaptcha->script(); ?>
```
**3** Use the captcha() function to place the captcha at end of form
```php
<?php echo $recaptcha->captcha(); ?>
```
**4** Use the success() function to check if visitor passes captcha
```php
if($recaptcha->success()) {
```
