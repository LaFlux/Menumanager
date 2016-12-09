<?php
namespace ExtensionsValley\Menumanager\Events;


\Event::listen('admin.menu.groups', function ($collection) {

    $collection->put('extensionsvalley.menumanager', [
        'menu_text' => 'Menu Manager'
        , 'menu_icon' => '<i class="fa fa-bars"></i>'
        , 'acl_key' => 'extensionsvalley.menumanager.menupanel'
        , 'sub_menu' => [
            '0' => [
                'link' => '/admin/ExtensionsValley/menumanager/list/menutypes'
                , 'menu_text' => 'Menu Types'
                , 'acl_key' => 'extensionsvalley.menumanager.menutypes'
            ],
            '1' => [
                'link' => '/admin/ExtensionsValley/menumanager/list/menuitems'
                , 'menu_text' => 'Menu Items'
                , 'acl_key' => 'extensionsvalley.menumanager.menuitems'
            ],
        ],
    ]);


});
