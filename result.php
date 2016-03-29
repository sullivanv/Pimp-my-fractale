<?php
class Complexe {
  private $_a;
  private $_b;

  public function __construct($a, $b) {
    $this->_a = $a;
    $this->_b = $b;
  }
  public function mod() {
    return (sqrt($this->_a * $this->_a + $this->_b * $this->_b));
  }
  public function add($z) {
    $c = new Complexe(0, 0);
    $c->_a = $this->_a + $z->_a;
    $c->_b = $this->_b + $z->_b;
    return ($c);
  }
  public function mul($z) {
    $c = new Complexe(0, 0);
    $c->_a = ($this->_a * $z->_a - $this->_b * $z->_b);
    $c->_b = ($this->_a * $z->_b + $this->_b * $z->_a);
    return ($c);
  }
  public function pow($k) {
    $result = new Complexe(1, 0);
    for ($n = 0; $n < $k; $n++) { 
      $result = $this->mul($result);
    }
    return ($result);
  }
  public function disp() {
    echo $this->_a . " + i " . $this->_b . "\n";
  }
    
};
header ("Content-type: image/png");
$image = imagecreatetruecolor(640, 480);
$couleur_fond = imagecolorallocate($image, 255, 255, 255);

for ($x = -320; $x < 320; $x++) { 
  for ($y = -240; $y < 240; $y++) {
    $z = new Complexe(0, 0);
    $c = new Complexe($x / 160, $y / 120);
    $ite = 0;
    while ($z->mod() < 2 && $ite < $_POST["nombreVR1"]) {
      $z = $z->pow($_POST["nombreVR2"])->add($c);
      $ite++;
    }
    if ($z->mod() < 2)
      imagesetpixel($image, $x + 320, $y + 240, $couleur_fond);   
    else
      {
       	srand($ite + 4);
	$couleur = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
	imagesetpixel($image, $x + 320, $y + 240, $couleur);   
      }
  }
}
imagepng($image);
?>