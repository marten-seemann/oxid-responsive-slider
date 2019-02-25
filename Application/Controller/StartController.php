<?php
namespace SeemannIT\ResponsiveSliderModule\Application\Controller;

class StartController extends StartController_parent {
  protected $jssorDir;
  protected $jssorImgDirUrl;

  public function __construct() {
     $this->jssorDir = $this->getViewConfig()->getModulePath("responsiveslider")."/bower_components/jssor-slider/";
     $this->jssorImgDirUrl = $this->getViewConfig()->getModuleUrl("responsiveslider")."bower_components/jssor-slider/img/";
     parent::__construct();
  }

  public function getSliderSetting($sVar, $asBool = false) {
    $cfg = $this->getConfig();
    $ret = $cfg->getConfigParam("slider_".$sVar);
    if(!$asBool) {
      if(gettype($ret) == "boolean") {
        if($ret == 1) return "true";
        else return "false";
      }
    }
    return $ret;
  }

  private function getFirstBannerDimensions() {
    foreach($this->getBanners() as $banner) {
      if($banner->getBannerPicturePath()) {
        $sizes = getimagesize($banner->getBannerPicturePath());
        break;
      }
    }

    // in some PHP configurations, getimagesize() does not work properly
    // output error message then
    if(!is_array($sizes)) echo "<div style='color:red; font-weight:bold;'>Error: <em>getimagesize()</em> failed.</div>";

    return array(
      "width" => $sizes[0],
      "height" => $sizes[1],
      );
  }

  public function getSliderHeight($slider_width) {
    // set the slider height by the dimensions of the first slider picture
    $dims = $this->getFirstBannerDimensions();
    $image_width = $dims['width'];
    $image_height = $dims['height'];

    $slider_height = (floatval($image_height) / floatval($image_width)) * $slider_width;
    return round($slider_height);
  }


  /**
  * get the HTML and CSS for the navigation arrows
  */
  public function getSliderArrowCode($num) {
    $number = $num."";
    if($num < 10) $number = "0".$number;
    $filename = $this->jssorDir."/skin/arrow-".$number.".source.html";
    return $this->getCodeBlock($filename);
  }

  /**
  * get the HTML and CSS for the navigation bullets
  */
  public function getSliderBulletCode($num) {
    $number = $num."";
    if($num < 10) $number = "0".$number;
    $filename = $this->jssorDir."/skin/bullet-".$number.".source.html";
    return $this->getCodeBlock($filename);
  }


  /**
  * extract the HTML and CSS from the jssor demo files (located in the skin folder)
  */
  private function getCodeBlock($filename) {
    $handle = @fopen($filename, "r");
    $code = "";
    $regionCounter = 0;
    $cssComment = false;
    $output = false;
    $imgDir = $this->jssorImgDirUrl;

    if ($handle) {
      while (($buffer = fgets($handle, 4096)) !== false) {
        if(strpos($buffer, "<!--#region") !== false) $regionCounter++;
        if($regionCounter == 2) $output = true;
        if(strpos($buffer, "<!--#endregion") !== false) {
          $regionCounter--;
          $output = false;
        }
        if($output) {
          if(strpos($buffer, "<!--") !== false) continue; // skip HTML comments
          if(strpos($buffer, "/*") !== false AND strpos($buffer, "*/") !== false) continue; // skip one line CSS comments
          if(strpos($buffer, "/*") !== false AND strpos($buffer, "*/") === false) $cssComment = true;

          $line = str_replace("url(../img/", "url(".$imgDir."/", $buffer);

          // echo htmlentities($line);
          // var_dump($cssComment);

          if(!$cssComment) {
            $code .= $line;
          }

          if($cssComment AND strpos($buffer, '/*') === false AND strpos($buffer, '*/') !== false) $cssComment = false;
        }
      }
      if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
      }
      fclose($handle);
    }
    return $code;
  }

  // add padding according to the chosen skin and depending on whether the thumbnail bar should be shown
  // public function getLayerSliderWrapperAdditionalHeight($slider_width) {
  //   $wrapper_height = 5;
  //   $skin = $this->getLayerSliderSetting("skin");
  //
  //   if($this->getLayerSliderSetting("thumbnailNavigation") == "always") {
  //     $wrapper_height += 70;
  //     if($skin=="glass") $wrapper_height += 20;
  //   }
  //   else {
  //     if($skin=="glass") $wrapper_height += 5;
  //     if($skin=="borderlessdark3d" || $skin=="borderlesslight3d") $wrapper_height += 25;
  //     if($skin=="carousel" || $skin=="defaultskin" || $skin=="glass" || $skin=="minimal") $wrapper_height += 40;
  //   }
  //   if($skin=="darkskin" || $skin=="lightskin" || $skin=="minimal") $wrapper_height += 10;
  //
  //   return round($wrapper_height);
  // }
}
