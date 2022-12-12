@if (Session::has('menu'))
    @php
        $curent = Session::get('menu');
    @endphp
@else
@php
$curent = $menus->first();
@endphp
@endif
<div class="flex w-full">
    <div class="w-1/4 border !border-gray-300 rounded-md dark:!bg-gray-700 shadow-xl  p-3">
        @isset($curent)
        <h3 class="!text-gray-700 dark:!text-white text-2xl my-3">Thêm menu item</h3>
            <div class="customm-item ">
                <button class=" menu-type-option flex justify-between w-full py-2.5 px-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-300">
                    <span>
                        Thêm tuỳ chỉnh
                    </span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
                </button>
                <div class="menu-item-content hidden" style="display: block">
                    <form action="{{ url('hrm-menu/add-item', $curent->id) }}" method="post">
                        @csrf
                        <label for="" class="text-gray-700 dark:text-white ">Label</label>

                        <input type="text" placeholder="Label" name="label"
                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <label for="Url" class="text-gray-700 dark:text-white">URL</label>
                        <input type="text" placeholder="URL" name="link"
                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <button type="submit"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600 mt-3">
                            Thêm
                        </button>
                    </form>
                </div>
            </div>

            @foreach (Menu::get() as $key => $menuCategory )
            <div class="pt-2">
                <button class="menu-type-option flex justify-between w-full py-2.5 px-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-300">
                    <span>
                        {{$key}}
                    </span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
                </button>
                <div class="menu-item-content hidden">
                    <form class="py-3" action="{{url('hrm-menu/add-category-item',$curent->id)}}" method="post">
                        @csrf
                        <div class=" max-h-96 overflow-y-auto px-3 ">
                            @foreach ($menuCategory as $menuLink )
                            @php
                                $rand = Str::random(12);
                            @endphp
                            <div class="">
                                <label class="text-lg dark:text-gray-300 cursor-pointer" for="hrm-menu-item-{{$rand}}">
                                    <input id="hrm-menu-item-{{$rand}}" type="checkbox" name="items[{{$menuLink[key($menuLink)]}}]" value="{{key($menuLink)}}">
                                    {{key($menuLink) }}

                                </label>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600 mt-3">
                                Thêm
                        </button>
                    </form>
                </div>
            </div>

            @endforeach
        @endisset
    </div>
    <div class="w-3/4 p-3 !border-gray-300 rounded-md shadow-xl dark:!bg-gray-700">
        <div class="p-3 bg-gray-200 dark:!bg-gray-800 mb-6">
            <form id="form-select-menu" action="{{ url('hrm-menu/select-menu') }}" method="post">
                @csrf
                <div class="flex items-center">
                    <span class="dark:text-white font-bold">Chọn menu</span>
                    <select class="bg-gray-50 dark:!bg-gray-800 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mx-3" name="menu"
                        onchange="document.getElementById('form-select-menu').submit()">
                        <option value="">Chọn menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}"
                                {{ isset($curent) && $curent->id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="javascript:;" class=" !text-blue-600 font-bold" data-toggle-modal="myModal">Thêm menu mới</a>
                </div>
            </form>
        </div>
        @isset($curent)

            <div id="nestedDemo" class="list-group col nested-sortable ">
                @foreach ($curent->items->sortBy('sort') as $item)
                <div class="list-group-item nested-1 border rounded cursor-move my-2 p-3 bg-gray-200 dark:!bg-gray-800 dark:text-gray-200 border-gray-400" data-id="{{$item->id}}" >

                    <div class="">
                        {{$item->label}}
                        <span class=" menu-option float-right"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg></span>
                        <div class="hrm-menu-builder-content mt-3 py-5 hidden">
                            <form action="{{url('hrm-menu/update-item',$item->id)}}" method="POST">
                                @csrf
                                <label for="Url" class="text-gray-700 dark:text-white">Label</label>
                                <input type="text" placeholder="Label" name="label" value="{{$item->label}}"
                                    class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <label for="Url" class="text-gray-700 dark:text-white">URL</label>
                                <input type="text" placeholder="URL" name="link" value="{{$item->link}}"
                                    class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <div class="flex justify-end">
                                        <button type="submit" class=" mt-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cập nhật</button>
                                        <button type="submit" formmethod="POST" formaction="{{url('hrm-menu/delete',$item->id)}}" class=" mt-3 text-gray-900 bg-red-500 border border-gray-300 focus:outline-none hover:bg-red-600 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:!bg-red-500 dark:text-white dark:border-gray-600 dark:hover:!bg-red-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">Xoá</button>
                                    </div>

                            </form>
                        </div>
                    </div>
                    <div class="list-group nested-sortable">
                        @foreach ($item->children as $child )
                        <div class="list-group-item nested-1 border rounded cursor-move my-2 p-3 bg-gray-200 dark:!bg-gray-800 dark:text-gray-200 border-gray-400" data-id="{{$child->id}}" >{{$child->label}}
                            <span class="menu-option float-right"><svg class="w-6 h-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg></span>
                        <div class="hrm-menu-builder-content mt-3 py-5 hidden">
                            <form  action="{{url('hrm-menu/update-item',$child->id)}}" method="POST">
                                @csrf
                                <label for="Url" class="text-gray-700 dark:text-white">Label</label>
                                <input type="text" placeholder="Label" name="label" value="{{$child->label}}"
                                    class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <label for="Url" class="text-gray-700 dark:text-white">URL</label>
                                <input type="text" placeholder="URL" name="link" value="{{$child->link}}"
                                    class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                   <div class="flex justify-end">

                                    <button type="submit" class="mt-3  text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cập nhật</button>
                                    <button type="submit" formmethod="POST" formaction="{{url('hrm-menu/delete',$child->id)}}" class=" mt-3 text-gray-900 bg-red-500 border border-gray-300 focus:outline-none hover:!bg-red-600 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:!bg-red-500 dark:text-white dark:border-gray-600 dark:hover:!bg-red-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">Xoá</button>

                                </div>

                                </form>

                            </div>
                            <div class="list-group nested-sortable"></div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        @endisset

    </div>
</div>

<form action="{{ url('hrm-menu/add') }}" method="post">
    @csrf
    <div id="myModal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 md:inset-0 h-modal md:h-full">
        <div class="flex justify-center items-center">
            <div class="relative w-1/3 h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button data-toggle-modal="myModal" type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg data-toggle-modal="myModal" aria-hidden="true" class="w-5 h-5" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        {{-- <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> --}}
                        <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">Thêm menu mới</h3>
                        <div class="text-left py-5">

                            <label for="Url" class="dark:text-white">Tên menu</label>
                            <input type="text" placeholder="URL" name="name"
                                class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <button type="submit"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Thêm
                        </button>
                        <button data-toggle-modal="myModal" type="button"
                            class="text-gray-500 bg-red-500 hover:!bg-red-600 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:!bg-red-500 dark:hover:!bg-red-600 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
