<?php
class sliderdynimggenerator extends oxdynimggenerator {
  /**
  * set path pattern for banner images
  *
  * is needed to make OXID actually generated the resized images
  */
  public function outputImage() {
    $sPattern = "/.*\/generated\/promo\/\d+\_\d+\_\d+$/";
    $this->_aConfParamToPath['sPromoBannersize'] = $sPattern;
    $this->_aConfParamToPath['sPromoBannersizeTablet'] = $sPattern;
    $this->_aConfParamToPath['sPromoBannersizePhone'] = $sPattern;
    parent::outputImage();
  }

  /**
  * fix path to master image, such that banner pictures are recognized
  */
  protected function _getImageMasterPath() {
    $sPath = parent::_getImageMasterPath();
    $sPath = str_replace("master/generated/promo/", "pictures/promo/", $sPath);
    return $sPath;
  }
}
