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
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
  }
  
  public function captcha() {
    echo '<div class="g-recaptcha" data-sitekey="'. $this->sitekey .'"></div>';
  }
}
?>
