<?php
namespace Hrm\MenuBuilder\Facades;

use Hrm\MenuBuilder\Models\Menu;

class HrmMenu {
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

        // return
        $menu = Menu::find($id);
        // dd($menu);
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
}
