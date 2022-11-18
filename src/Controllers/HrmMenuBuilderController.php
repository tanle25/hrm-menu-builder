<?php

namespace Hrm\MenuBuilder\Controllers;

use HrmMenu;
use Illuminate\Http\Request;
use Hrm\MenuBuilder\Models\Menu;
use App\Http\Controllers\Controller;
use Hrm\MenuBuilder\Models\MenuItem;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class HrmMenuBuilderController extends Controller{
    // public function index()
    // {
    //     # code...
    //     return view()
    // }

    public function storeMenu(Request $request)
    {
        # code...

        $request->validate([
            'name'=>'required|unique:menus,name'
        ],[
            'required'=>':attribute là trường bắt buộc',
            'unique'=>':attribute đã tồn tại'
        ],[
            'name'=>'Tên menu'
        ]);

        Menu::create($request->all());
        return back();
    }

    public function selectMenu(Request $request)
    {
        # code...

        $request->validate([
            'menu'=>'required|exists:menus,id'
        ],[
            'required'=>':attribute là trường bắt buộc',
            'exist'=>':attribute không tồn tại'
        ],[
            'menu'=>'Menu'
        ]);
        $menu = Menu::find($request->menu);
        return back()->with(['menu'=>$menu]);
    }

    public function addItem($menu, Request $request)
    {
        # code...
        $request->validate([
            'label'=>'required',
            'link'=>'required'
        ]);

        // dd($menu);
        $_menu = Menu::find($menu);

        $_menu->items()->create($request->all());

        return back()->with(['menu'=>$_menu]);
    }

    public function update(Request $request)
    {
        # code...

        $menu = Menu::find($request->menu);
        $items = $menu->items;

        foreach ($request->data as $item) {
            # code...
            $items->where('id',$item['id'])->first()->update([
                'sort'=>$item['order'],
                'menu_item_id'=> isset($item['parent']) ? $item['parent'] : null
            ]);
        }

        return response()->json($request->all());
    }

    public function updateItem(MenuItem $item, Request $request)
    {
        # code...
        $request->validate([
            'label'=>'required',
            'link'=>'required'
        ]);
        $item->update($request->all());
        $menu = $item->menu;
        return back()->with(['menu'=>$menu]);
    }
}
