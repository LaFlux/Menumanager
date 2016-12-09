<?php

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth:admin']], function () {
    Route::get('/extensionsvalley/menumanager/addmenuitems', [
        'middleware' => 'acl:add',
        'name' => 'Add Menu Item',
        'as' => 'extensionsvalley.admin.addmenuitems',
        'uses' => 'ExtensionsValley\Menumanager\MenuController@addMenuItems',
    ]);
    Route::get('/extensionsvalley/menumanager/editmenuitems/{id}', [
        'middleware' => 'acl:edit',
        'name' => 'Edit Menu Item',
        'as' => 'extensionsvalley.admin.editmenuitems',
        'uses' => 'ExtensionsValley\Menumanager\MenuController@editMenuItems',
    ]);
    Route::get('/extensionsvalley/menumanager/viewmenuitems/{id}', [
        'middleware' => 'acl:view',
        'name' => 'view Menu Item',
        'as' => 'extensionsvalley.admin.viewmenuitems',
        'uses' => 'ExtensionsValley\Menumanager\MenuController@viewMenuItems',
    ]);
    Route::post('/extensionsvalley/menumanager/savemenuitems', [
        'middleware' => 'acl:add',
        'name' => 'Save Menu Item',
        'as' => 'extensionsvalley.admin.savemenuitems',
        'uses' => 'ExtensionsValley\Menumanager\MenuController@saveMenuItems',
    ]);
    Route::post('/extensionsvalley/menumanager/updatemenuitems', [
        'middleware' => 'acl:edit',
        'name' => 'Update Menu Item',
        'as' => 'extensionsvalley.admin.updatemenuitems',
        'uses' => 'ExtensionsValley\Menumanager\MenuController@updateMenuItems',
    ]);
});
