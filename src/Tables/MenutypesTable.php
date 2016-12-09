<?php
namespace ExtensionsValley\Menumanager\Tables;

class MenutypesTable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $page_title = "Manage Menu Types";

    public $table_name = "menu_types";

    public $acl_key = "extensionsvalley.Menumanager.menutypes";

    public $namespace = 'ExtensionsValley\Menumanager\Tables\MenutypesTable';

    public $overrideview = "";

    public $model_name = 'ExtensionsValley\Menumanager\Models\Menutypes';

    public $listable = ['title' => 'Title', 'position' => 'position','status' => 'Status', 'created_at' => 'Date'];
    public $show_toolbar = ['view' => 'Show'
        , 'add' => 'Add'
        , 'edit' => 'Edit'
        , 'publish' => 'Publish'
        , 'unpublish' => 'Unpublish'
        , 'trash' => 'Trash'
        , 'restore' => 'Restore'
        , 'forcedelete' => 'Force Delete'
    ];

    public $routes = ['add_route' => 'extensionsvalley/menumanager/addmenutypes'
        , 'edit_route' => 'extensionsvalley/menumanager/editmenutypes'
        , 'view_route' => 'extensionsvalley/menumanager/viewmenutypes'
    ];

    public $advanced_filter = ['layout' => ""
            ,'filters' => [
            'filter_trashed' => 'filter_trashed'
        ]
    ];


    public function getQuery()
    {
        $filter_trashed = \Input::get('filter_trashed');
        $groups = \DB::table('menu_types')
                ->select('id', 'title', 'position','status', 'created_at');

        if($filter_trashed == 1){
            $groups = $groups->where('deleted_at','<>', NULL);
        }else{
            $groups = $groups->where('deleted_at', NULL);
        }

        return \Datatables::of($groups)
            ->editColumn('sl', '<input type="checkbox" name="cid[]" value="{{$id}}" class="cid_checkbox"/>')
            ->editColumn('status', '@if($status==1) <span class="glyphicon glyphicon-ok"> Published</span> @else <span class="glyphicon glyphicon-remove"> Unpublished</span> @endif')
            ->editColumn('created_at', '{{date("M-j-Y",strtotime($created_at))}}')
            ->make(true);
    }

}
