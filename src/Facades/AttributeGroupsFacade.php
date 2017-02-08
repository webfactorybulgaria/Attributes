<?php

namespace TypiCMS\Modules\Attributes\Facades;

use Illuminate\Support\Facades\Facade as MainFacade;

class AttributeGroupsFacade extends MainFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TypiCMS\Modules\Attributes\Shells\Repositories\AttributeGroupInterface';
    }
}
