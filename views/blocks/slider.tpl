[{assign var=oBanners value=$oView->getBanners() }]
[{assign var="currency" value=$oView->getActCurrency()}]

[{assign var="moduleUrl" value=$oViewConf->getModuleUrl("responsive_slider")}]


[{oxscript include="$moduleUrl/bower_components/jssor-slider/js/jssor.slider.debug.js"}]

[{assign var="slider_width" value="600"}]
[{assign var="slider_height" value=$oView->getSliderHeight($slider_width)}]



[{if $oBanners|@count}]
  <div id="slider_container" style="position: relative; top: 0px; left: 0px; width: [{$slider_width}]px; height: [{$slider_height}]px;">
    <div data-u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: [{$slider_width}]px; height: [{$slider_height}]px;">
      [{foreach from=$oBanners item=oBanner name=promoslider}]
        [{assign var=oArticle value=$oBanner->getBannerArticle() }]
        [{assign var=sBannerPictureUrl value=$oBanner->getBannerPictureUrl() }]
        [{assign var=sBannerLink value=$oBanner->getBannerLink() }]
        [{if $sBannerPictureUrl}]
          <div><img data-u="image" alt="" src="[{$sBannerPictureUrl}]"/></div>
        [{/if}]
      [{/foreach}]
    </div>
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
        }
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
