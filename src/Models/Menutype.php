<?php
namespace ExtensionsValley\Menumanager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menutypes extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_types';

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
    protected $fillable = ['title', 'position', 'is_all_page', 'status','created_by','updated_by'];


    public static function getMenuTypes()
    {

        return self::Where('deleted_at', NULL)
            ->Where('status', 1)
            ->pluck('title', 'id');
    }


    //Prevent relation breaking
    public static function getRlationstatus($cid)
    {
       $count = \DB::table('menu_items')
            ->WhereNull('deleted_at')
            ->WhereIn('menu_type', $cid)
            ->count();

        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }

    }


}
