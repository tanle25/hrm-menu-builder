<?php
namespace Hrm\MenuBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model{
    protected $table='menu_items';
    protected $guarded = ['id'];

    public function menu()
    {
        # code...
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        # code...
        return $this->hasMany(MenuItem::class);
    }
}
