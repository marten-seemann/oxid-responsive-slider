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
}
