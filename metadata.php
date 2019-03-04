<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id'           => 'responsiveslider',
    'title'        => [
        'en' => 'Responsive Slider for OXID',
        'de' => 'Responsive Slider für OXID',
    ],
    'description'  => [
        'en' => 'implements the Jssor into your OXID shop',
        'de' => 'bindet den Jssor in Ihren OXID-Shop ein'
    ],
    'version'      => '2.1',
    'author'       => 'Marten Seemann',
    'url'          => 'https://www.oxid-responsive.com',
    'blocks' => [
        [
            'template' => 'layout/header.tpl',
            'block' => 'indexslider',
            'file' => '/views/blocks/slider_loader.tpl'
        ],
        [
            'template' => 'layout/page.tpl',
            'block' => 'indexslider',
            'file' => '/views/blocks/slider_loader.tpl'
        ],
        [
            'template' => 'actions_main.tpl',
            'block' => 'admin_actions_main_form',
            'file' => '/views/blocks/admin/actions_main.tpl',
        ],
    ],
    'extend'       => [
        \OxidEsales\Eshop\Application\Controller\StartController::class => \SeemannIT\ResponsiveSliderModule\Application\Controller\StartController::class,
        \OxidEsales\Eshop\Core\DynamicImageGenerator::class => \SeemannIT\ResponsiveSliderModule\Core\DynamicImageGenerator::class,
        \OxidEsales\Eshop\Application\Model\Actions::class => \SeemannIT\ResponsiveSliderModule\Application\Model\Actions::class,
    ],
    'settings'     => [
        [
            'group' => 'slider_display', 
            'name' => 'slider_idle', 
            'type' => 'str',  
            'value' => '4000', 
            'position' => 11,
        ],
        [
            'group' => 'slider_display',
            'name' => 'slider_duration',
            'type' => 'str', 
            'value' => '500',
            'position' => 12,
        ],
        [
            'group' => 'slider_display',
            'name' => 'slider_autostart',
            'type' => 'bool', 
            'value' => true,
            'position' => 30,
        ],
        [
            'group' => 'slider_display',
            'name' => 'slider_direction',
            'type' => 'select',
            'constrains' =>'forward|backward',
            'value' => 'right',
            'position' => 31,
        ],
        [
            'group' => 'slider_display', 
            'name' => 'slider_orientation', 
            'type' => 'select', 
            'constrains' =>'horizontal|vertical', 
            'value' => 'horizontal',
             'position' => 32,
        ],
        [
            'group' => 'slider_navigation',
            'name' => 'slider_show_arrows',
            'type' => 'bool', 
            'value' => true, 
            'position' => 101,
        ],
        [
            'group' => 'slider_navigation',
            'name' => 'slider_arrow_type', 
            'type' => 'str', 
            'value' => '2', 
            'position' => 102,
        ],
        [
            'group' => 'slider_navigation', 
            'name' => 'slider_show_bullets', 
            'type' => 'bool', 
            'value' => true, 
            'position' => 111,
        ],
        [
            'group' => 'slider_navigation',
            'name' => 'slider_bullet_type', 
            'type' => 'str', 
            'value' => '17', 
            'position' => 112,
        ],
        [
            'group' => 'slider_transitions', 
            'name' => 'slider_transitions_code',
            'type' => 'str',
            'value' => '', 
            'position' => 201,
        ],
        [
            'group' => 'slider_transitions',
            'name' => 'slider_transitions_random',
            'type' => 'bool',
            'value' => false,
            'position' => 210,
        ],
        [
            'group' => 'slider_responsive',
            'name' => 'slider_show_on_smartphone',
            'type' => 'bool', 
            'value' => true,
            'position' => 501,
        ],
        [
            'group' => 'slider_responsive',
            'name' => 'slider_show_on_tablet',
            'type' => 'bool', 
            'value' => true,
            'position' => 502,
        ],
        [
            'group' => 'slider_responsive', 
            'name' => 'sPromoBannersizePhone', 
            'type' => 'str', 
            'value' => '767*767', 
            'position' => 511,
        ],
        [
            'group' => 'slider_responsive',
            'name' => 'sPromoBannersizeTablet',
            'type' => 'str', 
            'value' => '991*991',
            'position' => 512,
        ],
        [
            'group' => 'slider_responsive',
            'name' => 'sPromoBannersize',
            'type' => 'str',
            'value' => '1200*1200',
            'position' => 513,
        ],
        [
            'group' => 'slider_links',
            'name' => 'slider_link_whole_slide',
            'type' => 'bool',
            'value' => false,
            'position' => 601
        ],
    ],
    'templates'    => [
        'slider.tpl' => 'seemannit/responsiveslider/views/blocks/slider.tpl',
    ],
];
