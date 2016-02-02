[{assign var=oBanners value=$oView->getBanners() }]
[{assign var="currency" value=$oView->getActCurrency()}]

[{assign var="moduleUrl" value=$oViewConf->getModuleUrl("responsive_slider")}]


[{oxscript include="$moduleUrl/bower_components/jssor-slider/js/jssor.slider.debug.js"}]

[{assign var="slider_width" value="1200"}]
[{assign var="slider_height" value=$oView->getSliderHeight($slider_width)}]



[{if $oBanners|@count}]
  <div id="slider_container" style="position: relative; top: 0px; left: 0px; width: [{$slider_width}]px; height: [{$slider_height}]px;">
    <div data-u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: [{$slider_width}]px; height: [{$slider_height}]px;">
      [{foreach from=$oBanners item=oBanner name=promoslider}]
        [{assign var=oArticle value=$oBanner->getBannerArticle() }]
        [{assign var=sBannerPictureUrl value=$oBanner->getBannerPictureUrl() }]
        [{assign var=sBannerLink value=$oBanner->getBannerLink() }]
        [{if $sBannerPictureUrl}]
          <div>
            <img data-u="image" alt="" data-src2="[{$sBannerPictureUrl}]"/>
            [{if $oArticle}]
              <h6 style="font-size: 36px; position: absolute; top: 18px; left: 100px; margin: 0; font-weight: 400; box-shadow: 0px 4px 16px -6px black; padding: 10px 40px 10px 40px; color: #ffffff; background:#000000; border-radius: 10px; white-space: nowrap;">
                [{if $sBannerLink }]<a href="[{ $sBannerLink }]" style="text-shadow: 0px 0px 20px white; font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, sans-serif; color: white; ">[{/if}]
                [{ $oArticle->oxarticles__oxtitle->value }]
                [{if $sBannerLink }]</a>[{/if}]
              </h6>
              <div style="font-size: 22px; position: absolute; top: 78px; left: 150px; font-weight: 400; box-shadow: 0px 4px 16px -4px black; padding: 4px 26px 4px 26px; color: #ffffff; background: #ff7700; border-radius: 10px; white-space: nowrap;">
                [{ $oArticle->getFPrice() }] [{ $currency->sign}]
              </div>
            [{/if}]
          </div>
        [{/if}]
      [{/foreach}]
    </div>
    [{if $oView->getSliderSetting("show_arrows")}]
      [{$oView->getSliderArrowCode($oView->getSliderSetting("arrow_type"))}]
    [{/if}]
    [{if $oView->getSliderSetting("show_bullets")}]
      [{$oView->getSliderBulletCode($oView->getSliderSetting("bullet_type"))}]
    [{/if}]
  </div>

  [{capture assign="pageScript"}]
    jQuery(document).ready(function ($) {
      var options = {
        $AutoPlay: [{$oView->getSliderSetting("autostart")}],
        $AutoPlaySteps: [{if $oView->getSliderSetting("direction")=="forward"}]1[{else}]-1[{/if}],
        $SlideDuration: [{$oView->getSliderSetting("duration")}],
        $PlayOrientation: [{if $oView->getSliderSetting("direction")=="horizontal"}]1[{else}]2[{/if}],
        $Idle: [{$oView->getSliderSetting("idle")}],
        $LazyLoading: 1,
        [{if $oView->getSliderSetting("show_arrows")}]
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$,
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2,
            $Scale: false,
          },
        [{/if}]
        [{if $oView->getSliderSetting("show_bullets")}]
          $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$,
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 1,
            $SpacingX: 10,
            $SpacingY: 10,
            $Orientation: 1,
            $Scale: false
          },
        [{/if}]
        [{if $oView->getSliderSetting("transitions_code")}]
          $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: [[{$oView->getSliderSetting("transitions_code")}]],
            $TransitionsOrder: [{if $oView->getSliderSetting("transistions_random")}]0[{else}]1[{/if}],
            $ShowLink: 2
          },
        [{/if}]
      };
      var jssor_slider = new $JssorSlider$('slider_container', options);

      //responsive code begin
      function ScaleSlider() {
        var parentWidth = $('#slider_container').parent().width();
        if (parentWidth) {
          jssor_slider.$ScaleWidth(parentWidth);
        }
        else {
          window.setTimeout(ScaleSlider, 30);
        }
      }
      ScaleSlider();

      $(window).bind("load", ScaleSlider);
      $(window).bind("resize", ScaleSlider);
      $(window).bind("orientationchange", ScaleSlider);
    });
  [{/capture}]
  [{oxscript add=$pageScript}]
[{/if }]
