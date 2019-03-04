[{assign var=oBanners value=$oView->getBanners() }]
[{assign var="currency" value=$oView->getActCurrency()}]

[{assign var="moduleUrl" value=$oViewConf->getModuleUrl("responsiveslider")}]

[{if $oxcmp_shop->oxshops__oxproductive->value}]
  [{oxscript include="$moduleUrl/bower_components/jssor-slider/js/jssor.slider.mini.js"}]
[{else}]
  [{oxscript include="$moduleUrl/bower_components/jssor-slider/js/jssor.slider.debug.js"}]
[{/if}]

[{assign var="slider_width" value="1200"}]
[{assign var="slider_height" value=$oView->getSliderHeight($slider_width)}]



[{if $oBanners|@count}]
  <div id="slider-container" style="position: relative; top: 0px; left: 0px; width: [{$slider_width}]px; height: [{$slider_height}]px;">
    <div data-u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: [{$slider_width}]px; height: [{$slider_height}]px;">
      [{foreach from=$oBanners item=oBanner name=promoslider}]
        [{assign var=oArticle value=$oBanner->getBannerArticle() }]
        [{assign var=sBannerPictureUrl value=$oBanner->getBannerPictureUrl('desktop')}]
        [{assign var=sBannerLink value=$oBanner->getBannerLink() }]
        [{if $sBannerPictureUrl}]
          <div>
            [{if $oView->getSliderSetting('link_whole_slide', true) && $sBannerLink }]<a href="[{ $sBannerLink }]" alt="[{ $oArticle->oxarticles__oxtitle->value }]">[{/if}]
            <img data-u="image" alt="" data-src2="" data-src-xs="[{$oBanner->getBannerPictureUrl('phone')}]" data-src-sm="[{$oBanner->getBannerPictureUrl('tablet')}]" data-src-md="[{$sBannerPictureUrl}]" />
            [{* if there's a CMS snippet with the same OXID as the banner, show it *}]
            [{oxifcontent ident=$oBanner->oxactions__oxid->value object=oCont}]
              <div class="slider-caption" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0;">
                [{$oCont->oxcontents__oxcontent->value}]
              </div>
            [{/oxifcontent}]
            [{if $oArticle}]
              <h6 style="font-size: 36px; position: absolute; top: 18px; left: 100px; margin: 0; font-weight: 400; box-shadow: 0px 4px 16px -6px black; padding: 10px 40px 10px 40px; color: #ffffff; background:#000000; border-radius: 10px; white-space: nowrap;">
                [{if $sBannerLink }]<a href="[{ $sBannerLink }]" style="text-shadow: 0px 0px 20px white; font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, sans-serif; color: white; ">[{/if}]
                [{ $oArticle->oxarticles__oxtitle->value }]
                [{if $sBannerLink }]</a>[{/if}]
              </h6>
              <div style="font-size: 22px; position: absolute; top: 78px; left: 150px; font-weight: 400; box-shadow: 0px 4px 16px -4px black; padding: 4px 26px 4px 26px; color: #ffffff; background: #ff7700; border-radius: 10px; white-space: nowrap;">
                [{ $oArticle->getFPrice() }] [{ $currency->sign}]
              </div>
              [{if $oView->getSliderSetting('link_whole_slide', true) && $sBannerLink }]</a>[{/if}]
            [{/if}]
          </div>
        [{/if}]
      [{/foreach}]
    </div>
    [{if $oView->getSliderSetting("show_arrows", true)}]
      [{$oView->getSliderArrowCode($oView->getSliderSetting("arrow_type"))}]
    [{/if}]
    [{if $oView->getSliderSetting("show_bullets", true)}]
      [{$oView->getSliderBulletCode($oView->getSliderSetting("bullet_type"))}]
    [{/if}]
  </div>

  [{capture assign="pageScript"}]
    function initSlider() {
      $("#slider-container").find("img").each(function() {
        if(Modernizr.mq("only screen and (max-width: 767px)")) {
          $(this).attr("data-src2", $(this).data("src-xs"));
        }
        else if(Modernizr.mq("only screen and (max-width: 991px)")) {
          $(this).attr("data-src2", $(this).data("src-sm"));
        }
        else {
          $(this).attr("data-src2", $(this).data("src-md"));
        }
      });

      var options = {
        $AutoPlay: [{$oView->getSliderSetting("autostart")}],
        $AutoPlaySteps: [{if $oView->getSliderSetting("direction")=="forward"}]1[{else}]-1[{/if}],
        $SlideDuration: [{$oView->getSliderSetting("duration")}],
        $PlayOrientation: [{if $oView->getSliderSetting("orientation")=="horizontal"}]1[{else}]2[{/if}],
        $Idle: [{$oView->getSliderSetting("idle")}],
        $LazyLoading: 1,
        [{if $oView->getSliderSetting("show_arrows", true)}]
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$,
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2,
            $Scale: true,
          },
        [{/if}]
        [{if $oView->getSliderSetting("show_bullets", true)}]
          $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$,
            $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 1,
            $SpacingX: 10,
            $SpacingY: 10,
            $Orientation: 1,
            $Scale: true
          },
        [{/if}]
        [{if $oView->getSliderSetting("transitions_code", true)}]
          $SlideshowOptions: {
            $Class: $JssorSlideshowRunner$,
            $Transitions: [[{$oView->getSliderSetting("transitions_code")}]],
            $TransitionsOrder: [{if $oView->getSliderSetting("transistions_random")}]0[{else}]1[{/if}],
            $ShowLink: 2
          },
        [{/if}]
      };
      var jssor_slider = new $JssorSlider$('slider-container', options);

      function ScaleSlider() {
        var parentWidth = $('#slider-container').parent().width();
        if (parentWidth) { jssor_slider.$ScaleWidth(parentWidth); }
        else { window.setTimeout(ScaleSlider, 30); }
      }
      ScaleSlider();

      $(window).bind("load", ScaleSlider);
      $(window).bind("resize", ScaleSlider);
      $(window).bind("orientationchange", ScaleSlider);
    }
  [{/capture}]
  [{oxscript add=$pageScript}]
[{/if }]
