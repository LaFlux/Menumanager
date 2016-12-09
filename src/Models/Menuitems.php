<?php
namespace ExtensionsValley\Menumanager\Models;

use Illuminate\Database\Eloquent\Model;
use ExtensionsValley\Dashboard\Models\Extension;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menuitems extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['menu_name', 'source', 'menu_type','parent_menu','ordering','is_new_tab','is_spa', 'status','created_by','updated_by'];


    public static function getMenuItems()
    {

        return self::Where('deleted_at', NULL)
            ->Where('status', 1)
            ->pluck('menu_name', 'id');
    }

    public static function getallMenus($position){

       $result = \DB::table('menu_types as T')
            ->leftjoin('menu_items as I','T.id' , '=' ,'I.menu_type')
            ->WhereNull('I.deleted_at')
            ->WhereNull('T.deleted_at')
            ->Where('T.status',1)
            ->Where('I.status',1)
            ->Where('T.position',$position)
            ->orderBy('ordering','ASC')
            ->get(['I.id','I.menu_name','I.source','I.parent_menu','I.is_new_tab']);
            return $result;
    }

    public static function getAllMenusWithType($position,$type){

       $result = \DB::table('menu_types as T')
            ->leftjoin('menu_items as I','T.id' , '=' ,'I.menu_type')
            ->WhereNull('I.deleted_at')
            ->WhereNull('T.deleted_at')
            ->Where('T.status',1)
            ->Where('I.status',1)
            ->Where('I.parent_menu',0)
            ->Where('I.menu_type',$type)
            ->orderBy('ordering','ASC')
            ->get(['I.id','I.menu_name','I.source','I.parent_menu','I.is_new_tab']);
            return $result;
    }

    public static function getChildItems($menu_id,$type){
         $result = \DB::table('menu_types as T')
            ->leftjoin('menu_items as I','T.id' , '=' ,'I.menu_type')
            ->WhereNull('I.deleted_at')
            ->WhereNull('T.deleted_at')
            ->Where('T.status',1)
            ->Where('I.status',1)
           ->Where('I.parent_menu',$menu_id)
           ->Where('I.menu_type',$type)
            ->orderBy('ordering','ASC')
            ->get(['I.id','I.menu_name','I.source','I.parent_menu','I.is_new_tab']);
            return $result;
    }

    public static function getParentMenus($menu_id = 0){
        if($menu_id == 0){
          return self::Where('deleted_at', NULL)
            ->Where('status', 1)
            ->where('parent_menu',0)
            ->pluck('menu_name', 'id');
        }else{
          return self::Where('deleted_at', NULL)
            ->Where('status', 1)
            ->where('id','<>',$menu_id)
            ->where('parent_menu',0)
            ->pluck('menu_name', 'id');
        }

    }

    //Prevent relation breaking
    public static function getRlationstatus($cid)
    {

       return 0;

    }



}
