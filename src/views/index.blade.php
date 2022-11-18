@if (Session::has('menu'))
    {{-- @dd($curent = Session::get('menu')) --}}
    @php
        $curent = Session::get('menu');
    @endphp
@endif
<div class="flex w-full">
    <div class="w-1/4 border border-gray-700 dark:border-white p-3">
        @isset($curent)
            <form action="{{ url('hrm-menu/add-item', $curent->id) }}" method="post">
                @csrf
                <h3 class="text-gray-700 dark:text-white text-2xl">Thêm menu item</h3>
                <label for="Url" class="text-gray-700 dark:text-white">URL</label>
                <input type="text" placeholder="URL" name="link"
                    class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <label for="" class="text-gray-700 dark:text-white ">Label</label>
                <input type="text" placeholder="Label" name="label"
                    class="bg-gray-50 border dark:border-white border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
            </form>
        @endisset
    </div>
    <div class="w-3/4 p-3">
        <div class="p-3 bg-gray-200 dark:bg-gray-800 mb-6">
            <form id="form-select-menu" action="{{ url('hrm-menu/select-menu') }}" method="post">
                @csrf
                <div class="flex items-center">
                    <span class="dark:text-white font-bold">Chọn menu</span>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mx-3" name="menu"
                        onchange="document.getElementById('form-select-menu').submit()">
                        <option value="">Chọn menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}"
                                {{ isset($curent) && $curent->id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                    <a href="javascript:;" class="dark:text-white font-bold" data-toggle-modal="myModal">Thêm menu mới</a>
                </div>
            </form>
        </div>
        @isset($curent)
            <ol id="draggable" data-menu="{{ $curent->id }}">
                @foreach ($curent->items->sortBy('sort') as $item)
                    <li data-id="{{ $item->id }}"
                        class="p-3 bg-white dark:!bg-gray-800 border border-gray-200 dark:text-white dark:border-gray-200">
                        {{ $item->label }}
                        <span class=" menu-option float-right"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg></span>
                        <div class="content mt-3 py-5 hidden">
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
                                    </div>

                            </form>
                        </div>
                        @if ($item->children->count() > 0)
                            <ol data-id="3" class="m-5">
                                @foreach ($item->children as $child)
                                    <li data-id="{{ $child->id }}"
                                        class="p-3 bg-white dark:!bg-gray-800 border dark:text-white border-gray-200 dark:border-gray-200">
                                        {{ $child->label }}
                                        <span class="menu-option float-right"><svg class="w-6 h-6" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg></span>
                                        <div class="content mt-3 py-5 hidden">
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
                                                </div>

                                                </form>

                                            </div>
                                    </li>
                                @endforeach
                            </ol>
                        {{-- @else --}}

                        @endif
                    </li>
                @endforeach
            </ol>
        @endisset

    </div>
</div>

{{-- {!!Menu::buildByName('main')!!} --}}

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
                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-toggle-modal="myModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
