<?php
namespace ExtensionsValley\Menumanager\Validators;

class MenuitemsValidation
{

    public function getRules()
    {
        return [
            'menu_name' => 'required|max:200',
            'source' => 'required|max:255',
            'menu_type' => 'required',
            'parent_menu' => 'required',
            'ordering' => 'numeric',
        ];
    }

    public function getUpdateRules($menu_items)
    {

        return [
            'menu_name' => 'required|max:200',
            'source' => 'required|max:255',
            'menu_type' => 'required',
            'parent_menu' => 'required',
            'ordering' => 'numeric',
        ];
    }

}
