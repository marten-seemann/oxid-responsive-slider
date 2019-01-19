<?php
namespace SeemannIT\ResponsiveSliderModule\Model;

class Actions extends Actions_parent {
  /**
   * Returns assigned banner article picture path
   * copied from oxactions getBannerPicturePath, and replaced getPictureUrl by getPicturePath
   *
   * @return string
   */
  public function getBannerPicturePath() {
    if(isset($this->oxactions__oxpic) && $this->oxactions__oxpic->value) {
      $sPromoDir = \OxidEsales\Eshop\Core\Registry::get("oxUtilsFile")->normalizeDir(\OxidEsales\Eshop\Core\UtilsFile::PROMO_PICTURE_DIR);
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

    $sUrl = \OxidEsales\Eshop\Core\Registry::get("oxPictureHandler")->getPicUrl($sDirname, $sImgName, $sSize, 0, "../promo/", $bSsl);

    if(\OxidEsales\Eshop\Core\Registry::get("oxViewConfig")->isModuleActive("roxid")) { // do some retina image magic
      $oModule = oxNew("oxmodule");
      require_once($oModule->getModuleFullPath("roxid")."/inc/retinafy.php");
      return retinafy($sUrl);
    }

    return $sUrl;
  }
}
