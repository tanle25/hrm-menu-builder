<?php

namespace Hrm\MenuBuilder\Controllers;

use Illuminate\Http\Request;
use Hrm\MenuBuilder\Models\Menu;
use App\Http\Controllers\Controller;
use Hrm\MenuBuilder\Models\MenuItem;

class HrmMenuBuilderController extends Controller{
    // public function index()
    // {
    //     # code...
    //     return view();
    // }

    public function delete(MenuItem $item)
    {
        # code...
        // dd($item);
        $item->delete();
        $menu = $item->menu;
        return back()->with(['menu'=>$menu]);
    }
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

    public function addCategoryItem(Menu $menu, Request $request)
    {

        # code...
        // dd($request->all());
        foreach ($request->items as $key => $value) {
            $menu->items()->create([
                'label'=>$value,
                'link'=>url($key)
            ]);
        }
        return back()->with(['menu'=>$menu]);
    }

    public function update(Request $request)
    {
        # code...

        $data = $request->data;
        MenuItem::find($data['id'])->update(
            [
                'sort'=>$data['index'],
                'menu_item_id'=> isset($data['parent']) ? $data['parent'] : null
            ]
        );

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
