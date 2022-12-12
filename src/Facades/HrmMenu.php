<?php
namespace Hrm\MenuBuilder\Facades;

use Hrm\MenuBuilder\Models\Menu;

class HrmMenu {

    protected $arr = array();
    public function render()
    {
        # code...
        $menus = Menu::all();
        return view('hrmmenu::index',['menus'=>$menus]);
    }

    public function script()
    {
        # code...
        return view('hrmmenu::scripts');
    }

    public function style()
    {
        # code...

        return view('hrmmenu::style');
    }

    public function build($id)
    {
        # code...
        $menu = Menu::find($id);
        return view('hrmmenu::menu', ['menu'=>$menu]);
    }

    public function buildByName($name)
    {
        # code...
        // dd($name);
        $menu = Menu::whereName($name)->first();
        return view('hrmmenu::menu',['menu'=>$menu]);
    }

    public function findByName($name)
    {
        # code...

        $menu = Menu::whereName($name)->first();
        return $menu;
    }

    public function findById($id)
    {
        # code...
        $menu = Menu::find($id);
        return $menu;
    }

    public function set($category, $item)
    {
        # code...
        if(!isset($this->arr[$category])){
            $this->arr[$category] = [];
        }
        array_push($this->arr[$category],$item);
    }

    public function get()
    {
        # code...
        return $this->arr;
    }
}
