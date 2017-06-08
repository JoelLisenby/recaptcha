<?php
class Recaptcha {
  protected $sitekey;
  private $secret;

  public function __construct($sitekey, $secret) {
    $this->sitekey = $sitekey;
    $this->secret = $secret;
  }
  
  public function success() {
    if(!empty($_POST['g-recaptcha-response'])) {
      $url = 'https://www.google.com/recaptcha/api/siteverify';
      $data = array(
        'secret' => $this->secret,
        'response' => $_POST['g-recaptcha-response'],
        'remoteip' => (!empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '')
      );
      
      $options = array (
        'http' => array (
          'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
          'method' => 'POST',
          'content' => http_build_query($data)
        )
      );
      
      $context = stream_context_create($options);
      $result = json_decode(file_get_contents($url, false, $context));
      
      return $result->success;
    } else {
      return false;
    }
  }
  
  public function script() {
    ob_start();
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
window.onload = function() {
  var element = document.getElementById('submitForm');
  element.onclick = validate;
};

function validate(e) {
  e.preventDefault();
  grecaptcha.execute();
}

function onSubmitCaptchaForm(token) {
  document.getElementById('full_quote_form').submit();
};
</script>
<?php
    return ob_get_clean();
  }
  
  public function button($value = "Submit") {
    $html = '<button id="submitForm">'. $value .'</button>'."\n";
    $html .= '<div id="recaptcha" class="g-recaptcha" data-sitekey="'. $this->sitekey .'" data-badge="inline" data-callback="onSubmitCaptchaForm" data-size="invisible"></div>'."\n";
    return $html;
  }
}
?>
