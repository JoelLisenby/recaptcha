<?php
require_once 'recaptcha.class.php';

$site_key = 'YOUR_SITE_KEY';
$secret_key = 'YOUR_SECRET_KEY';
$recaptcha = new Recaptcha($site_key, $secret_key);
?>
<!doctype html>
<html>

<head>
<title>Invisible ReCAPTCHA API Class Demo</title>
</head>

<body>
<?php ob_start(); ?>
<form method="post">
<input type="text" name="example" value="" placeholder="Example Field" />
<?php echo $recaptcha->button(); ?>
</form>
<?php
$form = ob_get_clean();

if(!empty($_POST)) {
	if($recaptcha->success()) {
		echo "Passed Captcha.";
	} else {
		echo "Failed Captcha.";
		echo $form;
	}
} else {
	echo $form;
}

echo $recaptcha->script();
?>
</body>

</html>
