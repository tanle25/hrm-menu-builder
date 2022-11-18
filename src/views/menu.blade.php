<div class="hidden w-full md:block md:w-auto" id="navbar-default">
    <ul class="flex flex-col mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

      @foreach ($menu->items->sortBy('sort') as $item )
      <li class=" relative group p-4">
        <a href="{{$item->children->count() > 0 ? $item->link : 'javascript:;'}}" class=" block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">{{$item->label}}</a>
        @if ($item->children->count() > 0)

        <ul class=" visited:hidden opacity-0 -z-10 bg-white group-hover:z-10 ease-in-out duration-300 absolute min-w-[200px] scale-y-0 group-hover:scale-y-100 mt-1 w-max group-hover:visited:visible group-hover:translate-y-0 group-hover:opacity-100 top-12 dark:bg-gray-800 rounded-b-xl shadow-md">
            @foreach ($item->children as $child )
            <li class="hover:text-white bg-white p-3 cursor-pointer hover:bg-gray-700">{{$child->label}}</li>
            @endforeach
        </ul>

        @endif
      </li>
      @endforeach


    </ul>
</div>
