<div id="indexslider"></div>

[{capture assign="code" name="code"}]
  [{include file="slider.tpl"}]
[{/capture}]

[{capture assign="initcode" name="initcode"}]
  var code=[{$code|@json_encode}];
  $("#indexslider").append(code);
  jQuery(document).ready(function($) { initSlider(); });
[{/capture}]


[{capture assign="jscode" name="jscode"}]
  [{if $oView->getSliderSetting("show_on_smartphone", true)}]
    if(Modernizr.mq("only screen and (max-width: 767px)")) { [{$initcode}] }
  [{/if}]
  [{if $oView->getSliderSetting("show_on_tablet", true)}]
    if(Modernizr.mq("only screen and (min-width: 768px) and (max-width: 991px)")) { [{$initcode}] }
  [{/if}]
  if(Modernizr.mq("only screen and (min-width: 992px)")) { [{$initcode}] }
[{/capture}]
[{oxscript add=$jscode}]
