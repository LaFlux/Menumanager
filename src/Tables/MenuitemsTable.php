<?php
namespace ExtensionsValley\Menumanager\Tables;

class MenuitemsTable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $page_title = "Manage Menu Items";

    public $table_name = "menu_items";

    public $acl_key = "extensionsvalley.Menumanager.menuitems";

    public $namespace = 'ExtensionsValley\Menumanager\Tables\MenuitemsTable';

    public $overrideview = "";

    public $model_name = 'ExtensionsValley\Menumanager\Models\Menuitems';

    public $listable = ['menu_name' => 'Name', 'menu_type' => 'Menu Type','ordering' => 'Order','status' => 'Status', 'created_at' => 'Sub Menus','is_new_tab' => 'Sub Menus'];

    public $show_toolbar = ['view' => 'Show'
        , 'add' => 'Add'
        , 'edit' => 'Edit'
        , 'publish' => 'Publish'
        , 'unpublish' => 'Unpublish'
        , 'trash' => 'Trash'
        , 'restore' => 'Restore'
        , 'forcedelete' => 'Force Delete'
    ];

    public $routes = ['add_route' => 'extensionsvalley/menumanager/addmenuitems'
        , 'edit_route' => 'extensionsvalley/menumanager/editmenuitems'
        , 'view_route' => 'extensionsvalley/menumanager/viewmenuitems'
    ];

     public $advanced_filter = ['layout' => "Menumanager::admin.advancedfilters.menufilter"
        ,'filters' => [
            'filter_parent_menu' => 'filter_parent_menu'
            , 'filter_status' => 'filter_status'
            , 'filter_menu_type' => 'filter_menu_type'
            , 'filter_trashed' => 'filter_trashed'
        ]
    ];


    public function getQuery()
    {
        $search = \Input::get('customsearch');
        $filter_trashed = \Input::get('filter_trashed');
        $filter_status = \Input::has('filter_status') ? \Input::get('filter_status') : '-1';
        $filter_menu_type = \Input::get('filter_menu_type');
        $filter_parent_menu = \Input::get('filter_parent_menu');

        $menuitems = \DB::table('menu_items as I')
                        ->leftjoin('menu_types AS T','T.id','=','I.menu_type')
                        ->OrderBy('I.ordering','ASC')
                        ->select('I.id', 'I.menu_name', 'T.title as menu_type','I.ordering','I.status', 'I.created_at','I.is_new_tab');

        if($filter_trashed == 1){
            $menuitems = $menuitems->where('I.deleted_at','<>', NULL);
        }else{
            $menuitems = $menuitems->where('I.deleted_at', NULL);
        }

        if($filter_parent_menu > 0){
            $menuitems = $menuitems->where('I.parent_menu',$filter_parent_menu);
        }else{
            $menuitems = $menuitems->where('I.parent_menu',0);
        }
        if ($filter_status != -1) {
            $menuitems = $menuitems->Where('I.status', $filter_status);
        }
        if ($filter_menu_type != 0) {
            $menuitems = $menuitems->Where('I.menu_type', $filter_menu_type);
        }

        return \Datatables::of($menuitems)
            ->editColumn('sl', '<input type="checkbox" name="cid[]" value="{{$id}}" class="cid_checkbox"/>')
            ->editColumn('status', '@if($status==1) <span class="glyphicon glyphicon-ok"> Published</span> @else <span class="glyphicon glyphicon-remove"> Unpublished</span> @endif')
            ->editColumn('created_at', '@if(ExtensionsValley\Menumanager\Models\Menuitems::whereNull("deleted_at")->Where("status",1)->Where("parent_menu",$id)->count() > 0)
                 <a href="?filter_parent_menu={{$id}}">
                  Items
                  ({{ExtensionsValley\Menumanager\Models\Menuitems::whereNull("deleted_at")->Where("status",1)->Where("parent_menu",$id)->count()}})
                 </a>
                 @else
                    ---
                 @endif')
            ->filter(function ($query) use ($search,$filter_parent_menu,$filter_status,$filter_menu_type,$filter_trashed) {
                $query->where('I.menu_name', 'like', $search . '%')
                    ->orwhere('T.title', 'like', $search . '%');

                if($filter_trashed == 1){
                    $query->where('I.deleted_at','<>', NULL);
                }else{
                    $query->where('I.deleted_at', NULL);
                }
                if ($filter_parent_menu > 0) {
                    $query->Where('I.parent_menu', $filter_parent_menu);
                }else{
                     $query->Where('I.parent_menu', 0);
                }
                if ($filter_status > 0) {
                    $query->Where('I.status', $filter_status);
                }
                if ($filter_menu_type > 0) {
                    $query->Where('I.menu_type', $filter_menu_type);
                }

            })
            ->make(true);
    }

}
