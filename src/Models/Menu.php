<?php

namespace Hrm\MenuBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{
    protected $table='menus';
    protected $guarded=['id'];


    public function items()
    {
        # code...
        return $this->hasMany(MenuItem::class,'id','menu_item_id');
    }
}
