<?php
require_once 'recaptcha.class.php';

$site_key = 'YOUR_SITE_KEY';
$secret_key = 'YOUR_SECRET_KEY';
$recaptcha = new Recaptcha($site_key, $secret_key);
?>
<!doctype html>
<html>

<head>
<title>reCaptcha 2.0 API Class</title>
<?php echo $recaptcha->script(); ?>
</head>

<body>

<?php ob_start(); ?>
<form method="post">
<input type="text" name="example" value="" placeholder="Example Field" />
<?php echo $recaptcha->captcha(); ?>
<input type="submit" value="Submit" />
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

?>

</body>

</html>
