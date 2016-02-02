<?php
class oxactions_ext extends oxactions_ext_parent {
  /**
   * Returns assigned banner article picture path
   * copied from oxactions getBannerPicturePath, and replaced getPictureUrl by getPicturePath
   *
   * @return string
   */
  public function getBannerPicturePath() {
    if(isset($this->oxactions__oxpic) && $this->oxactions__oxpic->value) {
      $sPromoDir = oxRegistry::get("oxUtilsFile")->normalizeDir(oxUtilsFile::PROMO_PICTURE_DIR);
      return $this->getConfig()->getPicturePath($sPromoDir.$this->oxactions__oxpic->value, false);
    }
  }

  /**
   * Returns banner article picture url, for the requested device type
   *
   * @param $device string the device type, valid values: "phone", "tablet" or "desktop"
   * @return string
   */
  public function getBannerPictureUrl($device = "desktop") {
    $sImgName = false;
    if (!(isset($this->oxactions__oxpic) && $this->oxactions__oxpic->value)) {
      return;
    }
    else {
      $sImgName = basename($this->oxactions__oxpic->value);
      $sDirname = "promo/";
    }

    if($device == "phone") $sSize = $this->getConfig()->getConfigParam('sPromoBannersizePhone');
    else if($device == "tablet") $sSize = $this->getConfig()->getConfigParam('sPromoBannersizeTablet');
    else $sSize = $this->getConfig()->getConfigParam('sPromoBannersize');

    $sUrl = oxRegistry::get("oxPictureHandler")->getPicUrl($sDirname, $sImgName, $sSize, 0, "../promo/", $bSsl);

    if(oxRegistry::get("oxViewConfig")->isModuleActive("roxid")) { // do some retina image magic
      $oModule = oxNew("oxmodule");
      require_once($oModule->getModuleFullPath("roxid")."/inc/retinafy.php");
      return retinafy($sUrl);
    }

    return $sUrl;
  }
}
