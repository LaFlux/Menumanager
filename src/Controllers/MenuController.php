<?php
namespace ExtensionsValley\Menumanager;

use ExtensionsValley\Menumanager\Validators\MenutypesValidation;
use ExtensionsValley\Menumanager\Validators\MenuitemsValidation;
use ExtensionsValley\Menumanager\Models\Menutypes;
use ExtensionsValley\Menumanager\Models\Menuitems;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MenuController extends Controller
{



    public function __construct()
    {


    }

    public function addMenuTypes()
    {

        $title = 'Add New Menu Type';

        return \View::make('Menumanager::admin.menutypesform', compact('title'));
    }

    /**
     * Create a new pages instance after a valid registration.
     *
     * @param  array $data
     * @return pages
     */
    protected function saveMenuTypes(Request $request)
    {

        $validation = \Validator::make($request->all(), with(new MenutypesValidation)->getRules());

        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.addmenutypes',['accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }

        $title = $request->input('title');
        $status = $request->input('status');
        $position = $request->input('position');
        $is_all_page = $request->input('is_all_page');
        $created_by = \Auth::guard('admin')->user()->id;
        $updated_by = \Auth::guard('admin')->user()->id;

        Menutypes::create([
            'title' => $title,
            'position' => $position,
            'is_all_page' => $is_all_page,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'status' => $status,
        ]);
        return redirect('admin/ExtensionsValley/Menumanager/list/Menutypes')->with(['message' => 'Details added successfully!']);
    }

    public function editMenuTypes($id)
    {

        $title = 'Edit Menu Type';
        $menutypes = Menutypes::findOrFail($id);
        return \View::make('Menumanager::admin.menutypesform', compact('title', 'menutypes'));
    }

    public function viewMenuTypes($id)
    {

        $title = 'View Menu Types';
        $menutypes = Menutypes::findOrFail($id);
        $viewmode = 'view';
        return \View::make('Menumanager::admin.menutypesform', compact('title', 'menutypes', 'viewmode'));
    }

    public function updateMenuTypes(Request $request)
    {

        $menutypes_id = $request->input('menutypes_id');
        $title = $request->input('title');
        $status = $request->input('status');
        $position = $request->input('position');
        $is_all_page = $request->input('is_all_page');
        $updated_by = \Auth::guard('admin')->user()->id;
        $menutypes = Menutypes::findOrFail($menutypes_id);
        $validation = \Validator::make($request->all()
            , with(new MenutypesValidation)->getUpdateRules($menutypes));
        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.editmenutypes', ['id' => $menutypes->id,'accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }

        Menutypes::Where('id', $menutypes->id)->update([
            'title' => $title,
            'position' => $position,
            'is_all_page' => $is_all_page,
            'updated_by' => $updated_by,
            'status' => $status,
            ]);

        return redirect('admin/ExtensionsValley/Menumanager/list/menutypes')->with(['message' => 'Details updated successfully!']);

    }

    public function addMenuItems()
    {

        $title = 'Add New Menu Item';

        return \View::make('Menumanager::admin.menuitemsform', compact('title'));
    }

    /**
     * Create a new pages instance after a valid registration.
     *
     * @param  array $data
     * @return pages
     */
    protected function saveMenuItems(Request $request)
    {

        $validation = \Validator::make($request->all(), with(new MenuitemsValidation)->getRules());

        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.addmenuitems',['accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }

        $menu_name = $request->input('menu_name');
        $status = $request->input('status');
        $source = $request->input('source');
        $menu_type = $request->input('menu_type');
        $parent_menu = $request->input('parent_menu');
        $ordering = $request->input('ordering');
        $is_new_tab = $request->input('is_new_tab');
        $is_spa = $request->input('is_spa');
        $created_by = \Auth::guard('admin')->user()->id;
        $updated_by = \Auth::guard('admin')->user()->id;

        Menuitems::create([
            'menu_name' => $menu_name,
            'source' => $source,
            'menu_type' => $menu_type,
            'parent_menu' => $parent_menu,
            'ordering' => $ordering,
            'is_new_tab' => $is_new_tab,
            'is_spa' => $is_spa,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'status' => $status,
        ]);
        return redirect('admin/ExtensionsValley/Menumanager/list/Menuitems')->with(['message' => 'Details added successfully!']);
    }

    public function editMenuItems($id)
    {

        $title = 'Edit Menu Item';
        $menuitems = Menuitems::findOrFail($id);
        return \View::make('Menumanager::admin.menuitemsform', compact('title', 'menuitems'));
    }

    public function viewMenuItems($id)
    {

        $title = 'View Menu Items';
        $menuitems = menuitems::findOrFail($id);
        $viewmode = 'view';
        return \View::make('Menumanager::admin.menuitemsform', compact('title', 'menuitems', 'viewmode'));
    }

    public function updateMenuItems(Request $request)
    {

        $menuitems_id = $request->input('menuitems_id');
        $menu_name = $request->input('menu_name');
        $status = $request->input('status');
        $source = $request->input('source');
        $menu_type = $request->input('menu_type');
        $parent_menu = $request->input('parent_menu');
        $ordering = $request->input('ordering');
        $is_new_tab = $request->input('is_new_tab');
        $is_spa = $request->input('is_spa');
        $updated_by = \Auth::guard('admin')->user()->id;
        $menuitems = Menuitems::findOrFail($menuitems_id);
        $validation = \Validator::make($request->all()
            , with(new MenuitemsValidation)->getUpdateRules($menuitems));
        if ($validation->fails()) {
            return redirect()->route('extensionsvalley.admin.editmenuitems', ['id' => $menuitems->id,'accesstoken'=>\Input::get('accesstoken')])->withErrors($validation)->withInput();
        }


        Menuitems::Where('id', $menuitems->id)->update([
            'menu_name' => $menu_name,
            'source' => $source,
            'menu_type' => $menu_type,
            'parent_menu' => $parent_menu,
            'ordering' => $ordering,
            'is_new_tab' => $is_new_tab,
            'is_spa' => $is_spa,
            'updated_by' => $updated_by,
            'status' => $status,
            ]);

        return redirect('admin/ExtensionsValley/Menumanager/list/menuitems')->with(['message' => 'Details updated successfully!']);

    }

}
