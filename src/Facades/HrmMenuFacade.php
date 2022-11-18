<?php

namespace Hrm\MenuBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class HrmMenuFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'hrm-menu';
    }
}
