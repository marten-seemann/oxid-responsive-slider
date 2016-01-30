<?php
class start_ext extends start_ext_parent {
  public function getSliderSetting($sVar) {
    $cfg = $this->getConfig();
    $ret = $cfg->getConfigParam($sVar);
    if(gettype($ret) == "boolean") {
      if($ret == 1) return "true";
      else return "false";
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
