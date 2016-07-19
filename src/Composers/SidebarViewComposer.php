<?php

namespace TypiCMS\Modules\Attributes\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('attributes::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.attributes.sidebar.icon');
                $item->weight = config('typicms.attributes.sidebar.weight');
                $item->route('admin::index-attribute_groups');
                $item->append('admin::create-attribute_group');
                $item->authorize(
                    Gate::allows('index-attribute_groups')
                );
            });
        });
    }
}
