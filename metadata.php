<?php

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
    'id'           => 'responsive_slider',
    'title'        => 'Responsive Slider for OXID',
    'description'  => array(
        'en' => 'implements the Jssor into your OXID shop',
        'de' => 'bindet den Jssor in Ihren OXID-Shop ein'
        ),
    // 'thumbnail'    => 'picture.png',
    'version'      => '0.9',
    'author'       => 'Marten Seemann',
    'url'          => 'http://shop.oxid-responsive.com',
    'blocks' => array(
        array('template' => 'layout/header.tpl', 'block' => 'promoslider', 'file' => '/views/blocks/slider.tpl'),
        array('template' => 'layout/page.tpl', 'block' => 'promoslider', 'file' => '/views/blocks/slider.tpl'),
    ),
    'extend'       => array(
        'start' => 'responsive_slider/controllers/start_ext',
        'oxactions' => 'responsive_slider/models/oxactions_ext',
    ),
    'settings'     => array(
      array('group' => 'slider_display', 'name' => 'slider_idle', 'type' => 'str',  'value' => '4000', 'position' => 11),
      array('group' => 'slider_display', 'name' => 'slider_duration', 'type' => 'str',  'value' => '500', 'position' => 12),
      array('group' => 'slider_display', 'name' => 'slider_autostart', 'type' => 'bool',  'value' => true, 'position' => 30),
      array('group' => 'slider_display', 'name' => 'slider_direction', 'type' => 'select', 'constrains' =>'forward|backward', 'value' => 'right', 'position' => 31),
      array('group' => 'slider_display', 'name' => 'slider_orientation', 'type' => 'select', 'constrains' =>'horizontal|vertical', 'value' => 'horizontal', 'position' => 32),
      array('group' => 'slider_navigation', 'name' => 'slider_show_arrows', 'type' => 'bool', 'value' => true, 'position' => 101),
      array('group' => 'slider_navigation', 'name' => 'slider_arrow_type', 'type' => 'str', 'value' => '2', 'position' => 102),
      array('group' => 'slider_navigation', 'name' => 'slider_show_bullets', 'type' => 'bool', 'value' => true, 'position' => 111),
      array('group' => 'slider_navigation', 'name' => 'slider_bullet_type', 'type' => 'str', 'value' => '17', 'position' => 112),
      array('group' => 'slider_transitions', 'name' => 'slider_transitions_code', 'type' => 'str', 'value' => '', 'position' => 201),
      array('group' => 'slider_transitions', 'name' => 'slider_transitions_random', 'type' => 'bool', 'value' => false, 'position' => 210),
    ),
    'templates'    => array(
        'slider.tpl' => 'responsive_slider/views/blocks/slider.tpl',
    ),
);
